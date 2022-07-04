<?php

namespace App\Http\Controllers;

use App\Models\FonctionGenerique;
use App\ProjetInterne;
use Carbon\Carbon;
use Exception;
use Google\Service\AndroidManagement\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjetInterneController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $entreprise_id = $fonct->findWhereMulitOne("employers",["user_id"],[$user_id])->entreprise_id;
        $modules = DB::select('select * from modules_interne where etp_id = ?',[$entreprise_id]);
        return view('projet_interne.projet_interne_creation', compact('modules'));
    }

    public function enregistrement(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $entreprise_id = $fonct->findWhereMulitOne("employers",["user_id"],[$user_id])->entreprise_id;
        try {
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de début doit être inférieur date de fin.");
            }

            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if($request->module_id == null){
                throw new Exception("Vous devez choisir un module de formation.");
            }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalité de formation.");
            }
            DB::beginTransaction();
            $projet = new ProjetInterne();

            $nom_projet = $projet->nom_projet();


            DB::insert('insert into projets_interne(nom_projet,entreprise_id,type_formation_id,status,date_creation) values(?,?,?,?,current_timestamp())', [$nom_projet, $entreprise_id, 3, 'Confirmé']);

            $last_insert_projet = DB::table('projets_interne')->latest('id')->first();
            $nom_groupe = $projet->nom_session();
            DB::insert(
                'insert into groupes_interne(nom_groupe,projet_interne_id,module_interne_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,1,?,TRUE)',
                [$nom_groupe, $last_insert_projet->id, $request->module_id, $request->date_debut, $request->date_fin,$request->modalite]
            );

            DB::commit();
            // return redirect()->route('detail_session', ['id_session' => $last_insert_groupe->id]);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function detail_session(){
        $fonct = new FonctionGenerique();

        $id = request()->groupe;
        $module_session = DB::select('select reference,nom_module, module_interne_id as module_id from groupes_interne,modules_interne where groupes_interne.module_interne_id = modules_interne.id and groupes_interne.id = ?',[$id])[0];
        $etp_id = $fonct->findWhereMulitOne("employers",["user_id"],[Auth::user()->id])->entreprise_id;
        $formateur = $fonct->findWhere('formateurs_interne',['entreprise_id'],[$etp_id]);
        $datas = $fonct->findWhere("v_detail_session_interne", ["groupe_id"], [$id]);
        $projet = $fonct->findWhere("v_groupe_entreprise_interne", ["entreprise_id","groupe_id"], [$etp_id,$id]);
        $stagiaire = DB::select('select * from v_stagiaire_groupe_interne where groupe_id = ? and entreprise_id = ? order by stagiaire_id asc',[$projet[0]->groupe_id,$etp_id]);
        $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?',[$projet[0]->module_id]);
        $presence_detail = DB::select("select * from v_emargement_interne where groupe_id = ?", [$id]);
        $modalite = DB::select('select modalite from groupes_interne where id = ?',[$id])[0]->modalite;
        $lieu_formation = DB::select('select projet_id,groupe_id,lieu from details where groupe_id = ? AND projet_id=? group by projet_id,groupe_id,lieu', [$projet[0]->groupe_id,$projet[0]->projet_id]);
        $salle_formation = DB::select('select * from salle_formation_etp where etp_id = ?',[$etp_id]);
        $ressource = DB::select('select * from ressources where groupe_id =?',[$projet[0]->groupe_id]);
        $evaluation_apres = DB::select('select sum(note_apres) as somme from evaluation_stagiaire_interne where groupe_interne_id = ?',[$projet[0]->groupe_id])[0]->somme;
        $evaluation_avant = DB::select('select sum(note_avant) as somme from evaluation_stagiaire_interne where groupe_interne_id = ?',[$projet[0]->groupe_id])[0]->somme;
        $evaluation_stg = DB::select('select * from evaluation_stagiaire_interne where groupe_interne_id = ?', [$id]);
        return view('projet_interne.detail_session_interne',compact('module_session','etp_id','formateur','datas','projet','stagiaire','competences','presence_detail','modalite','lieu_formation','salle_formation','ressource','evaluation_avant','evaluation_apres','evaluation_stg'));
    }

    public function getFormateur(){
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $etp_id = $fonct->findWhereMulitOne("employers",["user_id"],[Auth::user()->id])->entreprise_id;
        $formateur = $fonct->findWhere('formateurs_interne',['entreprise_id'],[$etp_id]);
        $salles = DB::select('select * from salle_formation_etp where etp_id = ?',[$etp_id]);

        return response()->json(array('formateur'=>$formateur,'salles'=>$salles));
    }

    public function addParticipantGroupe(Request $request){
        $fonct = new FonctionGenerique();
        $matricule = $request->Id;
        $id_groupe = $request->groupe;
        try{
            $id_stg = $fonct->findWhereMulitOne('stagiaires',['matricule'],[$matricule])->id;
            DB::insert('insert into participant_groupe_interne(stagiaire_id,groupe_interne_id) values(?,?)',[$id_stg,$id_groupe]);
            $stg = DB::select('select * from v_stagiaire_groupe_interne where groupe_id = ?',[$id_groupe]);
            return response()->json($stg);

        }catch(Exception $e){
            $stg = DB::select('select * from v_stagiaire_groupe_interne where groupe_id = ?',[$id_groupe]);
            return response()->json($stg);
        }
    }

    public function getOneStagiaire(Request $request)
    {
        $id = $request->Id;
        $etp = $request->etp;
        $groupe = $request->groupe;
        $stagiaire = DB::select('select * from stagiaires where matricule = "'.$id.'" or nom_stagiaire = "'.$id.'" or prenom_stagiaire = "'.$id.'" and entreprise_id='.$etp);

        $existe = 0;
        if(count($stagiaire) > 0){
            $stg_id = DB::select('select * from stagiaires where matricule =  "'.$id.'" or nom_stagiaire = "'.$id.'" or prenom_stagiaire = "'.$id.'"')[0]->id;
            $existe = DB::select('select count(stagiaire_id) as nombre from participant_groupe_interne where stagiaire_id = ? and groupe_interne_id = ?',[$stg_id,$groupe])[0]->nombre;
            $stg = DB::select('select *,concat(SUBSTRING(nom_stagiaire, 1, 1),SUBSTRING(prenom_stagiaire, 1, 1)) as sans_photo from stagiaires where matricule = "'.$id.'" or nom_stagiaire = "'.$id.'" or prenom_stagiaire = "'.$id.'" and entreprise_id ='.$etp);
            return response()->json(['status'=>'200','stagiaire'=>$stg,'inscrit'=>$existe]);
        }else{
            return response()->json(['status'=>'400']);
        }
    }

    public function inserer_detail(Request $request)
    {
        try{
            $user_id = Auth::user()->id;
            DB::beginTransaction();
            $fonct = new FonctionGenerique();
            for ($i = 0; $i < count($request['lieu']); $i++) {
                if($request['lieu'][$i]== null){
                    throw new Exception("Vous devez completer le champ lieu.");
                }
                if($request['formateur'][$i]== null){
                    throw new Exception("Vous devez choisir le formateur.");
                }
                if($request['debut'][$i]== null || $request['fin'][$i] == null){
                    throw new Exception("Vous devez completer l'heure de la scéance.");
                }
                if($request['debut'][$i] >= $request['fin'][$i] ){
                    throw new Exception("L'heure de debut doit être inférieur à l'heure de fin.");
                }
                DB::insert('insert into details_interne(lieu,h_debut,h_fin,date_detail,formateur_interne_id,groupe_interne_id,projet_interne_id) values(?,?,?,?,?,?,?)', [$request['lieu'][$i], $request['debut'][$i], $request['fin'][$i], $request['date'][$i], $request['formateur'][$i], $request->groupe, $request->projet]);
            }
            DB::update('update groupes_interne set status = 1 where id = ?', [$request->groupe]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('detail_error',$e->getMessage());
        }
    }

    public function ajout_ressource(Request $request){
        $ressource = $request->ressource;
        $groupe_id = $request->groupe;
        $pris_en_charge = $request->pris_en_charge;
        $note = $request->note;
        DB::insert('insert into ressources(description,groupe_id,pris_en_charge,note) values(?,?,?,?)',[$ressource,$groupe_id,$pris_en_charge,$note]);
        $all_ressources = DB::select('select * from ressources where groupe_id = ?',[$groupe_id]);
        return response()->json($all_ressources);
    }

    public function get_presence_stg(Request $request){
        $stg = $request->stagiaire;
        $detail = $request->detail;
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhereMulitOne('v_detail_presence_stagiaire_interne',['stagiaire_id','detail_id'],[$stg,$detail]);
        return response()->json($data);
    }

    public function insert_presence(Request $request){
        if(!isset($request->insert_form)){
            $presence = $request->edit_attendance;
            $h_entree = $request->edit_h_entree;
            $h_sortie = $request->edit_h_sortie;
            $note = $request->edit_note_desc;
            $detail_id = $request->edit_detail_id;
            $stg_id = $request->edit_stg_id;
            DB::update('update presences_interne set status = ? , h_entree = ? , h_sortie = ? , note = ? where detail_interne_id = ? and stagiaire_id = ?', [$presence[$detail_id][$stg_id],$h_entree,$h_sortie,$note,$detail_id,$stg_id]);
        }
        if(isset($request->insert_form)){
            $groupe_id = $request->groupe;
            $detail_id = $request->detail_id;
            $presence = $request->attendance;
            $h_entree = $request->entree;
            $h_sortie = $request->sortie;
            $note = $request->note_desc;
            $stagiaire = DB::select('select stagiaire_id from v_stagiaire_groupe_interne where groupe_id = ? order by stagiaire_id asc',[$groupe_id]);
            $detail = DB::select('select h_debut,h_fin from details_interne where id = ?',[$detail_id]);
            foreach($stagiaire as $stg){
                if(empty($h_entree[$detail_id][$stg->stagiaire_id])){
                    $h_entree[$detail_id][$stg->stagiaire_id] = $detail[0]->h_debut;
                }
                if(empty($h_sortie[$detail_id][$stg->stagiaire_id])){
                    $h_sortie[$detail_id][$stg->stagiaire_id] = $detail[0]->h_fin;
                }
                if(empty($note[$detail_id][$stg->stagiaire_id])){
                    $note[$detail_id][$stg->stagiaire_id] = "";
                }
                DB::insert('insert into presences_interne(stagiaire_id,detail_interne_id,status,h_entree,h_sortie,note) values(?,?,?,?,?,?)',[$stg->stagiaire_id,$detail_id,$presence[$detail_id][$stg->stagiaire_id],$h_entree[$detail_id][$stg->stagiaire_id],$h_sortie[$detail_id][$stg->stagiaire_id],$note[$detail_id][$stg->stagiaire_id]]);
            }
        }
        return back();
    }

    public function insert_evaluation_stagiaire(Request $request){
        $stagiaire = DB::select('select * from v_stagiaire_groupe_interne where groupe_id = ? order by stagiaire_id asc',[$request->groupe]);
        $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?',[$request->module]);
        foreach($stagiaire as $stg){
            foreach($competences as $comp){
                $stag = $request['stagiaire'][$stg->stagiaire_id];
                $note = $request['note'][$stg->stagiaire_id][$comp->id];
                DB::insert('insert into evaluation_stagiaire_interne(groupe_interne_id,competence_a_evaluers_interne_id,stagiaire_id,note_avant) values (?, ?, ?, ?)', [$request->groupe,$comp->id,$stag,$note]);
            }
        }
        return back();
    }
    public function modifier_evaluation_stagiaire(Request $request){
        $stagiaire = DB::select('select * from v_stagiaire_groupe_interne where groupe_id = ? order by stagiaire_id asc',[$request->groupe]);
        $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?',[$request->module]);
        foreach($stagiaire as $stg){
            foreach($competences as $comp){
                $stag = $request['stagiaire'][$stg->stagiaire_id];
                $note = $request['note'][$stg->stagiaire_id][$comp->id];
                DB::update('update evaluation_stagiaire_interne set note_avant = ? where groupe_interne_id = ? and competence_a_evaluers_interne_id = ? and stagiaire_id = ?',[$note,$request->groupe,$comp->id,$stag]);
            }
        }
        return back();
    }

    public function get_competence_stagiaire(Request $request){
        $detail = DB::select('select * from v_evaluation_stagiaire_competence_interne where stagiaire_id = ? and groupe_id = ?',[$request->stg,$request->groupe]);
        $globale = DB::select('select * from v_evaluation_globale_interne where stagiaire_id = ? and groupe_interne_id = ?',[$request->stg,$request->groupe]);
        $note_avant = DB::select('select * from evaluation_stagiaire_interne where stagiaire_id = ? and groupe_interne_id = ?',[$request->stg,$request->groupe]);
        $module = DB::select('select * from v_groupe_projet_module_interne where groupe_id = ?',[$request->groupe])[0];
        if(count($note_avant)>0){
            $note_avant = 1;
        }else{
            $note_avant = 0;
        }
        return response()->json(['detail'=>$detail,'globale'=>$globale,'note_avant'=>$note_avant,'module'=>$module]);
    }

    public function insert_evaluation_stagiaire_apres(Request $request){
        try{
            DB::beginTransaction();
            $stagiaire = $request->stagiaire;
            // dd($request['status']);
            $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?',[$request->module]);
            foreach($competences as $comp){
                $note = $request['note'][$comp->id];
                $status = $request['status'][$comp->id];
                if($note == null || $note>10 || $note < 0){
                    throw new Exception("La note doit être entre 0 et 10.");
                }
                if($request->note_globale == null){
                    throw new Exception("La validation globale pour le module est indéfinie.");
                }
                if($status == null){
                    throw new Exception("La validation par compétence est incomplete.");
                }
                DB::update('update evaluation_stagiaire_interne set note_apres = ? ,status = ? where stagiaire_id = ? and groupe_interne_id = ? and competence_a_evaluers_interne_id = ?',[$note,$status,$stagiaire,$request->groupe,$comp->id]);
            }
            DB::update('update participant_groupe_interne set status = ? where groupe_interne_id = ? and stagiaire_id = ?',[$request->note_globale,$request->groupe,$stagiaire]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('eval_error',$e->getMessage());
        }
    }
}


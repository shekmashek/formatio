<?php

namespace App\Http\Controllers;

use App\EvaluationChaudInterne;
use App\Models\FonctionGenerique;
use App\ProjetInterne;
use App\Stagiaire;
use Carbon\Carbon;
use Exception;
use Google\Service\AndroidManagement\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

use function Psy\info;

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
                'insert into groupes_interne(nom_groupe,projet_interne_id,module_interne_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,2,?,TRUE)',
                [$nom_groupe, $last_insert_projet->id, $request->module_id, $request->date_debut, $request->date_fin,$request->modalite]
            );
            $last_insert_groupe = DB::table('groupes_interne')->latest('id')->first();
            DB::commit();
            return redirect()->route('detail_session_interne', ['groupe' => $last_insert_groupe->id]);
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
        $lieu_formation = DB::select('select projet_interne_id,groupe_interne_id,lieu from details_interne where groupe_interne_id = ? AND projet_interne_id=? group by projet_interne_id,groupe_interne_id,lieu', [$projet[0]->groupe_id,$projet[0]->projet_id]);
        if(count($lieu_formation) > 0){
            $lieu_formation = explode(',  ',$lieu_formation[0]->lieu);
        }else{
            $lieu_formation = ['-','-'];
        }
        $salle_formation = DB::select('select * from salle_formation_etp where etp_id = ?',[$etp_id]);
        $ressource = DB::select('select * from ressources_interne where groupe_id =?',[$projet[0]->groupe_id]);
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

    public function supprimmer_stagiaire(Request $request)
    {
        $id = $request->Id;
        $groupe_id = $request->groupe;
        DB::delete('delete from participant_groupe_interne where stagiaire_id = ? and groupe_interne_id = ?',[$id,$groupe_id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
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

    public function modifier_detail(Request $request, $id)
    {
        //modifier les données
        $lieu = $request->lieu;
        $h_debut = $request->debut;
        $h_fin = $request->fin;
        $formateur = $request->formateur;
        $date_detail = $request->date;
        try{
            if($lieu== null){
                throw new Exception("Vous devez completer le champ lieu.");
            }
            if($formateur == null){
                throw new Exception("Vous devez choisir le formateur.");
            }
            if($h_debut == null || $h_fin == null){
                throw new Exception("Vous devez completer l'heure de la scéance.");
            }
            if($date_detail == null){
                throw new Exception("Vous devez choisir le date.");
            }
            DB::update('update details_interne set formateur_interne_id = ?, date_detail = ? , h_debut = ? , h_fin = ? , lieu = ? where id = ?',[$formateur,$request->date,$h_debut,$h_fin,$lieu,$id]);

            return back();
        }catch(Exception $e){
            return back()->with('detail_error',$e->getMessage());
        }
    }

    public function supprimer_detail(Request $request)
    {
        DB::delete('delete from details_interne where id = ?',[$request->id]);
        return back();
    }

    public function ajout_ressource(Request $request){
        $ressource = $request->ressource;
        $groupe_id = $request->groupe;
        $pris_en_charge = $request->pris_en_charge;
        $note = $request->note;
        DB::insert('insert into ressources_interne(description,groupe_id,pris_en_charge,note) values(?,?,?,?)',[$ressource,$groupe_id,$pris_en_charge,$note]);
        $all_ressources = DB::select('select * from ressources_interne where groupe_id = ?',[$groupe_id]);
        return response()->json($all_ressources);
    }

    public function supprimer_ressource(Request $request)
    {
        $id = $request->Id;
        $groupe_id = $request->groupe;
        DB::delete('delete from ressources_interne where id = ? and groupe_id = ?',[$id,$groupe_id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
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

    public function fiche_technique_pdf($id)
    {
        try{
            $info_projet = DB::select('select type_formation,nom_projet,groupe_id,nom_groupe,item_status_groupe,nom_formation,nom_module from v_groupe_projet_module_interne where groupe_id = ?',[$id])[0];
            $entreprise  = DB::select('select nom_etp,logo from v_groupe_entreprise_interne where groupe_id = ?',[$id])[0];
            $formateurs  = DB::select('select photos,nom_formateur,prenom_formateur,telephone_formateur,mail_formateur from details_interne d join formateurs_interne f on f.formateur_id = d.formateur_interne_id where d.groupe_interne_id = ? group by photos,nom_formateur,prenom_formateur,telephone_formateur,mail_formateur',[$id]);
            $lieux       = DB::select('select lieu from details_interne where groupe_interne_id = ? group by lieu',[$id]);
            $stagiaires  = DB::select('select * from  v_stagiaire_groupe_interne where groupe_id = ?',[$id]);
            $date_groupe = DB::select('select date_detail,h_debut,h_fin from details_interne where groupe_interne_id = ?',[$id]);
            // return view('projet_session.fiche_technique_pdf' ,compact('info_projet','formateurs','lieux','stagiaires', 'date_groupe','entreprise'));
            $pdf = PDF::loadView('projet_interne.fiche_technique_interne_pdf', compact('info_projet','formateurs','lieux','stagiaires', 'date_groupe','entreprise'));
            return $pdf->download('fiche_technique.pdf');
        }catch(Exception $e){
            return back()->with('pdf_error','Impossible de télécharger le pdf.');
        }
    }

    public function evaluation_a_chaud()
    {
        $evaluation = new EvaluationChaudInterne();
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $stg_id = Stagiaire::where('user_id',$user_id)->value('id');
        $champ_reponse = $evaluation->findAllChampReponse(); // return desc champs formulaire
        $qst_mere = $evaluation->findAllQuestionMere(); // return question entete mere
        $qst_fille = $evaluation->findAllQuestionFille(); // return question a l'interieur de question mere
        $data = $fonct->findWhereMulitOne('v_stagiaire_groupe_interne',['stagiaire_id','groupe_id'],[$stg_id,request()->groupe]); // return les information du project avec detail et information du stagiaire

        return view("projet_interne.evaluationChaud_interne", compact('data', 'champ_reponse', 'qst_mere', 'qst_fille'));
    }

    public function insertion_evaluationChaud_interne(Request $request)
    {
        DB::beginTransaction();
        try{
            $fonct = new FonctionGenerique();
            $user_id = Auth::user()->id;
            $stg_id = stagiaire::where('user_id',$user_id)->value('id');

            $note = $request->nb_qst_fille_1;
            $commentaire = $request->txt_qst_fille_20;
            $module = $fonct->findWhereMulitOne("v_stagiaire_groupe_interne",["groupe_id","stagiaire_id"],[$request->groupe,$stg_id]);
            // DB::insert('insert into avis(stagiaire_id,module_id,note,commentaire,status,date_avis) value(?,?,?,?,?,?)',[$stg_id,$module->module_id,$note,$commentaire,'Fini',date('Y-m-d')]);
            $evaluation = new EvaluationChaudInterne();

            $message = $evaluation->verificationEvaluation($module->stagiaire_id,$module->groupe_id,$request);
            // dd($message);
            DB::commit();

            return redirect()->route('liste_projet',[1]);
            // return back()->with('avis','avis pour la formation');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error_evaluation',$message);
        }
    }

    public function evaluation_chaud_pdf(Request $request){
        try{
           $eval = new EvaluationChaudInterne();
           $groupe = $request->groupe_id;
           // preparation de la formation
           // q1
               $res_q1 = $eval->pourcentage_point($groupe,3);
               $note_10_q1 = $eval->note_question($groupe,3);

               if(count($res_q1)<=0 || count($note_10_q1) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
            //    dd($res_q1,$note_10_q1);
           //
           // q2
               $res_q2 = $eval->pourcentage_point($groupe,4);
               $note_10_q2 = $eval->note_question($groupe,4);
               if(count($res_q2)<=0 || count($note_10_q2) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
               // dd($res_q2,$note_10_q2);
           // end

           // organistion de la formation
           // q3
               $res_q3 = $eval->pourcentage_point($groupe,6);
               $note_10_q3 = $eval->note_question($groupe,6);
               if(count($res_q3)<=0 || count($note_10_q3) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // Deroulement de la formation
           // q4
               $res_q4 = $eval->pourcentage_point($groupe,7);
               $note_10_q4 = $eval->note_question($groupe,7);
               if(count($res_q4)<=0 || count($note_10_q4) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           //
           // q5
               $res_q5 = $eval->pourcentage_point($groupe,8);
               $note_10_q5 = $eval->note_question($groupe,8);
               if(count($res_q5)<=0 || count($note_10_q5) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           //
           // q6
               $res_q6 = $eval->pourcentage_point($groupe,9);
               $note_10_q6 = $eval->note_question($groupe,9);
               if(count($res_q6)<=0 || count($note_10_q6) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           //le rythme de la formation
           // q7
               $res_q7 = DB::select('select * from v_evaluation_chaud_resultat_interne where groupe_id = ? and id_qst_fille = ? and point < 4 order by point desc',[$groupe,10]);
               if(count($res_q7)<=0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // contenu de la formation
           // q8
               $res_q8 = $eval->pourcentage_point($groupe,11);
               $note_10_q8 = $eval->note_question($groupe,11);
               if(count($res_q8)<=0 || count($note_10_q8) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           //
           // q9
               $res_q9 = $eval->pourcentage_point($groupe,12);
               $note_10_q9 = $eval->note_question($groupe,12);
               if(count($res_q9)<=0 || count($note_10_q9) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           //
           // q10
               $res_q10 = $eval->pourcentage_point($groupe,13);
               $note_10_q10 = $eval->note_question($groupe,13);
               if(count($res_q10)<=0 || count($note_10_q10) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // efficacite de la formation
           // q11
               $res_q11 = $eval->pourcentage_point($groupe,15);
               $note_10_q11 = $eval->note_question($groupe,15);
               if(count($res_q11)<=0 || count($note_10_q11) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           //
           // q12
               $res_q12 = $eval->pourcentage_point($groupe,16);
               $note_10_q12 = $eval->note_question($groupe,16);
               if(count($res_q12)<=0 || count($note_10_q12) <= 0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // recommanderiez vous cette formation
           // q13
               $res_q13 = DB::select('select * from v_evaluation_chaud_resultat_interne where groupe_id = ? and id_qst_fille = ? and point < 3 order by point desc',[$groupe,17]);
               if(count($res_q13)<=0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // points forts
           //q14
               $res_q14 = DB::select('select reponse_desc_champ,case when statut = 0 then concat(nom_stagiaire," ",prenom_stagiaire) when statut = 1 then "Anonyme" end stagiaire from v_reponse_evaluationchaud_interne re join stagiaires s on s.id = re.stagiaire_id where groupe_id = ? and id_qst_fille = ?',[$groupe,20]);
               if(count($res_q14)<=0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           // points faibles
           //q15
               $res_q15 = DB::select('select reponse_desc_champ,case when statut = 0 then concat(s.nom_stagiaire," ",s.prenom_stagiaire) when statut = 1 then "Anonyme" end stagiaire from v_reponse_evaluationchaud_interne re join stagiaires s on s.id = re.stagiaire_id where groupe_id = ? and id_qst_fille = ?',[$groupe,21]);
               if(count($res_q15)<=0){
                   throw new Exception('Impossible de télécharger le pdf.');
               }
           // end

           $session = DB::select('select nom_module,nom_formation,date_debut,date_fin from v_groupe_projet_module_interne where groupe_id = ?',[$groupe])[0];

           return view('projet_interne.resultat_evaluation_chaud_interne_pdf',compact('session','res_q1','note_10_q1','res_q2','note_10_q2','res_q3','note_10_q3','res_q4','note_10_q4','res_q5','note_10_q5','res_q6','note_10_q6','res_q7','res_q8','note_10_q8',
           'res_q9','note_10_q9','res_q10','note_10_q10','res_q11','note_10_q11','res_q12','note_10_q12','res_q13','res_q14','res_q15'));
           // return $pdf->download('Resulat_evaluation_a_chaud.pdf');
       }catch(Exception $e){
           return back()->with('pdf_error','Evaluation à chaud pas encore disponible.');
       }
   }
}


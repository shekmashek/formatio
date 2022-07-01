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
        // dd($formateur);
        return view('projet_interne.detail_session_interne',compact('module_session','etp_id','formateur','datas','projet','stagiaire','competences','presence_detail','modalite','lieu_formation','salle_formation','ressource'));
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
}


<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\RapportFinale;
use App\Models\FonctionGenerique;
use PDF;
use Illuminate\Support\Facades\DB;
//use Charts;

use Illuminate\Http\Request;

class RapportFinaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index()
    {
    }

    public function rapport(Request $req)
    {
        $data = array();
        $fonct = new FonctionGenerique();

        $projet_id = $req->projet_id;
        $entreprise_id = $req->entreprise_id;
        $para=["entreprise_id","projet_id"];
        $val=[$req->entreprise_id,$req->projet_id];
        $para2=["projet_id"];
        $val2=[$req->projet_id];

        $data["projet"] = $fonct->findWhereMulitOne("v_projetentreprise",$para,$val);
        $data["formateurs"] = $fonct->findWhere("v_liste_formateur_projet ",$para2,$val2);
        $data["toutformateurs"] =  $fonct->findAll("formateurs");
        $data["groupes"] = $fonct->findWhere("v_groupe_projet",$para2,$val2);
        $data["stagiaires"] =$fonct->findWhere("v_participant_groupe",$para2,$val2);
        $data["detail_formation"] = $fonct->findWhere("v_date_formation",$para2,$val2);
        $data["but_objectif"] = $fonct->findAllQuery("SELECT  lieu,projet_id,module_id,reference,nom_module FROM v_detail_groupe_module_projet  where projet_id='".$req->projet_id."' group by lieu,projet_id,module_id,reference,nom_module");
        $data["detail_activiter"] = $fonct->findWhere("v_detailmoduleformationprojetformateur",$para2,$val2);
        $data["pedagogique"] = $fonct->findAll("pedagogique");
        $data["obj_pedagogique"] = $fonct->findWhere("objectif_pedagogique",$para2,$val2);
        $data["desc_objectif"] = $fonct->findAll("but_objectif");
        $data["data_desc_objectif"] = $fonct->findWhere("objectif_globaux",$para2,$val2);
        $data["feed_back"] = $fonct->findWhereMulitOne("feed_back",$para2,$val2);
        $data["conclusion"] = $fonct->findWhere("conclusion",$para2,$val2);
        $data["evaluation_resultat"] = $fonct->findWhere("evaluation_resultat",$para2,$val2);
        $data["desc_recommandation"] = $fonct->findAll("recommandation");
        $data["data_desc_recommandation"] = $fonct->findWhere("detail_recommandation",$para2,$val2);
        $data["evaluation_action_formation"] =  $fonct->findWhere("v_evaluation_action_formation",$para2,$val2);
        $data["globale_evaluation_action_formation"] =  $fonct->findWhereMulitOne("v_pourcent_globale_evaluation_action_formation",$para2,$val2);
        $data["programme_detail_activiter"] =  $fonct->findWhere("v_programme_detail_activiter",$para2,$val2);
        $data["trie_detail_date"] =  $fonct->findWhere("v_trie_detail_date",$para2,$val2);
        $data["trie_detail_programme"] =  $fonct->findWhere("v_trie_detail_programme",$para2,$val2);

        $data["stagiaire_evaluation_apprenant"] =  $fonct->findWhere("v_evaluation_apprenant",$para2,$val2);
        $labels = array();
        $dataset = array();

        for($j=0;$j<count($data["stagiaire_evaluation_apprenant"]);$j+=1){
            $labels[] = $data["stagiaire_evaluation_apprenant"][$j]->nom_stagiaire.' '.$data["stagiaire_evaluation_apprenant"][$j]->prenom_stagiaire;
            $dataset[] = $data["stagiaire_evaluation_apprenant"][$j]->note_avant;
        }
        $colours[0] = "GREEN";
        $colours[1] = "BLUE";
        $data["chart"]["labels"] = $labels;
        $data["chart"]["dataset"] = $dataset;
        $data["chart"]["colours"] = $colours;


        $lieu_string="";

        for($i=0;$i<count($data["detail_formation"]);$i++){
                $lieu_string.="(".$data["detail_formation"][$i]->lieu.")";
                if($i+1<count($data["detail_formation"])){
                    $lieu_string.=",";
                }
        }
        $data["lieu_string"] = $lieu_string;

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.pdf.pdf_rapport_finale',compact('data'));
        return $pdf->download('Rapport finale '.$data["projet"]->nom_etp.' sur le projet '.$data["projet"]->nom_projet.'.pdf');
    }


    public function create()
    {
        //
    }


    public function new(Request $req)
    {
        $data = array();
        $fonct = new FonctionGenerique();

        $projet_id = $req->projet_id;
        $entreprise_id = DB::select('select entreprise_id from v_groupe_projet_entreprise where projet_id = ?', [$projet_id])[0]->entreprise_id;

        $para=["entreprise_id","projet_id"];
        $val=[$entreprise_id,$req->projet_id];
        $para2=["projet_id"];
        $val2=[$req->projet_id];

        $data["projet"] = $fonct->findWhereMulitOne("v_groupe_projet_entreprise",$para,$val);

        $data["formateurs"] = $fonct->findWhere("v_formateur_projet ",$para2,$val2);
        $data["toutformateurs"] =  $fonct->findAll("formateurs");
        $data["groupes"] = $fonct->findWhere("v_groupe_projet_entreprise_module",$para2,$val2);

        $data["stagiaires"] =$fonct->findWhere("v_stagiaire_groupe",$para2,$val2);
        $data["stagiaire_evaluation_apprenant"] =  $fonct->findWhere("v_evaluation_apprenant",$para2,$val2);


        $data["verify_stagiaire_evaluation_apprenant"] =  array();
        for($i=0;$i<count($data["stagiaires"]);$i+=1){
            $temp = $fonct->findWhereMulitOne("detail_evaluation_apprenants",["participant_groupe_id"],[$data["stagiaires"][$i]->participant_groupe_id]);

            if($temp == null){
                $data["verify_stagiaire_evaluation_apprenant"][] = $data["stagiaires"][$i];
            }
        }

        $data["detail_formation"] = $fonct->findWhere("v_date_formation",$para2,$val2);
        $data["but_objectif"] = $fonct->findAllQuery("SELECT  lieu,projet_id,module_id,reference,nom_module FROM v_detailmodule  where projet_id='".$req->projet_id."' group by lieu,projet_id,module_id,reference,nom_module");
        $data["pedagogique"] = $fonct->findAll("pedagogique");
        $data["obj_pedagogique"] = $fonct->findWhere("objectif_pedagogique",$para2,$val2);
        $data["desc_objectif"] = $fonct->findAll("but_objectif");
        $data["data_desc_objectif"] = $fonct->findWhere("objectif_globaux",$para2,$val2);
        $data["feed_back"] = $fonct->findWhereMulitOne("feed_back",$para2,$val2);
        $data["conclusion"] = $fonct->findWhere("conclusion",$para2,$val2);
        $data["evaluation_resultat"] = $fonct->findWhere("evaluation_resultat",$para2,$val2);
        $data["desc_recommandation"] = $fonct->findAll("recommandation");
        $data["data_desc_recommandation"] = $fonct->findWhere("detail_recommandation",$para2,$val2);

        $data["evaluation_action_formation"] =  $fonct->findWhere("v_evaluation_action_formation",$para2,$val2);
        $data["totale_evaluation_action_formation"] =  $fonct->findAll("evaluation_action_formation");
        $data["globale_evaluation_action_formation"] =  $fonct->findWhereMulitOne("v_pourcent_globale_evaluation_action_formation",$para2,$val2);

        $data["verify_evaluaction_action_formation"] =  array();
        for($i=0;$i<count($data["totale_evaluation_action_formation"]);$i+=1){
            $temp = $fonct->findWhereMulitOne("detail_evaluation_action_formation",["evaluation_action_formation_id","projet_id"],[$data["totale_evaluation_action_formation"][$i]->id,$projet_id]);

            if($temp == null){
                $data["verify_evaluaction_action_formation"][] = $data["totale_evaluation_action_formation"][$i];
            }
        }

        $lieu_string="";

        for($i=0;$i<count($data["detail_formation"]);$i++){
                $lieu_string.="(".$data["detail_formation"][$i]->lieu.")";
                if($i+1<count($data["detail_formation"])){
                    $lieu_string.=",";
                }
        }
        $data["lieu_string"] = $lieu_string;
        return view("admin.rapport_finale.nouveau_rapport_finale",compact('data'));
    }

    public function store(Request $request)
    {

    }


    public function show($id)
    {
    }


    public function edit(RapportFinale $rapportFinale)
    {
        //
    }


    public function update(Request $request, RapportFinale $rapportFinale)
    {
        //
    }

    public function destroy(RapportFinale $rapportFinale)
    {
        //
    }

    //=====================================  ajout somaire de rapport finale

    public function desc_objectif($idProjet,Request $request)
    {
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];
        $but_objectif = $fonct->findAll("but_objectif");
        try{
            for($i=0;$i<count($but_objectif);$i+=1)
                {
                    $temp = $request["desc_objectif_".$but_objectif[$i]->id];
                    if($temp!=NULL || $temp!=""){
                        $rapport->insert_obj_globau($temp,$but_objectif[$i]->id,$idProjet);
                    }
                }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_objectif_globaux','nouveaux information a été effectuer!');
    }


    public function put_desc_objectif($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_obj_globau($request["object_globaux_".$id],$id);
        return back()->with('success_update_objectif_globaux_'.$id,'modification formation est effectuer!');
    }

    public function delete_desc_objectif($id,$id_but_obj){
        $rapport = new RapportFinale();
        $rapport->delete_obj_globau($id);
        return back()->with('success_delete_objectif_globaux_'.$id_but_obj,'suppression formation est effectuer!');
    }

    //====================================== Pedagogique
    public function new_pedagogique($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];
        $pedagogique = $fonct->findAll("pedagogique");
        try{
            for($i=0;$i<count($pedagogique);$i+=1)
                {
                    $temp = $request["pedagogique_".$pedagogique[$i]->id];
                    if($temp!=NULL || $temp!=""){
                        $rapport->insert_objectif_pedagogique($temp,$pedagogique[$i]->id,$idProjet);
                    }
                }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_pedagogique','nouveaux information a été effectuer!');
    }

    public function put_pedagogique($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_objectif_pedagogique($request["edit_pedagogique_".$id],$id);
        return back()->with('success_update_objectif_pedagogique_'.$id,'modification formation est effectuer!');
    }

    public function delete_pedagogique($id,$id_but_obj){
        $rapport = new RapportFinale();
        $rapport->delete_objectif_pedagogique($id);
        return back()->with('success_delete_objectif_pedagogique_'.$id_but_obj,'suppression formation est effectuer!');
    }


    // =============== conclusion

    public function new_conclusion($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];
        try{
                $temp = $request["conclusion_data"];
                if($temp!=NULL || $temp!=""){
                    $rapport->insert_objectif_conclusion($temp,$idProjet);
                }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_conclusion','nouveaux information a été effectuer!');
    }

    public function put_conclusion($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_objectif_conclusion($request["edit_conclusion_".$id],$id);
        return back()->with('success_update_conclusion_'.$id,'modification formation est effectuer!');
    }

    public function delete_conclusion($id){
        $rapport = new RapportFinale();
        $rapport->delete_objectif_conclusion($id);
        return back()->with('success_delete_conclusion','suppression formation est effectuer!');
    }

    // ====================== Feed back

    public function new_feedback($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];
        try{
                $temp = $request["feedback_data"];
                if($temp!=NULL || $temp!=""){
                    $rapport->insert_objectif_feedback($temp,$idProjet);
                }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_feedback','nouveaux information a été effectuer!');
    }

    public function update_feedback($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_objectif_feedback($request["edit_feedback"],$id);
        return back()->with('success_update_feedback','modification formation est effectuer!');
    }

    public function delete_feedback($id){
        $rapport = new RapportFinale();
        $rapport->delete_objectif_feedback($id);
        return back()->with('success_delete_feedback','suppression formation est effectuer!');
    }

    //============================================= evaluation_resultat

    public function new_evaluation_resultat($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];
        try{
                $temp = $request["evaluation_resultat_data"];
                if($temp!=NULL || $temp!=""){
                    $rapport->insert_evaluation_resultat($temp,$idProjet);
                }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_evaluation_resultat','nouveaux information a été effectuer!');
    }

    public function update_evaluation_resultat($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_evaluation_resultat($request["edit_evaluation_resultat"],$id);
        return back()->with('success_update_evaluation_resultat_'.$id,'modification formation est effectuer!');
    }

    public function delete_evaluation_resultat($id){
        $rapport = new RapportFinale();
        $rapport->delete_evaluation_resultat($id);
        return back()->with('success_delete_evaluation_resultat','suppression formation est effectuer!');
    }

    //============================================ Recommandation

    public function new_recommandation($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $desc_recommandation = $fonct->findAll("recommandation");
        $para2=["projet_id"];
        $val2=[$idProjet];
        try{
            for($i=0;$i<count($desc_recommandation);$i+=1){

                $temp = $request["data_recommandation_".$desc_recommandation[$i]->id];
                if($temp!=NULL || $temp!=""){
                    $rapport->insert_recommandation($temp,$desc_recommandation[$i]->id,$idProjet);
                }
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return back()->with('success_recommandation_2','nouveaux information a été effectuer!');
    }

    public function update_recommandation($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_recommandation($request["edit_recommandation_".$id],$id);
        return back()->with('success_update_recommandation_'.$id,'modification formation est effectuer!');
    }

    public function delete_recommandation($id,$id_recommandation){
        $rapport = new RapportFinale();
        $rapport->delete_recommandation($id);
        return back()->with('success_delete_recommandation_'.$id_recommandation,'suppression formation est effectuer!');
    }

    //================================ Evaluation de l'action de formation


    public function new_evaluation_action_formation($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];

        $evaluation_action_formation = $fonct->findAll("evaluation_action_formation");
        try{
            for($i=0;$i<count($evaluation_action_formation);$i+=1){

                $temp = $request["evaluation_action_formation_data_".$evaluation_action_formation[$i]->id];

                if($temp!=NULL || $temp!=""){
                    $rapport->insert_evaluation_action_formation($temp,$evaluation_action_formation[$i]->id,$idProjet);
                }
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    return back()->with('success_evaluation_action_formation','nouveaux information a été effectuer!');
    }

    public function update_evaluation_action_formation($id,$idProjet,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_evaluation_action_formation($request["edit_evaluation_action_formation_".$id],$id,$idProjet);

        return back()->with('success_update_evaluation_action_formation'.$id,'modification formation est effectuer!');
    }

    public function delete_evaluation_action_formation($id){
        $rapport = new RapportFinale();
        $rapport->delete_evaluation_action_formation($id);
        return back()->with('success_delete_evaluation_action_formation','suppression formation est effectuer!');
    }

    // =========================== Candidat


    public function update_note_candidat($id,Request $request){
        $rapport = new RapportFinale();
        $rapport->update_note_candidat($request["note_avant_edit_".$id],$request["note_apres_edit_".$id],$id);
        return back()->with('success_update_note_candidat'.$id,'modification formation est effectuer!');
    }

    public function delete_note_candidat($id){
        $rapport = new RapportFinale();
        $rapport->delete_note_candidat($id);
        return back()->with('success_delete_note_candidat','suppression formation est effectuer!');
    }

    public function new_note_candidat($idProjet,Request $request){
        $rapport = new RapportFinale();
        $fonct = new FonctionGenerique();
        $para2=["projet_id"];
        $val2=[$idProjet];

        $stagiaires = $fonct->findWhere("v_participant_groupe",$para2,$val2);

        try{
            for($i=0;$i<count($stagiaires);$i+=1){

                $temp1 = $request["note_avant_data_".$stagiaires[$i]->participant_groupe_id];
                $temp2 = $request["note_apres_data_".$stagiaires[$i]->participant_groupe_id];

                if($temp1!=NULL || $temp1!="" || $temp2!=NULL || $temp2!="" ){
                    $rapport->insert_note_candidat($temp1,$temp2,$stagiaires[$i]->participant_groupe_id);
                }
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    return back()->with('success_note_candidat','nouveaux information a été effectuer!');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\FonctionGenerique;
use Exception;
class EvaluationChaudInterne extends Model
{
    protected $table = "reponse_evaluationchaud_interne";
    public $v_mere="v_question_mere";
    public $qst_mere="question_mere";
    public $qst_fille="question_fille";
    public $type_champ="type_champs";

    protected $fillable = [
        'reponse_desc_champ','id_desc_champ','stagiaire_id','groupe_interne_id','points'
    ];

    // find v_question_mere
    public function findAllChampReponse(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll("description_champ_reponse");
    }

      // find question mere
    public function findAllQuestionMere(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll("question_mere");
    }

      // find question fille
    public function findAllQuestionFille(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll("v_question_fille");
    }

      // find question type champs
    public function findAllTypeChamp(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll("type_champs");
    }



    //=============== ajout reponse formulaire de l'evaluation  à chaud par le stagiaire
    public function insertTeste($reponse,$id_desc_champ,$id_stag,$id_detail){
        $evaluation = new EvaluationChaud();
        $evaluation->reponse_desc_champ =  $reponse;
        $evaluation->id_desc_champ =  $id_desc_champ;
        $evaluation->stagiaire_id =  $id_stag;
        $evaluation->detail_id =  $id_detail;
        $evaluation->save();
    }

    public function verifyExistsEvaluationChaud($id_stag,$groupe_id){
        $verify = DB::select('select (count(stagiaire_id)) verify from reponse_evaluationchaud_interne where stagiaire_id = ? and groupe_interne_id = ?', [$id_stag,$groupe_id]);
        return $verify[0]->verify;
    }

    public function insert($point,$reponse,$id_desc_champ,$id_stag,$groupe_id,$anonyme){

        DB::beginTransaction();

        try {
            DB::insert("insert into reponse_evaluationchaud_interne(points,reponse_desc_champ,id_desc_champ,stagiaire_id,groupe_interne_id,statut) values (?,?,?,?,?,?)",
            [$point,$reponse,$id_desc_champ,$id_stag,$groupe_id,$anonyme]);
            DB::commit();
            $message['success']="Votre évaluation à chaud est terminée avec succès.";
        } catch (Exception $e) {
            DB::rollback();
            $message['error']="Désolé, votre évaluation a échoué, veuillez recommencer merci.";
            throw $e;
        }
        return $message;
    }

    public function controlleCreationEvaluation($id_stag,$groupe_id,$imput)
    {
        $qst_fille = $this->findAllQuestionFille(); // return question a l'interieur de question mere
        $type_champ = $this->findAllChampReponse();

        $valiny = array();
        for($i=0;$i<count($qst_fille);$i+=1)
        {
            if ($qst_fille[$i]->desc_champ == "NOMBRE")
            {
                $valiny['result'][$i] = $imput["nb_qst_fille_".$qst_fille[$i]->id];
                $valiny['id_champ'][$i] = $imput["id_champ_".$qst_fille[$i]->id];
                $valiny['point'][$i] = $imput["nb_qst_fille_".$qst_fille[$i]->id];
            } elseif ($qst_fille[$i]->desc_champ == "TEXT")
            {
                $valiny['result'][$i] = $imput["txt_qst_fille_".$qst_fille[$i]->id];
                $valiny['id_champ'][$i] = $imput["id_champ_".$qst_fille[$i]->id];
                $valiny['point'][$i] = 0;
            } else
            {
                $tmp = $imput["case_qst_fille_".$qst_fille[$i]->id];
                $str= explode("concat", $tmp);
                $valiny['result'][$i] =$str[0];
                $valiny['id_champ'][$i] = $str[1];
                $valiny['point'][$i] = $str[2];
            }
        }
        // DB::enableQueryLog();
        // DB::insert('insert into reponse_evaluationchaud(points,reponse_desc_champ,id_desc_champ,stagiaire_id,groupe_id,cfp_id,created_at,updated_at) values(?,?,?,?,?,?,NOW(),NOW())',[$valiny['point'][16],$valiny['result'][16],$valiny['id_champ'][16],$id_stag,$groupe_id,$cfp_id]);
        $anonyme = 0;
        $imput->has('anonyme') ? $anonyme = 1 : $anonyme = 0;
        //============ insert multiple
        for ($j=0; $j <count($valiny['result']) ; $j++) {
            $message= $this->insert($valiny['point'][$j],$valiny['result'][$j],$valiny['id_champ'][$j],$id_stag,$groupe_id,$anonyme);
        }
        // dd(DB::getQueryLog());
        return $message;
    }

    public function verificationEvaluation($id_stag,$groupe_id,$imput){


        $verify = $this->verifyExistsEvaluationChaud($id_stag,$groupe_id);
        if($verify<=0)
        {
            $message = $this->controlleCreationEvaluation($id_stag,$groupe_id,$imput);
        } else {
            $message['error']="Oups! votre evaluation sur cette project est déjà fait,merci beaucoup de diligence";
        }

        return $message;
    }

    public function getDetailResponseEvaluationChaud($stagiaire_id){
        $fonction = new FonctionGenerique();
        $data  = $fonction->findWhere("v_evaluation_chaud_resultat_interne",["stagiaire_id"],[$stagiaire_id]);
        return $data;
    }

    public function pourcentage_point($groupe,$id_qst){
        return DB::select('select groupe_id,id_qst_fille,qst_fille,nombre_stg,note_sur_10,pourcentage from v_evaluation_chaud_resultat_interne where id_qst_fille = ? and groupe_id = ? order by point desc',[$id_qst,$groupe]);
    }

    public function note_question($groupe,$id_qst){
        return DB::select('select id_qst_fille,sum(note_sur_10) as note from v_evaluation_chaud_resultat_interne where id_qst_fille = ? and groupe_id = ? group by id_qst_fille',[$id_qst,$groupe]);
    }

}

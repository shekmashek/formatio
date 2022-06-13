<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\FonctionGenerique;
use Exception;

class EvaluationChaud extends Model
{
    protected $table = "reponse_evaluationchaud";
    public $v_mere="v_question_mere";
    public $qst_mere="question_mere";
    public $qst_fille="question_fille";
    public $type_champ="type_champs";

    protected $fillable = [
        'reponse_desc_champ','id_desc_champ','stagiaire_id','detail_id','created_at','updated_at'
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


    public function findDetailProject($matricule,$session_id){
        $fonction = new FonctionGenerique();

        // $stagiaire = $fonction->findWhereOne("v_stagiaire_groupe","matricule","=",$matricule);
        // dd($stagiaire);
        $detail = $fonction->findWhereMulitOne("v_participant_groupe_detail",['matricule','groupe_id'],[$matricule,$session_id]);

        // $data['stagiaire'] = $stagiaire;
        return $detail;
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
        $verify = DB::select('select (count(stagiaire_id)) verify from reponse_evaluationchaud where stagiaire_id = ? and groupe_id = ?', [$id_stag,$groupe_id]);
        return $verify[0]->verify;
    }

    public function insert($point,$reponse,$id_desc_champ,$id_stag,$groupe_id,$cfp_id){

        DB::beginTransaction();

        try {
            DB::insert("insert into reponse_evaluationchaud(points,reponse_desc_champ,id_desc_champ,stagiaire_id,groupe_id,cfp_id,created_at,updated_at) values (?,?,?,?,?,?,NOW(),NOW())",
            [$point,$reponse,$id_desc_champ,$id_stag,$groupe_id,$cfp_id]);
            DB::commit();
            $message['success']="Votre évaluation à chaud est terminée avec succès.";
        } catch (Exception $e) {
            DB::rollback();
            $message['error']="Désolé, votre évaluation a échoué, veuillez recommencer merci.";
            throw $e;
        }
        return $message;
    }

    public function controlleCreationEvaluation($id_stag,$groupe_id,$cfp_id,$imput)
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
        
        //============ insert multiple
        for ($j=0; $j <count($valiny['result']) ; $j++) {
            $message= $this->insert($valiny['point'][$j],$valiny['result'][$j],$valiny['id_champ'][$j],$id_stag,$groupe_id,$cfp_id);
        }
        // dd(DB::getQueryLog());
        return $message;
    }

        public function verificationEvaluation($id_stag,$groupe_id,$cfp_id,$imput){


            $verify = $this->verifyExistsEvaluationChaud($id_stag,$groupe_id);
            if($verify<=0)
            {
                $message = $this->controlleCreationEvaluation($id_stag,$groupe_id,$cfp_id,$imput);
            } else {
                $message['error']="Oups! votre evaluation sur cette project est déjà fait,merci beaucoup de diligence";
            }

            return $message;
        }

        public function getDetailResponseEvaluationChaud($stagiaire_id){
            $fonction = new FonctionGenerique();
            $data  = $fonction->findWhere("v_reponse_evaluationchaud",["stagiaire_id"],[$stagiaire_id]);
            return $data;
        }


// fonction ajout evaluation à chaud
        public function insert_qste_mere($qte_mere,$desc){

            $data = [$qte_mere,$desc];

            DB::beginTransaction();
            try {
                DB::insert("INSERT INTO question_mere(qst_mere,desc_reponse,created_at,updated_at) values (?,?,NOW(),NOW())",
                $data);
                DB::commit();
                $message['success']="Votre question d'évaluation à chaud est bien enregistrer avec succèss !";
            } catch (\Exception $e) {
                DB::rollback();
                $message['error']="Désoler,pendant votre evaluation il y en a des bug de connection, veuillez recommencer merci";
                throw $e;
            }
            return $message;
        }

public function insert_qste_fille($question_fille,$id_type_champ,$id_qste_mere){
    DB::beginTransaction();

    try {
        DB::insert("INSERT INTO question_fille(qst_fille ,created_at,updated_at,id_type_champs,id_qst_mere) values (?,NOW(),NOW(),?,?)",

        [$question_fille,$id_type_champ,$id_qste_mere]);
        DB::commit();
        $message['success']="Votre question d'évaluation à chaud est bien enregistrer avec succèss !";
    } catch (\Exception $e) {
        DB::rollback();
        $message['error']="Désoler,pendant votre evaluation il y en a des bug de connection, veuillez recommencer merci";
        throw $e;
    }
    return $message;

}

public function insert_desc_champ_reponse($desc,$id_qst_fille,$nb_max){

    DB::beginTransaction();

    try {
            if($nb_max == null){
                DB::insert("INSERT INTO description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at) values (?,?,null,NOW(),NOW())",[$desc,$id_qst_fille]);
            } else {
                DB::insert("INSERT INTO description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at) values (?,?,?,NOW(),NOW())",[$desc,$id_qst_fille,$nb_max]);
            }
            DB::commit();
        $message['success']="Votre question d'évaluation à chaud est bien enregistrer avec succèss !";
    } catch (\Exception $e) {
        DB::rollback();
        $message['error']="Désoler,pendant votre evaluation il y en a des bug de connection, veuillez recommencer merci";
        throw $e;
    }
    return $message;

}


    public function verify_insert_qste($request)
    {
        $fonct = new FonctionGenerique();

        $type_champ_id = $fonct->findWhereMulitOne("type_champs",["desc_champ"],[$request->type_champ]);
        $qste_mere = $fonct->findWhereMulitOne("question_mere",["qst_mere"],[$request->qstmere]);

        if($request->qstmere!= null && count($request["desc_reponse_qste_fille"]) >0 ){

            if($qste_mere == null)
            {
                $msg1 = $this->insert_qste_mere($request->qstmere,$request->descmere);
                $qste_mere = $fonct->findWhereMulitOne("question_mere",["qst_mere"],[$request->qstmere]);


                    $qste_fille = $fonct->findWhereMulitOne("question_fille",["qst_fille","id_qst_mere","id_type_champs"],[$request->qstfille,$qste_mere->id,$type_champ_id->id]);
                    if($qste_fille == null)
                    {
                        $msg2 = $this->insert_qste_fille($request->qstfille,$type_champ_id->id,$qste_mere->id);
                        $qste_fille = $fonct->findWhereMulitOne("question_fille",["qst_fille","id_qst_mere","id_type_champs"],[$request->qstfille,$qste_mere->id,$type_champ_id->id]);

                        for ($i=0; $i <count($request["desc_reponse_qste_fille"]) ; $i++)
                            {
                                if($request["nb_max_desc__reponse_fille"]!=null){
                                    $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,$request["nb_max_desc__reponse_fille"][$i]);
                                } else {
                                    $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,null);
                                }
                            }
                    } else
                    {
                        for ($i=0; $i <count($request["desc_reponse_qste_fille"]) ; $i++)
                        {
                            if($request["nb_max_desc__reponse_fille"]!=null){
                                $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,$request["nb_max_desc__reponse_fille"][$i]);
                            } else {
                                $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,null);
                            }
                        }

                    }

            } else
            {
                    $qste_fille = $fonct->findWhereMulitOne("question_fille",["qst_fille","id_qst_mere","id_type_champs"],[$request->qstfille,$qste_mere->id,$type_champ_id->id]);
                    if($qste_fille == null)
                    {
                        $msg2 = $this->insert_qste_fille($request->qstfille,$type_champ_id->id,$qste_mere->id);
                        $qste_fille = $fonct->findWhereMulitOne("question_fille",["qst_fille","id_qst_mere","id_type_champs"],[$request->qstfille,$qste_mere->id,$type_champ_id->id]);

                        for ($i=0; $i <count($request["desc_reponse_qste_fille"]) ; $i++)
                            {
                                if($request["nb_max_desc__reponse_fille"]!=null){
                                    $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,$request["nb_max_desc__reponse_fille"][$i]);
                                } else {
                                    $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,null);
                                }
                            }
                    } else
                    {
                        for ($i=0; $i <count($request["desc_reponse_qste_fille"]) ; $i++)
                        {
                            if($request["nb_max_desc__reponse_fille"]!=null){
                                $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,$request["nb_max_desc__reponse_fille"][$i]);
                            } else {
                                $msg3 = $this->insert_desc_champ_reponse($request["desc_reponse_qste_fille"][$i],$qste_fille->id,null);
                            }
                        }

                    }
            }

            return back();
        } else {
            return back()->with("error","champ vide");
        }

    }


    public function pourcentage_point($groupe,$id_qst){
        return DB::select('select groupe_id,id_qst_fille,qst_fille,nombre_stg,note_sur_10,pourcentage from v_evaluation_chaud_resultat where id_qst_fille = ? and groupe_id = ? order by point desc',[$id_qst,$groupe]);
    //     return DB::select('
    //     select
    //     qfp.groupe_id,
    //     qfp.id_qst_fille,
    //     qfp.qst_fille,
    //     qfp.point,
    //     ifnull(ec.points, 0) as point_eval,
    //     qfp.point_max,
    //     ifnull(ec.nombre_stg, 0) as nombre_stg,
    //     ifnull(ec.total_stagiaire, 0) as total_stagiaire,
    //     ifnull(
    //         ROUND(
    //             (
    //                 (ec.nombre_stg * ec.points) /(ec.total_stagiaire * qfp.point_max)
    //             ) * 10,
    //             1
    //         ),
    //         0
    //     ) as note_sur_10,
    //     ifnull(
    //         ROUND(
    //             (
    //                 (ec.nombre_stg * ec.points) /(ec.total_stagiaire * qfp.point_max)
    //             ) * 100,
    //             1
    //         ),
    //         0
    //     ) as pourcentage
    // from
    //     v_question_fille_point qfp
    //     left join v_evaluation_chaud ec on qfp.id_qst_fille = ec.id_qst_fille and qfp.point = ec.points
    //     where qfp.groupe_id = ? and qfp.id_qst_fille = ?
    //     group by 
    //         qfp.groupe_id,
    //         qfp.id_qst_fille,
    //         qfp.qst_fille,
    //         qfp.point,
    //         qfp.point_max;
    //     ',[$groupe,$id_qst]);
    }

    public function note_question($groupe,$id_qst){
        return DB::select('select id_qst_fille,sum(note_sur_10) as note from v_evaluation_chaud_resultat where id_qst_fille = ? and groupe_id = ? group by id_qst_fille',[$id_qst,$groupe]);
    }


}

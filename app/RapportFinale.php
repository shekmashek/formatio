<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class RapportFinale extends Model
{


    // =======================  objectif globaux

    public function insert_obj_globau($data,$obj_id,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into objectif_globaux (description, but_objectif_id, projet_id, created_at, updated_at) values (?, ?, ?, NOW(), NOW())', [$data,$obj_id,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_obj_globau($data,$id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("update objectif_globaux set description = '".$data."',updated_at=NOW() where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_obj_globau($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from  objectif_globaux where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    //=================== Pedagogique

    public function insert_objectif_pedagogique($data,$obj_id,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into objectif_pedagogique (description, pedagogique_id, projet_id, created_at, updated_at) values (?, ?, ?, NOW(), NOW())', [$data,$obj_id,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_objectif_pedagogique($data,$obj_id){
        DB::beginTransaction();
        try{
            DB::update("update objectif_pedagogique set description = '".$data."',updated_at=NOW() where id=?", [$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_objectif_pedagogique($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from  objectif_pedagogique where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    //================ Conclusion

    public function insert_objectif_conclusion($data,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into conclusion (description , projet_id, created_at, updated_at) values (?, ?, NOW(), NOW())', [$data,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_objectif_conclusion($data,$obj_id){
        DB::beginTransaction();
        try{
            DB::update("update conclusion set description = '".$data."',updated_at=NOW() where id=?", [$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_objectif_conclusion($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from  conclusion where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    // ========================== feed back

    public function insert_objectif_feedback($data,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into  feed_back (description , projet_id, created_at, updated_at) values (?, ?, NOW(), NOW())', [$data,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_objectif_feedback($data,$obj_id){
        DB::beginTransaction();
        try{
            DB::update("update feed_back set description = '".$data."',updated_at=NOW() where id=?", [$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_objectif_feedback($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from  feed_back where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    //======================================  evaluation des resultar

    public function insert_evaluation_resultat($data,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into  evaluation_resultat (description , projet_id, created_at, updated_at) values (?, ?, NOW(), NOW())', [$data,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_evaluation_resultat($data,$obj_id){
        DB::beginTransaction();
        try{
            DB::update("update evaluation_resultat set description = '".$data."',updated_at=NOW() where id=?", [$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_evaluation_resultat($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from  evaluation_resultat where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    // ================================ Recommandation

    public function insert_recommandation($data,$obj_id,$id_projet){
        DB::beginTransaction();
        try{
            DB::insert('insert into detail_recommandation (description, recommandation_id, projet_id, created_at, updated_at) values (?, ?, ?, NOW(), NOW())', [$data,$obj_id,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_recommandation($data,$obj_id){
        DB::beginTransaction();
        try{
            DB::update("update detail_recommandation set description = '".$data."',updated_at=NOW() where id=?", [$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function delete_recommandation($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from detail_recommandation where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    // =============================== Evaluation de l'action de formation

    public function insert_evaluation_action_formation($data,$obj_id,$id_projet){
        DB::beginTransaction();
        try{
            $valiny = number_format($data, 3, ',', '.');
            DB::insert('insert into detail_evaluation_action_formation (pourcent, evaluation_action_formation_id, projet_id, created_at, updated_at) values (?, ?, ?, NOW(), NOW())', [$data,$obj_id,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_evaluation_action_formation($data,$obj_id,$id_projet){
        DB::beginTransaction();
        try{
            $valiny = number_format($data, 3, ',', '.');
            DB::update("update detail_evaluation_action_formation set pourcent = ".$data.",updated_at=NOW() where evaluation_action_formation_id=? and projet_id=?", [$obj_id,$id_projet]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }


    public function delete_evaluation_action_formation($id_obj_globau){
        DB::beginTransaction();
        try{
            DB::update("delete from detail_evaluation_action_formation where id=?", [$id_obj_globau]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    //================================== Note candidat
    public function insert_note_candidat($note_avant,$note_apres,$obj_id){
        DB::beginTransaction();
        try{
          //  $valiny = number_format($data, 3, ',', '.');
            DB::insert('insert into detail_evaluation_apprenants (note_avant,note_apres, participant_groupe_id, created_at, updated_at) values (?, ?, ?, NOW(), NOW())', [$note_avant,$note_apres,$obj_id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function update_note_candidat($note_avant,$note_apres,$id_cand_group){
        DB::beginTransaction();
        try{
            $valiny = number_format($note_avant, 3, ',', '.');
            $valiny2 = number_format($note_apres, 3, ',', '.');
            DB::update("update detail_evaluation_apprenants set note_avant = ".$note_avant.",note_apres='".$note_apres."',updated_at=NOW() where id=?", [$id_cand_group]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }


    public function delete_note_candidat($id){
        DB::beginTransaction();
        try{
            DB::update("delete from detail_evaluation_apprenants where participant_groupe_id=?", [$id]);
            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
        }
    }
}

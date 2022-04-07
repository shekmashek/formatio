<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class FonctionGenerique extends Model
{
    // sql generique
    public function queryWhereVerify($nomTab,$para=[],$val=[]){
        $query="SELECT COUNT(id) id FROM ".$nomTab." WHERE ";
        if(count($para) != count($val)){
            return "ERROR: tail des onnees parametre et value est different";
        } else
            {
                for($i=0;$i<count($para);$i++)
                {
                $query.="".$para[$i]."= ?";
                if($i+1 < count($para)){
                    $query.=" AND ";
                }
                }
                return $query;
            }
    }

    public function queryWhere($nomTab,$para=[],$val=[]){
        $query="SELECT * FROM ".$nomTab." WHERE ";
        if(count($para) != count($val)){
            return "ERROR: tail des onnees parametre et value est different";
        } else
            {
                for($i=0;$i<count($para);$i++)
                {
                $query.="".$para[$i]."= ?";
                if($i+1 < count($para)){
                    $query.=" AND ";
                }
                }
                return $query;
            }
    }
    public function queryWhereOr($nomTab,$para=[],$val=[]){
        $query="SELECT * FROM ".$nomTab." WHERE ";
        if(count($para) != count($val)){
            return "ERROR: tail des onnees parametre et value est different";
        } else
            {
                for($i=0;$i<count($para);$i++)
                {
                $query.="".$para[$i]."= ?";
                if($i+1 < count($para)){
                    $query.=" OR ";
                }
                }
                return $query;
            }
    }

    public function queryWherePagination($nomTab,$para=[],$val=[]){
        $query="SELECT * FROM ".$nomTab." WHERE ";
        if(count($para) != count($val)){
            return "ERROR: tail des onnees parametre et value est different";
        } else
            {
                for($i=0;$i<count($para);$i++)
                {
                $query.="".$para[$i]."= '".$val[$i]."'";
                if($i+1 < count($para)){
                    $query.=" AND ";
                }
                }
                return $query;
            }
    }

   //select colonne/* from table where value =  ... => tableau
    public function findWhere($nomTab,$para=[],$val=[]){
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhere($nomTab,$para,$val), $val);
        return $data;
    }
     //select colonne/* from table where value =  ... or  => tableau
    public function findWhereOr($nomTab,$para=[],$val=[]){
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhereOr($nomTab,$para,$val), $val);
        return $data;
    }


     //select colonne/* from table where value =  ... => une seule données
    public function findWhereMulitOne($nomTab,$para=[],$val=[]){
        $fonction = new FonctionGenerique();
        $data =  DB::select($fonction->queryWhere($nomTab,$para,$val), $val);
        if(count($data)<=0){
            return $data;
        } else {
            return $data[0];
        }

    }

    public function verifyGenerique($nomTab,$para=[],$val=[]){
        $fonction = new FonctionGenerique();
        $data =  DB::select($fonction->queryWhereVerify($nomTab,$para,$val), $val);
            return $data[0];
    }

    //select * from

    public function findAll($nomTab){
        $query = "SELECT * FROM ".$nomTab;
        return DB::select($query);
    }


    public function findAllPagination($nomTab,$nom_id,$dernier_id,$nbPage){
        if($dernier_id<=0){
            $dernier_id=1;
        }
        $query = "SELECT * FROM ".$nomTab." WHERE ".$nom_id.">=".$dernier_id." LIMIT ".$nbPage;
        return DB::select($query);
    }

    public function findWherePagination($nomTab,$para=[],$val=[],$name_id,$dernier_id,$nbPage){
        $fonction = new FonctionGenerique();
        $query= $fonction->queryWherePagination($nomTab,$para,$val);
        if($dernier_id<=0){
            $dernier_id=1;
        }
        $query = $query." and ".$name_id." >= ".$dernier_id." LIMIT ".$nbPage;
        $data =  DB::select($query);
        return $data;
    }

    public function findAllQuery($query){
        return DB::select($query);
    }

    public function findWhereOne($nomTab,$para,$opt,$val){
        $query ="SELECT * FROM ".$nomTab." WHERE ".$para." ".$opt."?";
        $data =  DB::select($query, [$val]);
        if(count($data)<=0){
            return $data;
        } else {
            return $data[0];
        }
    }

    public function findById($nomTab,$id){
        $query ="SELECT * FROM ".$nomTab." WHERE id=?";
        $data = DB::select($query, [$id]);
        if(count($data)<=0){
            return $data;
        } else {
            return $data[0];
        }
    }
    public function concatTwoList($etp1,$etp2){
        $tab = array();
        for($i=0;$i<count($etp1);$i+=1){
            $tab[]=$etp1[$i];
        }
        for($j=0;$j<count($etp2);$j+=1){
            $tab[]=$etp2[$j];
        }

        return $tab;
    }



     // ---------------------------------------- Collaboration
     public function getIdCollaborer($list){
        $tab = array();
        for($i=0;$i<count($list);$i+=1){
            $tab[$i]="".$list[$i]->cfp_id;
        }

        return $tab;
    }

    public function getIdNotCollaborer($list){
        $tab = array();
        for($i=0;$i<count($list);$i+=1){
            $tab[$i]="".$list[$i]->id;
        }

        return $tab;
    }

    public function queryCollaborer($nomTab,$list){
        $query = "select * from ".$nomTab." where ";
        $para="";
        $tab = $this->getCfpIdCollaborer($list);
        for($i=0;$i<count($tab);$i+=1){
            $para.=" id = '".$tab[$i]."'";
            if($i+1 < count($tab)){
                $para.=" OR ";
            }
        }
        $query = $query." ".$para;
        return $query;
    }

    public function queryNotCollaborer($nomTab,$list){
        $query = "select * from ".$nomTab." where ";
        $para="";
        $tab = $this->getCfpIdNotCollaborer($list);
        for($i=0;$i<count($tab);$i+=1){
            $para.=$para." id != '".$tab[$i]."'";
            if($i+1 < count($tab)){
                $para.=" AND ";
            }
        }
        $query = $query." ".$para;
        return $query;
    }

    public function getNotCollaborer($nomTab,$list){
        $data = DB::select($this->queryNotCollaborer($nomTab,$list));
        for($i=0;$i<count($data);$i+=1){
            $data[$i]->collaboration = "0";
        }

        return $data;
    }
    public function getCollaborer($nomTab,$list){

        $data = DB::select($this->queryCollaborer($nomTab,$list));
       for($i=0;$i<count($data);$i+=1){
            $data[$i]->collaboration = "1";
        }
        return $data;
    }
// ------------------------------

    public function insert_role_user($user_id,$role_id,$activiter){
        DB::insert('insert into role_users (user_id, role_id,activiter) values (?, ?,?)', [$user_id, $role_id,$activiter]);
    }

    //insertion iframe pour enntreprise et of dans la bd

    public function insert_iframe($table,$colonnes,$id,$iframe){
        DB::insert('insert into '.$table.' ('.$colonnes.', iframe) values (?, ?)', [$id, $iframe]);
    }

    //modification iframe
    public function update_iframe($table,$col1,$col2,$id,$iframe){
        DB::update('update '.$table.' set '.$col1.' = "'.$iframe.'" where '.$col2.' = ?', [$id]);
    }

    //suppressionn iframe
    public function supprimer_iframe($table,$colonne,$id){
        DB::delete('delete from '.$table.' where '.$colonne.' = ?', [$id]);
    }

}

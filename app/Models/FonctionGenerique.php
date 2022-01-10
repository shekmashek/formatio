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

    //fonction generique
    public function findWhere($nomTab,$para=[],$val=[]){
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhere($nomTab,$para,$val), $val);
        return $data;
    }

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


    public function findAll($nomTab){
        $query = "SELECT * FROM ".$nomTab;
        return DB::select($query);
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
}

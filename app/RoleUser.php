<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;

class RoleUser extends Model
{
    //



    public function queryWhereRole_etp($val=[]){
        $query="SELECT * FROM v_role_etp WHERE ";
                for($i=0;$i<count($val);$i++)
                {
                $query.="id!=".$val[$i]->role_id;
                if($i+1 < count($val)){
                    $query.=" AND ";
                }
                }
                return $query;

    }

    // public function queryUserStg($val=[]){
    //     $query="SELECT * FROM v_user_role WHERE ";
    //             for($i=0;$i<count($val);$i++)
    //             {
    //             $query.="user_id=".$val[$i]->user_id;
    //             if($i+1 < count($val)){
    //                 $query.=" AND ";
    //             }
    //             }
    //             return $query;

    // }
    // public function findUserStg($val=[]){
    //     $fonction = new FonctionGenerique();
    //     $query = $this->queryUserStg($val);
    //     $data =  DB::select($query);
    //     return $data;
    // }
    public function findNotRole($val=[]){
        $fonction = new FonctionGenerique();
        $query = $this->queryWhereRole_etp($val);
        $result =  DB::select($query);
        return $result;
    }

    public function getNotRoleUser($listUser){
        $fonct = new FonctionGenerique();
        $data=[];
        $tmp = $this->findNotRole($listUser);
        for($i=0;$i<count($tmp);$i+=1){

            $data[$i]["id"] = $tmp[$i]->id;
            $data[$i]["role_name"] = $tmp[$i]->role_name;
            $data[$i]["role_description"] = $tmp[$i]->role_description;
            $data[$i]["user_id"] = $listUser[0]->user_id;
        }
        return $data;
    }



}


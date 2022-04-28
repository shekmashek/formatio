<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;

class Devise extends Model
{
    //
    protected $table="devises";

    public function queryWhereParamDernierDevis($nomTab,$val = [])
    {
        $query = "SELECT devise_id,valeur_default,description,reference,valeur_ariary,created_at,updated_at from ".$nomTab." WHERE ";
            for ($i = 0; $i < count($val); $i++) {
                $query .= "devise_id = ?";
                if ($i + 1 < count($val)) {
                    $query .= " OR ";
                }
            }
            $query.=" ORDER BY created_at DESC LIMIT ".count($val);
            return $query;
    }
    public function getListDevise(){ // return id de tous les devise
        $fonct = new FonctionGenerique();
        $dev = $fonct->findAll("devises");
        $data =[];
        for($i=0;$i<count($dev);$i+=1){
          $tmp =  DB::select("SELECT * FROM v_devise WHERE taux_devise_id = (SELECT MAX(taux_devise_id) FROM v_devise WHERE devise_id=?)",[$dev[$i]->id]);
          if(count($tmp)>0){
            $data[$i]["taux_devise_id"] = $tmp[0]->taux_devise_id;
            $data[$i]["devise_id"] = $tmp[0]->devise_id;
            $data[$i]["valeur_default"] = $tmp[0]->valeur_default;
            $data[$i]["description"] = $tmp[0]->description;
            $data[$i]["reference"] = $tmp[0]->reference;
            $data[$i]["valeur_ariary"] = $tmp[0]->valeur_ariary;
            $data[$i]["created_at"] = $tmp[0]->created_at;
            $data[$i]["updated_at"] = $tmp[0]->updated_at;
          }  else {
            $data[$i]["taux_devise_id"] = NULL;
            $data[$i]["devise_id"] = $dev[$i]->id;
            $data[$i]["valeur_default"] = 1;
            $data[$i]["description"] = $dev[$i]->description;
            $data[$i]["reference"] = $dev[$i]->reference;
            $data[$i]["valeur_ariary"] = NULL;
            $data[$i]["created_at"] = NULL;
            $data[$i]["updated_at"] = NULL;
          }
         
        }
        return $data;
    }

  /*  public function getDernierDevis()
    {
        $listDataIdDevis = $this-> getListDevise("devises");
      
        dd($this->queryWhereParamDernierDevis("v_devise",$listDataIdDevis));

        $data =  DB::select($this->queryWhereParamDernierDevis($listDataIdDevis), $listDataIdDevis);
        return $data;
    } */

}

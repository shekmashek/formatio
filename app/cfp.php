<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cfp extends Model
{
    protected $table="cfps";
    protected $fillable = [
        'Nom','Adresse','Email','Telephone','Domaine_de_formation','NIF','STAT','RCS','CIF','logo','user_id'
    ];
    
    public function getCfp($etp1,$etp2){
        $tab = array();
        for($i=0;$i<count($etp1);$i+=1){
            $tab[]=$etp1[$i];
        }
        for($j=0;$j<count($etp2);$j+=1){
            $tab[]=$etp2[$j];
        }

        return $tab;
    }
}

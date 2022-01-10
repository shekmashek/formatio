<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $table = "formateurs";
    protected $fillable = [
        'id','nom_formateur','prenom_formateur','photos','mail_formateur','numero_formateur'
    ];

    public function getFormateur($etp1,$etp2){
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

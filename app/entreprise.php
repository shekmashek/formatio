<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class entreprise extends Model
{
    protected $table = "entreprises";
    protected $fillable = [
        'nom_etp','adresse','logo','nif','stat','rcs','cif','secteur_id','email_etp','site_etp','telephone_etp'
    ];

    public function secteur()
    {
        return $this->belongsTo('App\Secteur');
    }

    public function getEntreprise($etp1,$etp2){
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

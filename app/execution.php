<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    protected $table = "executions";
    protected $fillable = [
        'id',
        'qualite_formation','evaluation_formateur',
        'stagiaire_id','detail_id',
        'msexcel_fondamentaux',
        'msexcel_calculsFonctions',
        'msexcel_gestionDonnées',
        'msexcel_BI',
        'msexcel_VBA',
        'msBI_fondamentaux',
        'mseBI_dax',
        'msBI_dataviz'
    ];
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire');
    }

//evaluation:
    //initial:1-20
    //basique:21-40
    //operationnel:41-60
    //avancé:61-80
    //expert:81-100
 //analyse par region, par fonction
}

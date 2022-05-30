<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = "departements";
    protected $fillable = [
        'nom_departement'
    ];

    public function Entreprise(){
        return $this->belongsTo('App\Entreprise', 'departement_entreprise_id');
    }

    // public function service()
    // {
    //     return $this->hasMany('App\Service');
    // }
}

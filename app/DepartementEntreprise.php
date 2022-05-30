<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartementEntreprise extends Model
{
    protected $table = "departement_entreprises";
    protected $fillable = [
        'departement_id', 'nom_departement' ,'entreprise_id'
    ];
    public function Departement(){
        return $this->belongsTo('App\Departement');
    }
    public function Entreprise(){
        return $this->belongsTo('App\Entreprise', 'departement_entreprise_id');
    }   
}

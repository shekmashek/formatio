<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartementEntreprise extends Model
{
    protected $table = "departement_entreprises";
    protected $fillable = [
        'departement_id','entreprise_id'
    ];
    public function Departement(){
        return $this->belongsTo('App\Departement');
    }
    public function Entreprise(){
        return $this->belongsTo('App\entreprise');
    }
}

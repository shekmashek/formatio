<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefDepartementEntreprise extends Model
{
    protected $table = "chef_dep_entreprises";
    protected $fillable = [
        'departement_entreprise_id','chef_departement_id'
    ];
    public function departement_entreprises(){
        return $this->belongsTo('App\DepartementEntreprise');
    }
    public function chef_departements(){
        return $this->belongsTo('App\chefDepartement');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";
    protected $fillable = [
        'nom_service', 'departement_entreprise_id'
    ];

    public function departement()
    {
        return $this->belongsTo('App\DepartementEntreprise', 'departement_entreprise_id');
    }
}

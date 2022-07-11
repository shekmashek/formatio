<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employers';
    protected $fillable = [
        'matricule_emp','nom_emp','prenom_emp','date_naissance_emp','cin_emp','email_emp','telephone_emp','fonction_emp','service_id','branche_id','genre_id','departement_entreprises_id','adresse_quartier','adresse_code_postal','adresse_lot','adresse_ville','adresse_region','user_id','photos','entreprise_id','niveau_etude_id','activiter','prioriter','url_photo'
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

}

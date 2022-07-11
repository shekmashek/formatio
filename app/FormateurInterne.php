<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormateurInterne extends Model
{
    protected $table = "formateurs_interne";

    protected $fillable = [
        'id', 'nom_formateur', 'prenom_formateur', 'mail_formateur', 'numero_formateur', 'photos', 'genre', 'date_naissance', 'adresse', 'cin', 'specialite', 'niveau', 'activiter', 'user_id', 'entreprise_id', 'url_photo'
    ];

}

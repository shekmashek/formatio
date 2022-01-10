<?php

namespace App\Models\excel;

use Illuminate\Database\Eloquent\Model;

class ParticipantExcel extends Model
{
    protected $table = "v_exportparticipant";
    protected $fillable = [
        'matricule','nom_stagiaire','prenom_stagiaire','genre_stagiaire','fonction_stagiaire','mail_stagiaire','telephone_stagiaire','nom_etp','adresse','email_etp','telephone_etp'
    ];
}

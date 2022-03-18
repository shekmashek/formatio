<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recueil_information extends Model
{
    protected $table = "recueil_informations";
    protected $fillable = [
        'duree_formation','mois_previsionnelle','annee_previsionnelle','statut','date_demande','formation_id','stagiaire_id','annee_plan_id','typologie_formation','objectif_attendu'
    ];
    public function formation(){
        return $this->belongsTo('App\formation');
    }
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire');
    }
    public function annee_plan(){
        return $this->belongsTo('App\annee_plan');
    }
}

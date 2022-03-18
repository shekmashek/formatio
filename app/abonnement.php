<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $table = "abonnements";
    protected $fillable = [
        'date_demande','date_debut','date_fin','mode_paiement','statut','type_abonnement_role_id','entreprise_id','categorie_paiement_id'
    ];
    public function type_abonnement_role(){
        return $this->belongsTo('App\type_abonnement_role');
    }
    public function entreprise(){
        return $this->belongsTo('App\entreprise');
    }
    public function categorie_paiement() {
        return $this->belongsTo('App\categorie_paiement');
    }
}

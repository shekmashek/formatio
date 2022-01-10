<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement_cfp extends Model
{
    protected $table = "abonnement_cfps";
    protected $fillable = [
        'date_demande','date_debut','date_fin','mode_paiement','statut','type_abonnement_role_id','cfp_id','categorie_paiement_id'
    ];
    public function type_abonnement_role(){
        return $this->belongsTo('App\type_abonnement_role');
    }
    public function cfp(){
        return $this->belongsTo('App\cfp');
    }
    public function categorie_paiement() {
        return $this->belongsTo('App\categorie_paiement');
    }
}

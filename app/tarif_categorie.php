<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif_categorie extends Model
{
    protected $table = 'tarif_categories';
    protected $fillable = [
        'type_abonnement_role_id','categorie_paiement_id','tarif'
    ];
    public function type_abonnement_role(){
        return $this->belongsTo('App\type_abonnement_role');
    }
    public function categorie_paiement(){
        return $this->belongsTo('App\categorie_paiement');
    }
}

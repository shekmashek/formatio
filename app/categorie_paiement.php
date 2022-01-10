<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie_paiement extends Model
{
    protected $table = "categorie_paiements";
    protected $fillable = ['categorie'];

    public function abonnement(){
        return $this->hasMany('App\abonnement');
    }
}

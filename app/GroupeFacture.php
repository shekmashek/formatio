<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeFacture extends Model
{
    protected $table = "groupe_factures";
    protected $fillable = ['groupe_id','qte','montant'];

    public function groupe(){
        return $this->belongsTo('App\groupe','groupe_id');
    }
}

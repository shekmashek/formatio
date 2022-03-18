<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_abonnement_role extends Model
{
    protected $table = "type_abonnement_roles";
    protected $fillable = ['type_abonne_id','type_abonnement_id'];
    public function type_abonne(){
        return $this->belongsTo('App\type_abonne');
    }
    public function type_abonnement(){
        return $this->belongsTo('App\type_abonnement');
    }
    public function abonnement(){
        return $this->hasMany('App\abonnement');
    }
    public function abonnement_cfp(){
        return $this->hasMany('App\abonnement_cfp');
    }
}

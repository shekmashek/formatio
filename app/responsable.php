<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = "responsables";
    protected $fillable = [
        'nom_resp','prenom_resp','fonction_resp','cin_resp','email_resp','telephone_resp','user_id','entreprise_id','activiter'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function entreprise(){
        return $this->belongsTo('App\entreprise');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre_gratuit extends Model
{
    protected $table = "offre_gratuits";
    protected $fillable = ['limite','type_abonne_id'];
    public function type_abonne(){
        return $this->belongsTo('App\type_abonne');
    }
}

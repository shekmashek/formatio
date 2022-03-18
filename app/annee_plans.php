<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annee_plans extends Model
{
    protected $table='annee_plans';
    // aa
  protected $fillable=['entreprise_id','Etat','annee'];
}

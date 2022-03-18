<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annee_plan extends Model
{
    protected $table = 'annee_plans';
    protected $fillable = ['entreprise_id','Etat','Annee'];
}

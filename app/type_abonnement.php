<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_abonnement extends Model
{
    protected $table = "type_abonnements";
    protected $fillable = [
        'NomType','Logo'
    ];
}

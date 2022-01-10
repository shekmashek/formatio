<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $table = "domaines";
    protected $fillable = [
        'nom_domaine'
    ];
}

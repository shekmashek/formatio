<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_champ extends Model
{
    protected $table = "type_champs";
    protected $fillable = ['nom_champ','desc_champ'];
}

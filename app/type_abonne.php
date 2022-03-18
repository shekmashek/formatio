<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_abonne extends Model
{
    protected $table = "type_abonnes";
    protected $fillable = ['abonne_name'];
}

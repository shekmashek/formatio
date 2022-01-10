<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    protected $table = 'secteurs';
    protected $fillable = ['nom_secteur'];
}

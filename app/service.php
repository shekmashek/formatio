<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table="services";
    public function DepartementEntreprise()
    {
        return $this->belongsTo('App\DepartementEntreprise');
    }
}

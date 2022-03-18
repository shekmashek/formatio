<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';
    protected $guarded = [];

    public function entreprise_site()
    {
        return $this->hasMany('App\entreprise_site');
    }
}

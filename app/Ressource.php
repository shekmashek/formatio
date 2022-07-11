<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    protected $table = "ressources";
    protected $fillable = [
        'description', 'demandeur', 'groupe_id'
    ];

    public function groupe(){
        return $this->belongsTo('App\groupe', 'groupe_id');
    }

    public function ressoursable(){
        return $this->morphTo();
    }

}

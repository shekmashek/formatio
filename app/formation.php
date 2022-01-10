<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = "formations";
    protected $fillable = [
        'id','nom_formation','cfp_id','domaine_id'
    ];
    public function domaine(){
        return $this->belongsTo('App\Domaine');
    }
}

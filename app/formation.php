<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = "formations";
    protected $fillable = [
        'id','nom_formation','cfp_id','domaine_id','formation_id'
    ];
    public function domaine(){
        return $this->belongsTo('App\Domaine');
    }
    public function categories_formation(){
        return $this->belongsTo('App\categories_formation');
    }
}

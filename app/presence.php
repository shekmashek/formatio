<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $table = "presences";
    protected $fillable = [
        'id','status','detail_id','stagiaire_id'
    ];
    public function detail(){
        return $this->belongsTo('App\detail');
    }
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire');
    }
}

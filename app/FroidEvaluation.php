<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FroidEvaluation extends Model
{
    protected $table = "froid_evaluations";
    protected $fillable = [
        'id','cours_id','status','stagiaire_id','projet_id'
    ];
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire');
    }
    public function detail(){
        return $this->belongsTo('App\detail');
    }
}

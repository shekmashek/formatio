<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = "cours";
    protected $fillable = [
        'titre','programme_id'
    ];
    public function programme(){
        return $this->belongsTo('App\programme');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant_groupe extends Model
{
    protected $table = "participant_groupe";
    protected $fillable = [
        'id','groupe_id','stagiaire_id'
    ];
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire');
    }
    public function detail(){
        return $this->belongsTo('App\groupe');
    }
    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}

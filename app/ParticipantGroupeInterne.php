<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantGroupeInterne extends Model
{
    protected $table = "participant_groupe_interne";
    protected $fillable = [
        'id', 'stagiaire_id', 'groupe_interne_id'
    ];
    
    public function groupe_interne()
    {
        return $this->belongsTo('App\GroupeInterne', 'groupe_interne_id');
    }
    
    public function stagiaire(){
        return $this->belongsTo('App\stagiaire', 'stagiaire_id');
    }
}

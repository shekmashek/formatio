<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeInterne extends Model
{
    protected $table = "groupes_interne";
    protected $fillable = [
        'max_participant', 'min_participant','nom_groupe','projet_interne_id', 'module_id', 'date_debut','date_fin','status','activiter', 'couleur'
    ];

    public function ressources() {
        return $this->morphMany('App\Ressource', 'ressoursable');
    }

    public function participant_interne()
    {
        return $this->hasMany('App\ParticipantGroupeInterne', 'groupe_interne_id');
    }
    
    public function details_interne()
    {
        return $this->hasMany('App\DetailInterne', 'groupe_interne_id');
    }
    
    public function projet_interne()
    {   
        return $this->belongsTo('App\ProjetInterne', 'projet_interne_id');
    }

    public function module_interne()
    {
        return $this->belongsTo('App\ModuleInterne', 'module_id');
    }


}

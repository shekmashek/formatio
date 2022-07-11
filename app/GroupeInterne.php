<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeInterne extends Model
{
    protected $table = "groupes_interne";
    protected $fillable = [
        'max_participant', 'min_participant','nom_groupe','projet_interne_id', 'module_former', 'date_debut','date_fin','status','activiter'
    ];

    public function projet_interne()
    {   
        return $this->belongsTo('App\ProjetInterne', 'projet_interne_id');
    }

    public function details_interne()
    {
        return $this->hasMany('App\DetailInterne', 'groupe_interne_id');
    }

}

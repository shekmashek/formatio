<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $table = "domaines";
    protected $fillable = [
        'nom_domaine','id'
    ];
    
    public function formation(){
        return $this->hasMany('App\formation','domaine_id');
    }

    public function formation_interne()
    {
        return $this->hasMany('App\FormationInterne', 'domaine_id');
    }

}

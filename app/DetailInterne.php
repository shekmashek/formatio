<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailInterne extends Model
{
    // details de formation interne à une entreprise
    protected $table = "details_interne";
    protected $fillable = [
        'id', 'lieu', 'date_detail', 'h_debut', 'h_fin', 'groupe_interne_id', 'formateur_interne_id','projet_interne_id'
    ];
    
    public function groupe_interne()
    {
        return $this->belongsTo('App\GroupeInterne', 'groupe_interne_id');
    }

    public function projet_interne()
    {
        return $this->belongsTo('App\ProjetInterne', 'projet_interne_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjetInterne extends Model
{
    protected $table = "projets_interne";
    protected $fillable = [
        'id','nom_projet','entreprise_id','status','activiter'
    ];

    public function entreprise()
    {
        return $this->belongsTo('App\entreprise', 'entreprise_id');
    }

}

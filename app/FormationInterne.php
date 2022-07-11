<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormationInterne extends Model
{
    protected $table = "formations_interne";
    protected $fillable = [
        'id', 'nom_formation', 'domaine_id', 'etp_id'
    ];

    public function domaine()
    {
        return $this->belongsTo('App\Domaine', 'domaine_id');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetenceFormateur extends Model
{
    //
    protected $table = "competence_formateurs";
    protected $fillable = ['competence','formateur_id'];
    public function Formateur(){
        return $this->belongsTo('App\formateur');
    }
}

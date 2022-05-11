<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienceFormateur extends Model
{
    //
    protected $table = 'experience_formateurs';
    protected $fillable = ['nom_entreprise','poste_occuper','debut_travail','fin_travail','taches','domaine','skills','formateur_id'];
    
    
    public function Formateur(){
        return $this->belongsTo('App\formateur');
    }
    
}

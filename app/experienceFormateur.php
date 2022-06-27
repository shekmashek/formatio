<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class ExperienceFormateur extends Model
{
    //
    protected $table = 'experience_formateurs';
    protected $fillable = ['nom_entreprise','poste_occuper','debut_travail','fin_travail','taches','domaine','skills','formateur_id'];
    public function Formateur(){
        return $this->belongsTo('App\formateur');
    }

    public function debut()
    {
        return Carbon::parse($this->attributes['debut_travail'])->isoFormat('LL');
    }
    public function fin()
    {
        return Carbon::parse($this->attributes['fin_travail'])->isoFormat('LL');
    }
}

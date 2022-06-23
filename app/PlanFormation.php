<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFormation extends Model
{
    protected $table = "plan_formation_valide";
    protected $fillable = [
        'AnneePlan','debut_rec','fin_rec','entreprise_id',
        
    ];
    // public  function entreprise(){
    //     return $this->belongsTo('App\entreprise');
    // }
    // public function recueil_information(){
    //     return $this->belongsTo('App\recueil_information');
    // }
    // public function annee_plan()
    // {
    //     return $this->belongsTo('App\annee_plan');
    // }
}

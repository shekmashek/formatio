<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFormation extends Model
{
    protected $table = "plan_formations";
    protected $fillable = [
        'entreprise_id','cout_previsionnel',
        'mode_financement','recueil_information_id','annee_plan_id','status','annee_previsionnelle'
    ];
    public  function entreprise(){
        return $this->belongsTo('App\entreprise');
    }
    public function recueil_information(){
        return $this->belongsTo('App\recueil_information');
    }
    public function annee_plan()
    {
        return $this->belongsTo('App\annee_plan');
    }
}

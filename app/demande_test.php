<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demande_test extends Model
{
    protected $table = "demande_test_niveaux";
    protected $fillable = [
        'description_test','entreprise_id','cfp_id','formation_id','date_creation'
    ];
    public function entreprise(){
        return $this->belongsTo('App\cntreprise');
    }
    public function cfp(){
        return $this->belongsTo('App\cfp');
    }
    public function formation(){
        return $this->belongsTo('App\formation');
    }

}

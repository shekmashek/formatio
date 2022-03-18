<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "details";
    protected $fillable = [
        'lieu','h_debut','h_fin','date','projet_id','groupe_id','session_id','module_id','formateur_id'
    ];


    public function module(){
        return $this->belongsTo('App\module');
    }
    public function formateur(){
        return $this->belongsTo('App\formateur');
    }
    public function execution()
    {
        return $this->hasMany(Execution::class);
    }
    public function participantsession() {
        return $this->hasMany(participantsession::class);
    }
    public function presence() {
        return $this->hasMany(presence::class);
    }
    public function projet(){
        return $this->belongsTo('App\projet');
    }
    public function groupe(){
        return $this->belongsTo('App\groupe');
    }



}

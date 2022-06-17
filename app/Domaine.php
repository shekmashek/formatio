<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $table = "domaines";
    protected $fillable = [
        'nom_domaine','id'
    ];

    public function formation(){
        return $this->hasMany('App\formation','domaine_id');
    }
    public function domaine(){
        return DB::select('select * from domaines');
    }
}

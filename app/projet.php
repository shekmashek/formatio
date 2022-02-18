<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projet extends Model
{
    protected $table = "projets";
    protected $fillable = [
        'id','nom_projet','entreprise_id','cfp_id','type_formation_id','status','activiter'
    ];
    public function entreprise(){
        return $this->belongsTo('App\entreprise');
    }

    public function generateNomProjet(){
        $num_projet = DB::select('select max(id)+1 as num_projet from projets');
        if($num_projet[0]->num_projet==NULL){
            $num_projet[0]->num_projet=1;
        }
        return "Projet-".$num_projet[0]->num_projet;
    }

    //====================== fonction ajouter suplementaire

    //get find by id
    public function findById($id){  return projet::where('id',$id)->get()[0];    }

}

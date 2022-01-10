<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projet extends Model
{
    protected $table = "projets";
    protected $fillable = [
        'id','nom_projet','entreprise_id','cfp_id','status','activiter'
    ];
    public function entreprise(){
        return $this->belongsTo('App\entreprise');
    }

    public function generateNomProjet($entreprise){
        $num_projet = DB::select('select max(id)+1 as num_projet from projets');
        if($num_projet[0]->num_projet==NULL){
            $num_projet[0]->num_projet=1;
        }
        $date_projet = date('d-m-Y');
        $nom_etp = DB::select('select nom_etp from entreprises where id = '.$entreprise);
        return $num_projet[0]->num_projet.'_'.$nom_etp[0]->nom_etp.'_'.$date_projet;
    }

    //====================== fonction ajouter suplementaire

    //get find by id
    public function findById($id){  return projet::where('id',$id)->get()[0];    }

}

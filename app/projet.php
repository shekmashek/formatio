<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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

    //recherche projet
    public function build_requette($role,$table,$request,$limit,$offset){
        $sql = "select * from ".$table." where 1=1 ";
        if (Gate::allows('isCFP') || Gate::allows('isFormateur')){
            $sql = $sql." and cfp_id = ".$role;
        }elseif(Gate::allows('isReferent') || Gate::allows('isManager') || Gate::allows('isStagiaire')){
            $sql = $sql." and entreprise_id = ".$role;
        }
         
        if(empty($request->annee) && empty($request->mois) && empty($request->trimestre) && empty($request->semestre)){
            return $sql." order by date_projet desc limit ".$limit." offset ".$offset;
        }
        if (!empty($request->annee)) {
            if($request->annee == 'null'){
                $request->annee = date("Y");
                $sql = $sql." and year(date_projet) = ".$request->annee;
            }
            else{
                $sql = $sql." and year(date_projet) = ".$request->annee;
            }
            if($request->mois != 'null'){
                $sql = $sql." and month(date_projet) = ".$request->mois;
            }else{
                if($request->trimestre != 'null'){
                    if($request->trimestre == 1){
                        $sql = $sql." and 1 <= month(date_projet) and month(date_projet) <= 3";
                    }if($request->trimestre == 2){
                        $sql = $sql." and 4 <= month(date_projet) and month(date_projet) <= 6";
                    }if($request->trimestre == 3){
                        $sql = $sql." and 7 <= month(date_projet) and month(date_projet) <= 9";
                    }if($request->trimestre == 4){
                        $sql = $sql." and 10 <= month(date_projet) and month(date_projet) <= 12";
                    }
                }else{
                    if($request->semestre != 'null'){
                        if($request->semestre == 1){
                            $sql = $sql." and 1 <= month(date_projet) and month(date_projet) <= 6";
                        }if($request->semestre == 2){
                            $sql = $sql." and 7 <= month(date_projet) and month(date_projet) <= 12";
                        }
                    }
                }
            }
        }
        $sql = $sql." order by date_projet desc limit ".$limit." offset ".$offset;
        return $sql;
    }

}

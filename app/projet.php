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
        return "Proj-".$num_projet[0]->num_projet;
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

    public function requette_detail_session_of($cfp_id,$groupe_id){
        return 'select
            d.id AS detail_id,
            d.lieu,
            d.h_debut,
            d.h_fin,
            d.date_detail,
            d.formateur_id,
            d.projet_id,
            d.groupe_id,
            d.cfp_id,
            g.max_participant,
            g.min_participant,
            g.nom_groupe,
            g.module_id,
            g.date_debut,
            g.date_fin,
            g.status as status_groupe,
            g.activiter as activiter_groupe,
            mf.reference,
            mf.nom_module,
            mf.formation_id,
            dom.id as id_domaine,
            dom.nom_domaine,
            mf.nom_formation,
            f.photos,
            concat(SUBSTRING(nom_formateur, 1, 1),SUBSTRING(prenom_formateur, 1, 1)) as sans_photos,
            f.nom_formateur,
            f.prenom_formateur,
            f.mail_formateur,
            f.numero_formateur,
            p.nom_projet,
            (c.nom) nom_cfp,
            p.type_formation_id,
            tf.type_formation
        FROM
            details d
        JOIN groupes g ON
            d.groupe_id = g.id
        JOIN moduleformation mf ON
            mf.module_id = g.module_id
        JOIN formateurs f ON
            f.id = d.formateur_id
        JOIN projets p ON
            d.projet_id = p.id
        JOIN cfps c ON
            p.cfp_id = c.id
        JOIN domaines dom ON
            mf.domaine_id = dom.id
        join type_formations tf
            on tf.id = p.type_formation_id
        where d.cfp_id = '.$cfp_id.' and d.groupe_id = '.$groupe_id.' order by d.date_detail';
    }


    
}

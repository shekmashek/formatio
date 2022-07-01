<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjetInterne extends Model
{
    public function nom_projet(){
        $num_projet = DB::select('select max(id)+1 as num_projet from projets_interne');
        if($num_projet[0]->num_projet==NULL){
            $num_projet[0]->num_projet=1;
        }
        return "Proj-".$num_projet[0]->num_projet;
    }

    public function nom_session(){
        $groupe = DB::select("select max(id)+1 as nom_groupe from groupes_interne");
        if($groupe[0]->nom_groupe==NULL){
            $groupe[0]->nom_groupe=1;
        }
        return "Sess-".$groupe[0]->nom_groupe;
    }

    public function infos_session($groupe_id){
        $info = DB::select('select count(id) as nb_detail,sum(TIME_TO_SEC(h_fin) - TIME_TO_SEC(h_debut)) as difference from details_interne where groupe_interne_id = ?',[$groupe_id])[0];
        return $info;
    }

    function formatting_phone($phone){
        $format = '';
        if(preg_match('/([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})$/', $phone, $value)) {
            $format = $value[1] . ' ' . $value[2] . ' ' . $value[3] .' '.$value[4];
        }
        return $format;
    }
}

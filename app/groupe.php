<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Groupe extends Model
{
    protected $table = "groupes";
    protected $fillable = [
        'nom_groupe','projet_id','max_participant','min_participant','module_id','date_debut','date_fin','status','activiter'
    ];
    public function projet(){
        return $this->belongsTo('App\projet');
    }

    public function generateNomSession($projet_id){
        $num_projet = DB::select("select max(nom_groupe) as nom_groupe from groupes where projet_id=?",[$projet_id]);
       $num_session = 0;
        if($num_projet[0]->nom_groupe==NULL){
            $num_session=1;
        } else{
            $str = explode("-",$num_projet[0]->nom_groupe);
            $num_session=intval($str[1])+1;
        }
            $nom_session ="Sess-".$num_session;
            return $nom_session;
    }


    public function statut_presences($groupe_id){
        $nb_presence = DB::select('select ifnull(count(groupe_id),0) as nombre_presence from v_presence_groupe where groupe_id = ?',[$groupe_id])[0]->nombre_presence;
        // dd($nb_presence);
        $nb_detail = DB::select('select ifnull(count(groupe_id),0) as nombre_detail from details where groupe_id = ?', [$groupe_id])[0]->nombre_detail;
        $nb_participant = DB::select('select ifnull(count(groupe_id),0) as nombre_participant from participant_groupe where groupe_id = ?',[$groupe_id])[0]->nombre_participant;
        if($nb_presence < $nb_detail * $nb_participant){
            return '#bdbebd';
        }
        elseif($nb_presence = $nb_detail * $nb_participant){
            return '#00ff00';
        }
        elseif($nb_detail * $nb_participant == 0){
            return '#bdbebd';
        }
    }

    public function statut_evaluation($groupe_id){
        $nb_participant = DB::select('select ifnull(count(groupe_id),0) as nombre_participant from participant_groupe where groupe_id = ?',[$groupe_id])[0]->nombre_participant;
        $module = DB::select('select module_id from groupes where id = ?',[$groupe_id])[0]->module_id;
        $nb_competence = DB::select('select ifnull(count(id),0) as nombre_comp from competence_a_evaluers where module_id = ?', [$module])[0]->nombre_comp;
        $nombre_eval = DB::select('select ifnull(count(note_apres),0) as nombre_note from evaluation_stagiaires where groupe_id = ? and note_apres > 0',[$groupe_id])[0]->nombre_note;
        // dd($nb_participant * $nb_competence,$nombre_eval);
        if($nb_participant == 0){
            return 0;
        }
        else{
            if($nb_participant * $nb_competence == $nombre_eval){
                return 1;
            }
            elseif($nombre_eval < $nb_participant * $nb_competence){
                return 0;
            }
        }
        
    }

    public function statut_evaluation_apres($groupe_id,$stg_id){
        $somme_eval = DB::select('select ifnull(sum(note_apres),0) as somme_note from evaluation_stagiaires where groupe_id = ? and stagiaire_id = ? ',[$groupe_id,$stg_id])[0]->somme_note;
        if($somme_eval == 0){
            return '#bdbebd';
        }
        elseif($somme_eval > 0){
            return '#00CDAC';
        }
    }

    public function infos_session($groupe_id){
        $info = DB::select('select count(id) as nb_detail,sum(TIME_TO_SEC(h_fin) - TIME_TO_SEC(h_debut)) as difference from details where groupe_id = ?',[$groupe_id])[0];
        return $info;
    }

    public function resultat_eval($groupe_id){
        $users = Auth::user()->id;
        $stg_id= stagiaire::where('user_id',$users)->value('id');
        $result = DB::select('select count(id) as nombre from evaluation_stagiaires where groupe_id = ? and stagiaire_id = ?',[$groupe_id,$stg_id]);
        if(count($result)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function inscrit_session_inter($groupe_id){
        $user_id = Auth::user()->id;
        $etp_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $result = DB::select('select ifnull(count(id),0) as nombre from groupe_entreprises where groupe_id = ? and entreprise_id = ?', [$groupe_id,$etp_id])[0];
        if($result->nombre > 0){
            return 1;
        }elseif($result->nombre == 0){
            return 0;
        }
    }

    public function module_session($module_id){
        return DB::select('select nom_module from modules where id = ?',[$module_id])[0]->nom_module;
    }

    public function nombre_apprenant_session($groupe_id){
        return DB::select('select count(stagiaire_id) as nombre from participant_groupe where groupe_id = ?',[$groupe_id])[0]->nombre;
    }

    public function module_projet($projet_id){
        return DB::select('select groupe_id,nom_module from v_groupe_projet_module where projet_id = ? group by nom_module',[$projet_id]);
    }


    function formatting_phone($phone){
        $format = '';
        if(preg_match('/([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})$/', $phone, $value)) {
            $format = $value[1] . ' ' . $value[2] . ' ' . $value[3] .' '.$value[4];
        }
        return $format;
    }
}

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
            $str = explode(" ",$num_projet[0]->nom_groupe);
            $num_session=intval($str[1])+1;
        }
            $nom_session ="Session ".$num_session;
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
        $somme_eval = DB::select('select ifnull(sum(note_apres),0) as somme_note from evaluation_stagiaires where groupe_id = ?',[$groupe_id])[0]->somme_note;
        if($somme_eval == 0){
            return '#bdbebd';
        }
        elseif($somme_eval > 0){
            return '#00ff00';
        }
    }

    public function infos_session($groupe_id){
        $info = DB::select('select count(id) as nb_detail,sum(TIME_TO_SEC(h_fin) - TIME_TO_SEC(h_debut)) as difference from details where groupe_id = ?',[$groupe_id])[0];
        return $info;
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

    public function get_lieu_fromation($groupe_id){
        $lieu_formation = DB::select('select lieu from details where groupe_id = ?', [$groupe_id]);
        $res ='';
        if(count($lieu_formation)>0){
            $lieu_formation = explode(',  ',$lieu_formation[0]->lieu);
            $res = $lieu_formation[0].', '.$lieu_formation[1];
        }else{
            $lieu_formation[0]='';
            $lieu_formation[1]='';
            $res = 'Indéfini';
        }
        return $res;
    }
}

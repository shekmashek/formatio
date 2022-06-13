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
        }elseif($result == 0){
            dd('eto0');
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

    public function statut_valuation_chaud($groupe_id,$stagiaire_id){
        $result = DB::select('select stagiaire_id from reponse_evaluationchaud where groupe_id = ? and stagiaire_id = ?',[$groupe_id,$stagiaire_id]);
        if(count($result)>0){
            return 1;
        }else{
            return 0;
        }
    }

    //info SESSION
    public function info_resp_etp($id_etp){

        // $info = DB::table('entreprises')
        //         ->join('responsables', 'responsables.entreprise_id', 'entreprises.id')
        //         ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.entreprise_id', 'entreprises.id')
        //         ->select(DB::raw('substr(entreprises.nom_etp, 1, 2) as nomEtpS') ,DB::raw('substr(responsables.nom_resp, 1, 1) as nomEtresp'), DB::raw('substr(responsables.prenom_resp, 1, 1) as prenomEtpresp'), 'entreprises.logo', 
        //         'entreprises.nif', 'entreprises.stat', 'entreprises.email_etp', 'entreprises.site_etp', 'entreprises.telephone_etp' ,
        //         'responsables.photos', 'responsables.matricule', 'responsables.nom_resp', 'responsables.prenom_resp',
        //         'responsables.email_resp', 'responsables.telephone_resp', 'responsables.adresse_quartier', 'responsables.adresse_lot',
        //         'responsables.adresse_ville', 'responsables.adresse_region', 'v_groupe_projet_entreprise.entreprise_id'
        //         )
        //         ->where('v_groupe_projet_entreprise.entreprise_id', $id_etp)
        //         ->get();

        $info = DB::table('statut_compte')
            ->join('entreprises', 'entreprises.statut_compte_id', 'statut_compte.id')
            ->join('abonnements', 'abonnements.entreprise_id', 'entreprises.id')
            ->join('responsables', 'responsables.entreprise_id', 'entreprises.id')
            ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.entreprise_id', 'entreprises.id')
            ->join('v_abonnement_facture_entreprise', 'v_abonnement_facture_entreprise.entreprise_id', 'entreprises.id')
            ->select(DB::raw('substr(entreprises.nom_etp, 1, 2) as nomEtpS') ,DB::raw('substr(responsables.nom_resp, 1, 1) as nomEtresp'), 
                    DB::raw('substr(responsables.prenom_resp, 1, 1) as prenomEtpresp'), 'entreprises.logo', 
                    'entreprises.nif', 'entreprises.stat', 'entreprises.email_etp', 'entreprises.site_etp', 'entreprises.telephone_etp' ,
                    'responsables.photos', 'responsables.matricule', 'responsables.nom_resp', 'responsables.prenom_resp',
                    'responsables.email_resp', 'responsables.telephone_resp', 'responsables.adresse_quartier', 'responsables.adresse_lot',
                    'responsables.adresse_ville', 'responsables.adresse_region', 
                    'v_groupe_projet_entreprise.entreprise_id', 'entreprises.statut_compte_id', 'v_abonnement_facture_entreprise.nom_type',
                    'statut_compte.nom_statut', 'entreprises.nom_etp')
            ->where('v_groupe_projet_entreprise.entreprise_id', $id_etp)
            ->get()[0];
                
        return $info;
    }

    public function info_resp_of($id_of){
        // $info = DB::table('cfps')
        //         ->join('responsables_cfp', 'responsables_cfp.cfp_id', 'cfps.id')
        //         ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.cfp_id', 'cfps.id')
        //         ->select(DB::raw('substr(responsables_cfp.nom_resp_cfp, 1, 1) as nomRespOf'), DB::raw('substr(responsables_cfp.prenom_resp_cfp, 1, 1) as prenomRespOf'), 
        //         DB::raw('substr(cfps.nom, 1, 2) as nomOfS'),
        //         'cfps.id', 'cfps.nif', 'cfps.stat', 'cfps.nom', 'cfps.adresse_lot', 'cfps.adresse_quartier',
        //         'cfps.adresse_code_postal', 'cfps.adresse_ville', 'cfps.adresse_region', 'cfps.email', 'cfps.telephone', 'cfps.logo',
        //         'cfps.site_web', 'responsables_cfp.nom_resp_cfp', 'responsables_cfp.prenom_resp_cfp', 'responsables_cfp.email_resp_cfp',
        //         'responsables_cfp.sexe_resp_cfp', 'responsables_cfp.fonction_resp_cfp', 'responsables_cfp.adresse_lot',
        //         'responsables_cfp.adresse_quartier', 'responsables_cfp.adresse_code_postal', 'responsables_cfp.adresse_ville', 
        //         'responsables_cfp.adresse_region', 'responsables_cfp.photos_resp_cfp', 'responsables_cfp.telephone_resp_cfp')
        //         ->where('v_groupe_projet_entreprise.cfp_id', $id_of)
        //         ->get()[0];

        $info = DB::table('cfps')
                ->join('responsables_cfp', 'responsables_cfp.cfp_id', 'cfps.id')
                ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.cfp_id', 'cfps.id')
                ->join('v_abonnement_facture', 'v_abonnement_facture.cfp_id', 'cfps.id')
                ->select(DB::raw('substr(responsables_cfp.nom_resp_cfp, 1, 1) as nomRespOf'), DB::raw('substr(responsables_cfp.prenom_resp_cfp, 1, 1) as prenomRespOf'), 
                        DB::raw('substr(cfps.nom, 1, 2) as nomOfS'),
                        'cfps.id', 'cfps.nif', 'cfps.stat', 'cfps.nom', 'cfps.adresse_lot', 'cfps.adresse_quartier',
                        'cfps.adresse_code_postal', 'cfps.adresse_ville', 'cfps.adresse_region', 'cfps.email', 'cfps.telephone', 'cfps.logo',
                        'cfps.site_web', 'responsables_cfp.nom_resp_cfp', 'responsables_cfp.prenom_resp_cfp', 'responsables_cfp.email_resp_cfp',
                        'responsables_cfp.sexe_resp_cfp', 'responsables_cfp.fonction_resp_cfp', 'responsables_cfp.adresse_lot',
                        'responsables_cfp.adresse_quartier', 'responsables_cfp.adresse_code_postal', 'responsables_cfp.adresse_ville', 
                        'responsables_cfp.adresse_region', 'responsables_cfp.photos_resp_cfp', 'responsables_cfp.telephone_resp_cfp',
                        'v_abonnement_facture.nom_type')
                ->where('v_groupe_projet_entreprise.cfp_id', $id_of)

                ->get()[0];

        return $info;
    }
}
?>
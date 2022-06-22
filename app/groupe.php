<?php

namespace App;

use App\Models\FonctionGenerique;
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
        $num_projet = DB::select("select max(nom_groupe) as nom_groupe from groupes");
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
    // public function info_resp_etp($id_etp){

    //     $info = DB::table('statut_compte')
    //         ->join('entreprises', 'entreprises.statut_compte_id', 'statut_compte.id')
    //         ->join('abonnements', 'abonnements.entreprise_id', 'entreprises.id')
    //         ->join('responsables', 'responsables.entreprise_id', 'entreprises.id')
    //         ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.entreprise_id', 'entreprises.id')
    //         ->join('v_abonnement_facture_entreprise', 'v_abonnement_facture_entreprise.entreprise_id', 'entreprises.id')
    //         ->select(DB::raw('substr(entreprises.nom_etp, 1, 2) as nomEtpS') ,DB::raw('substr(responsables.nom_resp, 1, 1) as nomEtresp'),
    //                 DB::raw('substr(responsables.prenom_resp, 1, 1) as prenomEtpresp'), 'entreprises.logo',
    //                 'entreprises.nif', 'entreprises.stat', 'entreprises.email_etp', 'entreprises.site_etp', 'entreprises.telephone_etp' ,
    //                 'responsables.photos', 'responsables.matricule', 'responsables.nom_resp', 'responsables.prenom_resp',
    //                 'responsables.email_resp', 'responsables.telephone_resp', 'responsables.adresse_quartier', 'responsables.adresse_lot',
    //                 'responsables.adresse_ville', 'responsables.adresse_region',
    //                 'v_groupe_projet_entreprise.entreprise_id', 'entreprises.statut_compte_id', 'v_abonnement_facture_entreprise.nom_type',
    //                 'statut_compte.nom_statut', 'entreprises.nom_etp')
    //         ->where('v_groupe_projet_entreprise.entreprise_id', $id_etp)
    //         ->get()[0];

    //     return $info;
    // }

    public function frais_annexe_of($projet_id){
        $frais_annexe = DB::select("select * from v_montant_frais_annexe where projet_id = ?",[$projet_id]);
        if(count($frais_annexe) > 0){
            return $frais_annexe[0]->hors_taxe;
        }else{
            return null;
        }
    }

    public function montantSession_of($groupe_id){
        $montant = DB::select("select cfp_id,projet_id,entreprise_id,groupe_id,hors_taxe,qte,num_facture,valeur_remise_par_session from v_liste_facture where groupe_id=?",[$groupe_id]);
        if(count($montant) > 0){
            return $montant[0]->qte;
        }else{
            return null;
        }
    }

    public function dataDetail($cfp_id){

        $req = DB::table('v_detail_session')
            ->select('*')
            ->where('cfp_id', $cfp_id)
            ->get();

        return $req;
    }

    public function formateurData($groupe_id){
        $fonct = new FonctionGenerique();
        $formateur = $fonct->findWhere('v_formateur_projet',['groupe_id'],[$groupe_id]);

        return $formateur;
    }

    public function dataFraisAnnexe($groupe_id, $etp_id){
        $all_frais_annexe = DB::table('frais_annexe_formation')
            ->select('entreprise_id', 'groupe_id', 'description', DB::raw("SUM(montant) as montantTotal"))
            ->where('groupe_id', $groupe_id)
            ->where('entreprise_id', $etp_id)
            ->groupBy('entreprise_id', 'groupe_id', 'description')
            ->get();

            // $all_frais_annexe = DB::select('select SUM(montant) as "montantTotal", entreprise_id, groupe_id, description from frais_annexe_formation where groupe_id = ? and entreprise_id = ? group by entreprise_id, groupe_id, description',[$groupe_id,$etp_id]);
        return $all_frais_annexe;
    }

    public function dataApprenant($cfp_id, $groupe_id){
        $type_formation_id = request()->type_formation;


        if ($type_formation_id == 1){
            $projet = DB::table('v_groupe_projet_entreprise')
                ->select('*')
                ->where('cfp_id', $cfp_id)
                ->where('groupe_id', $groupe_id)
                ->get();

            $entreprise_id = $projet[0]->entreprise_id;

        }elseif ($type_formation_id == 2){
            $projet = DB::table('v_projet_session_inter')
                ->select('*')
                ->where('cfp_id', $cfp_id)
                ->where('groupe_id', $groupe_id)
                ->get();

        }

        $stagiaire = DB::table('v_stagiaire_groupe')
            ->select('*')
            ->where('groupe_id', $groupe_id)
            ->get();

        return $stagiaire;
    }

    public function dataSession($groupe_id){

        $datas = DB::table('v_detail_session')
                ->select('*')
                ->where('groupe_id', $groupe_id)
                ->get();
        return $datas;
    }
}
?>



































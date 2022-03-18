<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Encaissement extends Model
{
    protected $table = "encaissements";
    protected $fillable = [
       'facture_id','num_facture','montant_facture','payement','libelle','montant_ouvert','date_encaissement','admin_id','mode_financement_id','cfp_id','resp_cfp_id','nom_resp_cfp'
    ];

    public static function validation($input){
        $rules = [
            'montant.required' => 'Veillez remplir le champ.',
            'montant.integer' => 'la valeur doit être numerique.',
            'montant.min' => 'La valeur doit être positive.',
            'libelle.required'=>'Veillez remplir le champ.'
        ];
        $critere=[
            'montant' => 'required|integer|min:0',
            'libelle' => 'required'
        ];
        $input->validate($critere,$rules);
    }

    // public static function getIdFacture($id_projet){
    //     return DB::select('select * from factures where projet_id = '.$id_projet);
    // }

    public static function getMontantLibelle($id){
        return DB::select('select payement,libelle from encaissements where id = '.$id);
    }


    public static function modifierEncaissementNow($id,$montant,$libelle){
        $encaissement_now = DB::select('select * from encaissements where id = ?', [$id]);
        $montant_ouvert = $encaissement_now[0]->montant_facture - $montant;
        DB::update('update encaissements set payement = ? , libelle = ? , montant_ouvert = ? where id = ?', [$montant,$libelle,$montant_ouvert,$id]);
    }

    public static function modifierAutres($id_modifier){
        $encaissements = DB::select('select * from encaissements where id > ?', [$id_modifier]);
        $montant_ouvert = DB::select('select montant_ouvert from encaissements where id = ?', [$id_modifier])[0]->montant_ouvert;
        foreach($encaissements as $encaiss){
            $montant_facture = $montant_ouvert;
            $payement = $encaiss->payement;
            $montant_ouvert = $montant_facture - $payement;
            DB::update('update encaissements set montant_facture = ? , payement = ? , montant_ouvert = ? where id = ?', [$montant_facture,$payement,$montant_ouvert,$encaiss->id]);
        }
    }

    public static function supprimerAutres($id_supp){
        $encaissements = DB::select('select * from encaissements where id > ?', [$id_supp]);
        // $id_inf = DB::select('select MAX(id) as max_id from encaissements where id < ?', [$id_supp])[0]->max_id;
        $montant_facture = DB::select('select montant_facture from encaissements where id = ?', [$id_supp])[0]->montant_facture;
        foreach($encaissements as $encaiss){
            $payement = $encaiss->payement;
            $montant_ouvert = $montant_facture - $payement;
            DB::update('update encaissements set montant_facture = ? , payement = ? , montant_ouvert = ? where id = ?', [$montant_facture,$payement,$montant_ouvert,$encaiss->id]);
            $montant_facture = $montant_ouvert;
        }
    }


    public static function getProjetEntreprise($id_etp,$id_projet){
        return DB::select('select * from v_projetentreprise where entreprise_id = ? and projet_id = ?', [$id_etp,$id_projet]);
    }

    public static function getMontantOuvert($num_facture,$cfp_id){
        $montantOuvert = DB::select('select * from v_facture_actif where num_facture = ? and cfp_id=?',[$num_facture,$cfp_id]);
        return $montantOuvert;
    }

    public static function insert($imput,$cfp_id,$id_resp,$nom_resp){
        $num_facture = $imput['num_facture'];
        $dernier_encaiss = encaissement::getMontantOuvert($num_facture,$cfp_id)[0];
        $montantOuvert = $dernier_encaiss->dernier_montant_ouvert;
        $montantFacture = $montantOuvert;
        $montantOuvert = $montantOuvert - $imput->montant;
        $encaissement = new encaissement();
        $encaissement->num_facture = $num_facture;
        $encaissement->libelle = $imput->libelle;
        $encaissement->montant_facture = $montantFacture;
        $encaissement->payement = $imput->montant;
        $encaissement->montant_ouvert = $montantOuvert;
        $encaissement->date_encaissement = $imput->date_encaissement;
        $encaissement->mode_financement_id = $imput->mode_payement;
        $encaissement->cfp_id = $cfp_id;
        $encaissement->resp_cfp_id = $id_resp;
        $encaissement->nom_resp_cfp = $nom_resp;
        $encaissement->facture_id = $dernier_encaiss->facture_id;

        $encaissement->save();
    }


}

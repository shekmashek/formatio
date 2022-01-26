<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\FonctionGenerique;
use App\NouveauCompte;
use App\User;

class NouveauCompteController extends Controller
{
    public function __construct()
    {
        $this->new_compte = new NouveauCompte();
        $this->fonct = new FonctionGenerique();

        $this->user = new User();
    }


    public function index_create_compte_cfp()
    {
        $departements =  $this->fonct->findAll("departements");
        return view('create_compte.create_compte_cfp', compact('departements'));
    }

    public function index_create_compte_employeur()
    {
        $departements =  $this->fonct->findAll("departements");
        $secteurs =  $this->fonct->findAll("secteurs");
        return view('create_compte.create_compte_client', compact('departements','secteurs'));
    }

    public function create_compte_cfp(Request $req)
    {
        // ======== cfp
        // $data["logo_cfp"] = $req->logo_cfp;
        $data["logo_cfp"] = "noam_cfp";
        $data["domaine_cfp"] = $req->domaine_cfp;
        $data["nom_cfp"] = $req->name_cfp;
        $data["lot"] = $req->lot;
        $data["ville"] = $req->ville;
        $data["region"] = $req->region;
        $data["email_cfp"] = $req->email_cfp;
        $data["tel_cfp"] = $req->tel_cfp;
        $data["web_cfp"] = $req->web_cfp;
        $data["nif"] = $req->nif;
        $data["stat"] = $req->stat;
        $data["rcs"] = $req->rcs;
        $data["cif"] = $req->cif;

        $data["rue"] = $req->rue_cfp;
        $data["quartier"] = $req->quartier_cfp;
        $data["code_postal"] = $req->code_postal_cfp;

        // ======= responsable
        // $resp["photo_resp"] = $req->photo_resp_cfp;
        $resp["photo_resp"] = "nom_sary";
        $resp["sexe_resp"] = $req->sexe_resp_cfp;

        $resp["nom_resp"] = $req->nom_resp_cfp;
        $resp["prenom_resp"] = $req->prenom_resp_cfp;
        $resp["dte_naissance_resp"] = $req->dte_resp_cfp;
        $resp["cin_resp"] = $req->cin_resp_cfp;
        $resp["email_resp"] = $req->email_resp_cfp;
        $resp["tel_resp"] = $req->tel_resp_cfp;
        $resp["rue_resp"] = $req->rue_resp_cfp;
        $resp["quartier_resp"] = $req->quartier_resp_cfp;
        $resp["code_postal_resp"] = $req->code_postal_resp_cfp;
        $resp["lot_resp"] = $req->lot_resp_cfp;
        $resp["ville_resp"] = $req->ville_resp_cfp;
        $resp["region_resp"] = $req->region_resp_cfp;

        $resp["fonction_resp"] = $req->fonction_resp_cfp;
        $resp["departement_resp"] = $req->departement_resp_cfp;
        $resp["poste_resp"] = $req->poste_resp_cfp;


        $verify = $this->new_compte->verify_cfp($req->name_entreprise, $req->email_cfp);

        if (count($verify) <= 0) { // cfp n'existe pas

            $this->user->name = $req->nom_resp_cfp;
            $this->user->email = $req->email_resp_cfp;
            $ch1 = $req->name_resp_cfp;
            $ch2 = substr($req->tel_resp_cfp, 8, 2);
            $this->user->password = Hash::make($ch1 . $ch2);
            $this->user->role_id = '7';

            $this->user->save();

            $user_id = User::where('email', $req->email_resp_cfp)->value('id');

            $this->new_compte->insert_CFP($data, $user_id);

            $cfp_id = $this->fonct->findWhereMulitOne("cfps", ["email"], [$req->email_cfp])->id;
            $this->new_compte->insert_resp_CFP($resp, $cfp_id, $user_id);

            return redirect()->route('inscription_save');
        } else {
            return back()->with('error', 'Organisation de Formation existe déjà!');
        }
    }


    public function create_compte_employeur(Request $req)
    {
       // ======== ETP
        // $data["logo_etp"] = $req->logo_etp;
        $data["logo_etp"] = "noam_etp";
        $data["domaine_etp"] = $req->domaine_etp;
        $data["nom_etp"] = $req->name_etp;
        $data["lot"] = $req->lot_etp;
        $data["ville"] = $req->ville_etp;
        $data["region"] = $req->region_etp;
        $data["email_etp"] = $req->email_etp;
        $data["tel_etp"] = $req->tel_etp;
        $data["web_etp"] = $req->web_etp;
        $data["nif"] = $req->nif;
        $data["stat"] = $req->stat;
        $data["rcs"] = $req->rcs;
        $data["cif"] = $req->cif;

        $data["rue"] = $req->rue_etp;
        $data["quartier"] = $req->quartier_etp;
        $data["code_postal"] = $req->code_postal_etp;

        $resp["nom_resp"] = $req->nom_resp;
        $resp["prenom_resp"] = $req->prenom_resp;

        $resp["photo_resp"] = "nom_sary";
        $resp["sexe_resp"] = $req->sexe_resp;

        $resp["dte_naissance_resp"] = $req->dte_resp;
        $resp["cin_resp"] = $req->cin_resp_etp;
        $resp["email_resp"] = $req->email_resp;
        $resp["tel_resp"] = $req->tel_resp;
        $resp["rue_resp"] = $req->rue_resp;
        $resp["quartier_resp"] = $req->quartier_resp;
        $resp["code_postal_resp"] = $req->code_postal_resp;
        $resp["lot_resp"] = $req->lot_resp;
        $resp["ville_resp"] = $req->ville_resp;
        $resp["region_resp"] = $req->region_resp;

        $resp["fonction_resp"] = $req->fonction_resp;
        $resp["departement_resp"] = $req->departement_resp;
        $resp["poste_resp"] = $req->poste_resp;

        $verify = $this->new_compte->verify_etp($req->name_etp, $req->email_etp);

        if (count($verify) <= 0) { // etp n'existe pas

            $this->user->name = $req->nom_resp;
            $this->user->email = $req->email_resp;
            $ch1 = $req->name_resp;
            $ch2 = substr($req->tel_resp, 8, 2);
            $this->user->password = Hash::make($ch1 . $ch2);
            $this->user->role_id = '2';

            $this->user->save();

            $user_id = User::where('email', $req->email_resp)->value('id');

            $this->new_compte->insert_ETP($data, $user_id);

            $entreprise_id = $this->fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_etp])->id;
            $this->new_compte->insert_resp_ETP($resp, $entreprise_id, $user_id);

            return redirect()->route('inscription_save');
        } else {
            return back()->with('error', 'Organisation de Formation existe déjà!');
        }
    }



    /* public function create(Request $req)
    {

        if ($req->entreprise_id == 1) { //========= create CFP ou OF
            $data["domaine_cfp"] = $req->domaine_cfp;
            $data["nom_cfp"] = $req->name_cfp;
            $data["lot"] = $req->lot;
            $data["ville"] = $req->ville;
            $data["region"] = $req->region;
            $data["email_cfp"] = $req->email_cfp;
            $data["tel_cfp"] = $req->tel_cfp;
            $data["web_cfp"] = $req->web_cfp;
            $data["nif"] = $req->nif;
            $data["stat"] = $req->stat;
            $data["rcs"] = $req->rcs;
            $data["cif"] = $req->cif;
            $verify = $this->new_compte->verify_cfp($req->name_entreprise, $req->email_cfp);

            if (count($verify) <= 0) { // cfp n'existe pas

                // dd($req->input());
                $this->user->name = $req->name_cfp;
                $this->user->email = $req->email_cfp;
                $ch1 = $req->name_entreprise;
                $ch2 = substr($req->tel_cfp, 8, 2);
                $this->user->password = Hash::make($ch1 . $ch2);
                $this->user->role_id = '7';
                $this->user->save();
                $user_id = User::where('email', $req->email_cfp)->value('id');
                $this->new_compte->insert_CFP($data, $user_id);
                return back()->with('success', 'compte créer avec success!');
            } else {
                return back()->with('error', 'Organisation de Formation existe déjà!');
            }
        }

        if ($req->entreprise_id == 2) { // =========== create responsable ETP

            $data["nom_etp"] = $req->name_entreprise;
            $data["nom_resp"] = $req->nom_resp;
            $data["prenom_resp"] = $req->prenom_resp;
            $data["function_resp"] = $req->function_resp;
            $data["email_resp"] = $req->email_resp;
            $data["tel_resp"] = $req->tel_resp;
            $data["web_etp"] = $req->web_etp;
            $data["nif"] = $req->nif;
            $data["stat"] = $req->stat;
            $data["rcs"] = $req->rcs;
            $data["cif"] = $req->cif;
            $verify2 = $this->new_compte->verify_resp($req->email_resp, $req->tel_resp);

            $etp_temp = $this->new_compte->search_etp($req->name_entreprise);
            if(count($etp_temp)<=0)
            {
                return back()->with('error',"désoler,cette entreprise n'a pas de compte sur cette plateforme");
            } else {

                $entreprise_id = $etp_temp[0]->id;

                if (count($verify2) <= 0) {
                    $resp = $this->fonct->findWhere("responsables", ["entreprise_id"], [$entreprise_id]);
                    // dd($resp);

                    if (count($resp) <= 0) {
                        $this->user->name = $req->nom_resp;
                        $this->user->email = $req->email_resp;
                        $ch1 = $req->nom_resp;
                        $ch2 = substr($req->tel_resp, 8, 2);
                        $this->user->password = Hash::make($ch1 . $ch2);
                        $this->user->role_id = '2';
                        // $this->user->save();
                        $user_id = User::where('email', $req->email_resp)->value('id');
                        $this->new_compte->insert_Responsable($data,$entreprise_id,$user_id);
                        return back();
                    } else {
                        return back()->with('error', 'veuillez demander à la responsable principale de vous ajouter sur ce plateforme,merci');
                    }
                } else {
                    return back()->with('error', 'email or tel existe déjà!');
                }
            }


        } // fin create responsable ETP
    }*/


    public function search_entreprise_referent(Request $req)
    {
        $results = array();
        $data = $this->new_compte->search_etp($req->search);
        foreach ($data as $query) {
            $results[] = ['id' => $query->nom_etp, 'value' => $query->nom_etp];
        }
        return response()->json($results);
    }
}

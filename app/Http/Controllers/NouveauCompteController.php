<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Mail\create_new_compte\save_new_compte_cfp_Mail;
use App\Mail\create_new_compte\save_new_compte_etp_Mail;

use App\Models\FonctionGenerique;
use App\Models\getImageModel;
use App\NouveauCompte;
use App\User;

class NouveauCompteController extends Controller
{
    public function __construct()
    {
        $this->new_compte = new NouveauCompte();
        $this->fonct = new FonctionGenerique();
        $this->img = new getImageModel();

        $this->user = new User();
    }


    public function index_create_compte_cfp()
    {
        return view('create_compte.create_compte_cfp');
    }

    public function index_create_compte_employeur()
    {
        $secteur = $this->fonct->findAll("secteurs");
        return view('create_compte.create_compte_client',compact('secteur'));
    }

// ------------------------------------------------
    public function verify_cin_user(Request $req)
    {
        $data = $this->new_compte->verify_cin_user($req->valiny);
        return response()->json($data);
    }

    public function verify_mail_user(Request $req)
    {
        $data = $this->new_compte->verify_mail_user($req->valiny);
        return response()->json($data);
    }

    public function verify_tel_user(Request $req)
    {
        $data = $this->new_compte->verify_tel_user($req->valiny);
        return response()->json($data);
    }

// ------------------------------------------------

    public function verify_nif_cfp(Request $req)
    {
        $data = $this->new_compte->verify_NIF_cfp($req->nif);
        return response()->json($data);
    }

    public function verify_nif_etp(Request $req)
    {
        $data = $this->new_compte->verify_NIF_etp($req->nif);
        return response()->json($data);
    }

    public function create_compte_cfp(Request $req)
    {
        $qst_IA_robot = 27 - 16;
        $value_confident = $req->value_confident;
        $val_resp_robot = $req->val_robot;

        if ($qst_IA_robot == $val_resp_robot) {
            if ($value_confident == 1) // il approuve les règlement
            {
                // ======== cfp
                $date = date('d-m-y');
                $data["logo_cfp"]  = str_replace(' ', '_', $req->name_cfp .  '' . $req->tel_cfp . '' . $date . '.' . $req->file('logo_cfp')->extension());
                $data["nom_cfp"] = $req->name_cfp;
                $data["ville"] = $req->ville;
                $data["region"] = $req->region;
                $data["email_cfp"] = $req->email_resp_cfp;
                $data["tel_cfp"] = $req->tel_resp_cfp;
                $data["web_cfp"] = $req->web_cfp;
                $data["nif"] = $req->nif;
                $data["rue"] = $req->lot_cfp;
                $data["quartier"] = $req->quartier_cfp;
                $data["code_postal"] = $req->code_postal_cfp;


                // ======= responsable
                $resp["sexe_resp"] = $req->sexe_resp_cfp;

                $resp["nom_resp"] = $req->nom_resp_cfp;
                $resp["prenom_resp"] = $req->prenom_resp_cfp;
                $resp["dte_naissance_resp"] = $req->dte_resp_cfp;
                $resp["cin_resp"] = $req->cin_resp_cfp;
                $resp["email_resp"] = $req->email_resp_cfp;
                $resp["tel_resp"] = $req->tel_resp_cfp;
                $resp["fonction_resp"] = $req->fonction_resp_cfp;
                $verify = $this->new_compte->verify_cfp($req->name_entreprise, $req->email_resp_cfp);
                // dd($verify);

                if (count($verify) <= 0) { // cfp n'existe pas

                    $this->user->name = $req->nom_resp_cfp;
                    $this->user->email = $req->email_resp_cfp;
                    $ch1 = "0000";
                    $this->user->password = Hash::make($ch1);
                    $this->user->role_id = '7';

                    $this->user->save();

                    $user_id = User::where('email', $req->email_resp_cfp)->value('id');

                    $this->new_compte->insert_CFP($data, $user_id);

                    $cfp_id = $this->fonct->findWhereMulitOne("cfps", ["email"], [$req->email_resp_cfp])->id;
                    $resp_cfp = $this->fonct->findWhere("responsables_cfp", ["cfp_id"], [$cfp_id]);
                    $this->new_compte->insert_resp_CFP($resp, $cfp_id, $user_id);
                    //============= save image

                    $this->img->store_image("entreprise", $data["logo_cfp"], $req->file('logo_cfp')->getContent());
                    // $this->img->store_image("responsable",$resp["photo_resp"],$req->file('photo_resp_cfp')->getContent());
                    $fonct = new FonctionGenerique();
                    $cfp = $fonct->findWhereMulitOne("cfps", ["email"], [$req->email_resp_cfp]);

                    Mail::to($req->email_resp_cfp)->send(new save_new_compte_cfp_Mail($req->nom_resp_cfp . ' ' . $req->prenom_resp_cfp, $req->email_resp_cfp, $cfp->nom));
                    return redirect()->route('inscription_save');
                } else {
                    return back()->with('error', 'Organisation de Formation existe déjà!');
                }
            } else {
                return back()->with('error', 'vous ne pouvez pas crée un compte sans accepter notre règle confidentiel, merci :-) !');
            }
        } else {
            return back()->with('error', 'désolé, les robots ne sont pas autorisé sur ce plateforme :-) !');
        }
    }


    public function create_compte_employeur(Request $req)
    {
        $qst_IA_robot = 27 - 16;
        $value_confident = $req->value_confident;
        $val_resp_robot = $req->val_robot;

        if ($qst_IA_robot == $val_resp_robot) {
            if ($value_confident == 1) // il approuve les règlement
            {
                // ======== entreprise
                $date = date('d-m-y');
                $data["logo_etp"]  = str_replace(' ', '_', $req->name_etp .  '' . $req->tel_etp . '' . $date . '.' . $req->file('logo_etp')->extension());
                $data["nom_etp"] = $req->name_etp;
                $data["ville"] = $req->ville;
                $data["region"] = $req->region;
                $data["email_etp"] = $req->email_resp_etp;
                $data["tel_etp"] = $req->tel_resp_etp;
                $data["web_etp"] = $req->web_etp;
                $data["nif"] = $req->nif;
                $data["stat"] = $req->stat;
                $data["rcs"] = $req->rcs;
                $data["cif"] = $req->cif;
                $data["rue"] = $req->lot_etp;
                $data["quartier"] = $req->quartier_etp;
                $data["code_postal"] = $req->code_postal_etp;
                $data["secteur_id"] = $req->secteur_id;

                // ======= responsable
                $resp["sexe_resp"] = $req->sexe_resp_etp;

                $resp["nom_resp"] = $req->nom_resp_etp;
                $resp["prenom_resp"] = $req->prenom_resp_etp;
                $resp["dte_naissance_resp"] = $req->dte_resp_etp;
                $resp["cin_resp"] = $req->cin_resp_etp;
                $resp["email_resp"] = $req->email_resp_etp;
                $resp["tel_resp"] = $req->tel_resp_etp;
                $resp["fonction_resp"] = $req->fonction_resp_etp;
                $verify = $this->new_compte->verify_etp($req->name_entreprise, $req->email_resp_etp);

                if (count($verify) <= 0) { // etp n'existe pas

                    $this->user->name = $req->nom_resp_etp;
                    $this->user->email = $req->email_resp_etp;
                    $ch1 = "0000";
                    $this->user->password = Hash::make($ch1);
                    $this->user->role_id = '2';

                     $this->user->save();

                    $user_id = User::where('email', $req->email_resp_etp)->value('id');

                    $this->new_compte->insert_ETP($data, $user_id);

                    $etp_id = $this->fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_resp_etp])->id;
                    $resp_etp = $this->fonct->findWhere("responsables", ["entreprise_id"], [$etp_id]);
                    $this->new_compte->insert_resp_ETP($resp, $etp_id, $user_id);
                    //============= save image

                    $this->img->store_image("entreprise", $data["logo_etp"], $req->file('logo_etp')->getContent());
                    $fonct = new FonctionGenerique();
                    $etp = $fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_resp_etp]);

                    Mail::to($req->email_resp_etp)->send(new save_new_compte_etp_Mail($req->nom_resp_etp . ' ' . $req->prenom_resp_etp, $req->email_resp_etp, $etp->nom_etp));
                    return redirect()->route('inscription_save');
                } else {
                    return back()->with('error', 'Organisation de Formation existe déjà!');
                }
            } else {
                return back()->with('error', 'vous ne pouvez pas crée un compte sans accepter notre règle confidentiel, merci :-) !');
            }
        } else {
            return back()->with('error', 'désolé, les robots ne sont pas autorisé sur ce plateforme :-) !');
        }
    }

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

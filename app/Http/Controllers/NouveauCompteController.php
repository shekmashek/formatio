<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\create_new_compte\save_new_compte_cfp_Mail;
use App\Mail\create_new_compte\save_new_compte_etp_Mail;

use App\Models\FonctionGenerique;
use App\Models\getImageModel;
use App\NouveauCompte;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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
        return view('create_compte.create_compte_client', compact('secteur'));
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

    public function verify_tail_photo(Request $req){
        $val = $this->new_compte->validation_form_photo_cfp($req);

       return response()->json([$val->errors()->all()]);

    }

    public function create_compte_cfp(Request $req)
    {
        // dd($req->input());

        $this->new_compte->validation_form_cfp($req);
        $qst_IA_robot = 27 - 16;
        $value_confident = $req->value_confident;
        $val_resp_robot = $req->val_robot;
        if ($qst_IA_robot == $val_resp_robot) {
            if ($value_confident == 1) // il approuve les règlement
            {
                // ======== cfp
                $date = date('d-m-y');
                $data["logo_cfp"]  = str_replace(' ', '_', $req->name_cfp .  '' . $req->tel_cfp . '' . $date . '.' . $req->file('logo_cfp')->extension());

                $url_logo = URL::to('/')."/images/CFP/".$data["logo_cfp"];


                $data["nom_cfp"] = $req->name_cfp;
                $data["email_cfp"] = $req->email_resp_cfp;
                // $data["tel_cfp"] = $req->tel_resp_cfp;
                // $data["web_cfp"] = $req->web_cfp;
                $data["nif"] = $req->nif;

                // ======= responsable

                $resp["nom_resp"] = $req->nom_resp_cfp;
                $resp["prenom_resp"] = $req->prenom_resp_cfp;
                $resp["cin_resp"] = $req->cin_resp_cfp;
                $resp["email_resp"] = $req->email_resp_cfp;
                // $resp["tel_resp"] = $req->tel_resp_cfp;
                // $resp["fonction_resp"] = $req->fonction_resp_cfp;

                $verify = $this->new_compte->verify_cfp($req->name_cfp, $req->email_resp_cfp);
                $verify_cfp_nif = $this->fonct->findWhere("cfps", ["nif"], [$req->nif]);
                $verify_resp_cin = $this->fonct->findWhere("users", ["cin"], [$req->cin_resp_cfp]);
                $verify_resp_mail = $this->fonct->findWhere("users", ["email"], [$req->email_resp_cfp]);

                if (count($verify) <= 0) { // cfp n'existe pas

                    if (count($verify_cfp_nif) <= 0) {
                        if (count($verify_resp_cin) <= 0) {
                            if (count($verify_resp_mail) <= 0) {

                                    $this->user->name = $req->nom_resp_cfp . " " . $req->prenom_resp_cfp;
                                    $this->user->email = $req->email_resp_cfp;
                                    $this->user->cin = $req->cin_resp_cfp;
                                    // $this->user->telephone = $req->tel_resp_cfp;
                                    $ch1 = "0000";
                                    $this->user->password = Hash::make($ch1);

                                    $this->user->save();

                                    $user_id = User::where('email', $req->email_resp_cfp)->value('id');
                                    $this->new_compte->insert_CFP($data,$url_logo);

                                    $cfp_id = $this->fonct->findWhereMulitOne("cfps", ["email"], [$req->email_resp_cfp])->id;
                                    $this->new_compte->insert_resp_CFP($resp, $cfp_id, $user_id);
                                    DB::beginTransaction();
                                    try {
                                        $this->fonct->insert_role_user($user_id, "7", true, true); // CFP (user_id, role_id, prioriter, activiter)
                                        DB::commit();
                                    } catch (Exception $e) {
                                        DB::rollback();
                                        echo $e->getMessage();
                                    }
                                    //============= save image

                                    // $this->img->store_image("entreprise", $data["logo_cfp"], $req->file('logo_cfp')->getContent());
                                    $fonct = new FonctionGenerique();
                                    $cfp = $fonct->findWhereMulitOne("cfps", ["email"], [$req->email_resp_cfp]);

                                    Mail::to($req->email_resp_cfp)->send(new save_new_compte_cfp_Mail($req->nom_resp_cfp . ' ' . $req->prenom_resp_cfp, $req->email_resp_cfp, $cfp->nom));
                                    $req->logo_cfp->move(public_path('images/CFP'), $data["logo_cfp"]);  //save image cfp

                                    if (Gate::allows('isSuperAdminPrincipale')) {
                                        return back();
                                    } else {
                                        return redirect()->route('inscription_save');
                                    }

                                    return redirect()->route('inscription_save');
                            } else {
                                return back()->with('error', 'email existe déjà!');
                            }
                        } else {
                            return back()->with('error', 'CIN existe déjà!');
                        }
                    } else {
                        return back()->with('error', 'NIF existe déjà!');
                    }
                } else {
                    return back()->with('error', 'Organisation de Formation existe déjà!');
                }
            } else {
                return back()->with('error', 'vous ne pouvez pas créer un compte sans accepter notre règle confidentiel, merci :-) !');
            }
        } else {
            return back()->with('error', 'désolé, les robots ne sont pas autorisé sur ce plateforme :-) !');
        }
    }


    public function create_compte_employeur(Request $req)
    {
        // $this->new_compte->validation_form_etp($req);
        $qst_IA_robot = 27 - 16;
        $value_confident = $req->value_confident;
        $val_resp_robot = $req->val_robot;
        if ($qst_IA_robot == $val_resp_robot) {

            if ($value_confident == 1) // il approuve les règlement
            {
                // ======== entreprise
                $date = date('d-m-y');
                $data["logo_etp"]  = str_replace(' ', '_', $req->name_etp .  '' . $req->tel_etp . '' . $date . '.' . $req->file('logo_etp')->extension());

                $url_logo = URL::to('/')."/images/entreprises/".$data["logo_etp"];

                $data["nom_etp"] = $req->name_etp;
                $data["email_etp"] = $req->email_resp_etp;
                // $data["tel_etp"] = $req->tel_resp_etp;
                // $data["web_etp"] = $req->web_etp;
                $data["nif"] = $req->nif;
                $data["secteur_id"] = $req->secteur_id;

                // ======= responsable
                $resp["matricule"] = $req->matricule_resp_etp;
                $resp["nom_resp"] = $req->nom_resp_etp;
                $resp["prenom_resp"] = $req->prenom_resp_etp;
                $resp["cin_resp"] = $req->cin_resp_etp;
                $resp["email_resp"] = $req->email_resp_etp;
                // $resp["tel_resp"] = $req->tel_resp_etp;
                // $resp["fonction_resp"] = $req->fonction_resp_etp;

                $verify = $this->new_compte->verify_etp($req->name_etp, $req->email_resp_etp);
                $verify_etp_nif = $this->fonct->findWhere("entreprises", ["nif"], [$req->nif]);
                $verify_resp_cin = $this->fonct->findWhere("users", ["cin"], [$req->cin_resp_etp]);
                $verify_resp_mail = $this->fonct->findWhere("users", ["email"], [$req->email_resp_etp]);


                if (count($verify) <= 0) { // etp n'existe pas


                    if (count($verify_etp_nif) <= 0) {
                        if (count($verify_resp_cin) <= 0) {
                            if (count($verify_resp_mail) <= 0) {
                                // if (count($verify_resp_tel) <= 0) {

                                    $this->user->name = $req->nom_resp_etp . " " . $req->prenom_resp_etp;
                                    $this->user->email = $req->email_resp_etp;
                                    $this->user->cin = $req->cin_resp_etp;
                                    // $this->user->telephone = $req->tel_resp_etp;
                                    $ch1 = "0000";
                                    $this->user->password = Hash::make($ch1);
                                    $this->user->save();

                                    $user_id = User::where('email', $req->email_resp_etp)->value('id');
                                    $this->new_compte->insert_ETP($data, $url_logo);

                                    $etp_id = $this->fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_resp_etp])->id;
                                    $resp_etp = $this->fonct->findWhere("responsables", ["entreprise_id"], [$etp_id]);
                                    $this->new_compte->insert_resp_ETP($resp, $etp_id, $user_id);
                                    DB::beginTransaction();
                                    try {
                                        $this->fonct->insert_role_user($user_id, "2",true, true); // referent (user_id, role_id, prioriter, activiter)
                                        $this->fonct->insert_role_user($user_id, "3",false, false); // stagiaires (user_id, role_id, prioriter, activiter)
                                        DB::commit();
                                    } catch (Exception $e) {
                                        DB::rollback();
                                        echo $e->getMessage();
                                    }

                                    //============= save image

                                    // $this->img->store_image("entreprise", $data["logo_etp"], $req->file('logo_etp')->getContent());
                                    $etp =  $this->fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_resp_etp]);
                                    $name = $req->nom_resp_etp . ' ' . $req->prenom_resp_etp;
                                    Mail::to($req->email_resp_etp)->send(new save_new_compte_etp_Mail($name, $req->email_resp_etp, $etp->nom_etp));
                                    $req->logo_etp->move(public_path('images/entreprises'), $data["logo_etp"]);  //save image cfp

                                    if (Gate::allows('isSuperAdminPrincipale')) {
                                        return back();
                                    } else {
                                        return redirect()->route('inscription_save');
                                    }
                                // } else {
                                //     return back()->with('error', 'télephone existe déjà!');
                                // }
                            } else {
                                return back()->with('error', 'email existe déjà!');
                            }
                        } else {
                            return back()->with('error', 'CIN existe déjà!');
                        }
                    } else {
                        return back()->with('error', 'NIF existe déjà!');
                    }
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

    public function verify_name_etp(Request $req)
    {
        $data = DB::select("select * from entreprises where UPPER(nom_etp)=UPPER('" . $req->valiny . "')");
        return response()->json($data);
    }

    public function verify_name_cfp(Request $req)
    {
        $data = DB::select("select * from cfps where UPPER(nom)=UPPER('" . $req->valiny . "')");
        return response()->json($data);
    }
}
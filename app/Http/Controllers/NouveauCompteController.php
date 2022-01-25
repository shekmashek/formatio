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

    public function create(Request $req)
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
    }


    public function search_entreprise_referent(Request $req){
        $results = array();
        $data = $this->new_compte->search_etp($req->search);
        foreach ($data as $query)
        {
            $results[] = [ 'id' => $query->nom_etp, 'value' => $query->nom_etp ];
        }
        return response()->json($results);
    }



}

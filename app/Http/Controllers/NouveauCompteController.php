<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\NouveauCompte;
use App\User;

class NouveauCompteController extends Controller
{
    public function __construct()
    {
        $this->new_compte = new NouveauCompte();
        $this->user = new User();


    }

    public function create(Request $req){

        if($req->entreprise_id == 1){ //========= create CFP ou OF
            $data["domaine_cfp"] = $req->domaine_cfp;
            $data["nom_cfp"] = $req->name_entreprise;
            $data["lot"] = $req->lot;
            $data["ville"] = $req->ville;
            $data["region"] = $req->region;
            $data["email_cfp"]=$req->email_cfp;
            $data["tel_cfp"] = $req->tel_cfp;
            $data["web_cfp"] = $req->web_cfp;
            $data["nif"] = $req->nif;
            $data["stat"]=$req->stat;
            $data["rcs"] = $req->rcs;
            $data["cif"] = $req->cif;

        $this->user->name = $req->name_entreprise;
        $this->user->email = $req->email_cfp;
        $ch1 = $req->name_entreprise;
        $ch2 = substr($req->tel_cfp,8,2);
        $this->user->password = Hash::make($ch1.$ch2);
        $this->user->role_id = '7';
        $this->user->save();
        // //get user id
        $user_id = User::where('email',$req->email_cfp)->value('id');

        $this->new_compte->insert_CFP($data,$user_id);

        }
        if($req->entreprise_id == 2) {// =========== create responsable ETP
            $data["nom_etp"] = $req->nom_entreprise;
            $data["nom_resp"] = $req->nom_resp;
            $data["prenom_resp"] = $req->prenom_resp;
            $data["function_resp"] = $req->function_resp;
            $data["email_resp"]=$req->email_resp;
            $data["tel_resp"] = $req->tel_resp;
            $data["web_etp"] = $req->web_etp;
            $data["nif"] = $req->nif;
            $data["stat"]=$req->stat;
            $data["rcs"] = $req->rcs;
            $data["cif"] = $req->cif;

            $this->user->name = $req->nom_resp;
            $this->user->email = $req->email_resp;
            $ch1 = $req->nom_resp;
            $ch2 = substr($req->tel_resp,8,2);
            $this->user->password = Hash::make($ch1.$ch2);
            $this->user->role_id = '2';
            $this->user->save();
            // //get user id
        $user_id = User::where('email',$req->email_resp)->value('id');

        // $this->new_compte->insert_Responsable($data,$entreprise_id,$user_id);
        }
    }
}

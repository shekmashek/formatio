<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        return view('create_compte.create_compte_client', compact('departements', 'secteurs'));
    }

    public function create_compte_cfp(Request $req)
    {
        // ======== cfp
        // $data["logo_cfp"] = $req->logo_cfp;
        $date = date('d-m-y');
        $data["logo_cfp"]  = str_replace(' ', '_', $req->name_cfp .  '' . $req->tel_cfp . '' . $date . '.' . $req->logo_cfp->extension());

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
        $resp["photo_resp"]  = str_replace(' ', '_', $req->nom_resp_cfp .  '' . $req->tel_resp_cfp . '' . $date . '.' . $req->photo_resp_cfp->extension());
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
            $ch1 = "0000";
            $this->user->password = Hash::make($ch1);
            $this->user->role_id = '7';

            $this->user->save();

            $user_id = User::where('email', $req->email_resp_cfp)->value('id');

            $this->new_compte->insert_CFP($data, $user_id);
            $cfp_id = $this->fonct->findWhereMulitOne("cfps", ["email"], [$req->email_cfp])->id;
            $resp_cfp = $this->fonct->findWhere("responsables_cfp", ["cfp_id"], [$cfp_id]);
            $this->new_compte->insert_resp_CFP($resp, $cfp_id, $user_id);

            //============= save image
            $folder = 'entreprise';
            $folder2 = 'responsable';
            //liste des contenues dans drive
            $contents = collect(Storage::cloud()->listContents('/', false));

            //recuperer dossier "entreprise
            $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $folder)
                ->first();
            $dir2 = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $folder2)
                ->first();
            Storage::cloud()->put($dir['path'] . '/' . $data["logo_cfp"], $req->file('logo_cfp')->getContent());
            Storage::cloud()->put($dir2['path'] . '/' . $resp["photo_resp"], $req->file('photo_resp_cfp')->getContent());

            return redirect()->route('inscription_save');
        } else {
            return back()->with('error', 'Organisation de Formation existe déjà!');
        }
    }


    public function create_compte_employeur(Request $req)
    {
        // ======== ETP
        // $data["logo_etp"] = $req->logo_etp;
        $date = date('d-m-y');
        $data["logo_etp"]  = str_replace(' ', '_', $req->name_etp .  '' . $req->tel_etp . '' . $date . '.' . $req->logo_etp->extension());

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

        // ============== responsable
        $resp["photo_resp"]  = str_replace(' ', '_', $req->nom_resp .  '' . $req->tel_resp . '' . $date . '.' . $req->photo_resp->extension());

        $resp["nom_resp"] = $req->nom_resp;
        $resp["prenom_resp"] = $req->prenom_resp;
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
            $ch1 = "0000";
            $this->user->password = Hash::make($ch1);
            $this->user->role_id = '2';

            $this->user->save();

            $user_id = User::where('email', $req->email_resp)->value('id');

            $this->new_compte->insert_ETP($data, $user_id);

            $entreprise_id = $this->fonct->findWhereMulitOne("entreprises", ["email_etp"], [$req->email_etp])->id;
            $this->new_compte->insert_resp_ETP($resp, $entreprise_id, $user_id);

            //============= save image
            $folder = 'entreprise';
            $folder2 = 'responsable';
            //liste des contenues dans drive
            $contents = collect(Storage::cloud()->listContents('/', false));
            //recuperer dossier "entreprise
            $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $folder)
                ->first();
            $dir2 = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $folder2)
                ->first();
            Storage::cloud()->put($dir['path'] . '/' . $data["logo_etp"], $req->file('logo_etp')->getContent());
            Storage::cloud()->put($dir2['path'] . '/' . $resp["photo_resp"], $req->file('photo_resp')->getContent());

            return redirect()->route('inscription_save');
        } else {
            return back()->with('error', 'Organisation de Formation existe déjà!');
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

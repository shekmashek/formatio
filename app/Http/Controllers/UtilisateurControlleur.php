<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\entreprise;
use App\stagiaire;
use App\responsable;
use App\formateur;
use App\cfp;
use App\Models\getImageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;

class UtilisateurControlleur extends Controller
{
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
        $this->user = new User();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id = null)
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        if ($id) $datas = responsable::orderBy('nom_resp')->with('entreprise')->take($id)->get();
        else  $datas = responsable::orderBy("nom_resp")->with('entreprise')->get();
        return view('admin.utilisateur.utilisateur', compact('datas', 'liste'));
    }

    public function create($id = null)
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        if ($id) $datas = stagiaire::orderBy('nom_stagiaire')->with('entreprise')->take($id)->get();
        else  $datas = stagiaire::orderBy("nom_stagiaire")->with('entreprise')->get();
        return view('admin.utilisateur.utilisateur_stagiaire', compact('datas', 'liste'));
    }
    public function liste_formateur()
    {
        $datas = formateur::orderBy("nom_formateur")->get();
        // if (count($datas) <= 0) {
        //     return view('admin.utilisateur.guide');
        // } else {
            return view('admin.utilisateur.utilisateur_formateur', compact('datas'));
        // }
    }

    public function store(Request $request)
    {
        //
    }

    public function admin()
    {
        // dd( $this->fonct->findWhere("v_user_role",["role_id"],["1"]));
        // $users = User::where('role_id', "1")->get();
        $users = $this->fonct->findWhere("v_user_role", ["role_id"], ["1"]);
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin/utilisateur/admin', compact('liste', 'users'));
    }
    public function new_admin(Request $request)
    {
        $user = new User();
        $user->name = $request->nom_new_user;
        $user->email = $request->email_new_user;
        $user->password = $request->password_new_user;

        $password = $user->password;
        $hashedPwd = Hash::make($password);
        $user->password = $hashedPwd;
        $user->role_id = $request->role_id;

        $user->save();
        return back();
    }

    public function cfp()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        $cfps = cfp::all();
        return view('admin.utilisateur.cfp', compact('liste', 'cfps'));
    }

    public function entreprise()
    {
        $entreprise = $this->fonct->findAll("entreprises");

        $branches = $this->fonct->findAll("departement_entreprises");
        return view('admin.utilisateur.entreprise', compact('entreprise', 'branches'));
    }

    public function superAdmin()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        // $supers = User::where('role_id', '6')->get();
        $supers = $this->fonct->findWhere("v_user_role", ["role_id"], ["6"]);

        return view('admin/utilisateur/superAdmin', compact('liste', 'supers'));
    }

    public function new_resp_cfp(Request $req)
    {
        $cfps = $this->fonct->findAll("cfps");
        return view('admin.utilisateur.new_resp_cfp', compact('cfps'));
    }
    public function new_resp_etp(Request $req)
    {
        $entreprises = $this->fonct->findAll("entreprises");
        return view('admin.utilisateur.new_resp_etp', compact('entreprises'));
    }


    public function delete_cfp($id)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        $resp_cfp = $this->fonct->findWhere("responsables_cfp", ["cfp_id"], [$id]);
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($resp_cfp); $i += 1) {
                DB::delete('delete from users where id = ?', [$resp_cfp[$i]->user_id]);
                if ($resp_cfp[$i]->photos_resp_cfp != null) {
                    File::delete("images/responsables/" . $resp_cfp[$i]->photos_resp_cfp);
                }
            }
            DB::delete('delete from modules where cfp_id = ?', [$id]);
            DB::delete('delete from responsables_cfp where cfp_id = ?', [$id]);
            DB::delete('delete from cfps where id = ?', [$id]);
            File::delete("images/CFP/" . $cfp->logo);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back();
    }

    public function delete_resp_cfp($id)
    {
        $resp = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["id"], [$id]);
        if ($resp->prioriter == true) {
            DB::beginTransaction();
            try {
                $resp_cfp = $this->fonct->findWhere("responsables_cfp", ["cfp_id"], [$resp->cfp_id]);
                for ($i = 0; $i < count($resp_cfp); $i += 1) {
                    DB::delete('delete from users where id = ?', [$resp_cfp[$i]->user_id]);
                    if ($resp_cfp[$i]->photos_resp_cfp != null) {
                        File::delete("images/responsables/" . $resp_cfp[$i]->photos_resp_cfp);
                    }
                }
                DB::delete('delete from responsables_cfp where cfp_id = ?', [$resp->cfp_id]);
                DB::delete('delete from modules where cfp_id = ?', [$resp->cfp_id]);
                DB::delete('delete from cfps where id = ?', [$resp->cfp_id]);
                File::delete("images/CFP/" . $resp->logo_cfp);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        } else {
            DB::beginTransaction();
            try {
                DB::delete('delete from role_users where user_id = ?', [$resp->user_id]);
                DB::delete('delete from users where id = ?', [$resp->user_id]);
                if ($resp->photos_resp_cfp != null) {
                    File::delete("images/responsables/" . $resp->photos_resp_cfp);
                }
                DB::delete('delete from responsables_cfp where id = ?', [$id]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }

        return back();
    }

    public function delete_resp_etp($id)
    {
        $resp = $this->fonct->findWhereMulitOne("responsables", ["id"], [$id]);
        if ($resp->prioriter == true) {
            DB::beginTransaction();
            try {
                $resp = $this->fonct->findWhere("responsables", ["entreprise_id"], [$resp->entreprise_id]);
                for ($i = 0; $i < count($resp); $i += 1) {
                    DB::delete('delete from users where id = ?', [$resp[$i]->user_id]);
                    if ($resp[$i]->photos != null) {
                        File::delete("images/responsables/" . $resp[$i]->photos);
                    }
                }
                DB::delete('delete from responsables where entreprise_id = ?', [$resp->entreprise_id]);
                DB::delete('delete from entreprises where id = ?', [$resp->entreprise_id]);
                File::delete("images/entreprises/" . $resp->logo);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        } else {
            DB::beginTransaction();
            try {
                DB::delete('delete from role_users where user_id = ?', [$resp->user_id]);
                DB::delete('delete from users where id = ?', [$resp->user_id]);
                if ($resp->photos != null) {
                    File::delete("images/responsables/" . $resp->photos);
                }
                DB::delete('delete from responsables where id = ?', [$id]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }

        return back();
    }

    public function save_new_resp_cfp(Request $req)
    {

        $this->user->name = $req->nom_resp_cfp . " " . $req->prenom_resp_cfp;
        $this->user->email = $req->email_resp_cfp;
        $this->user->cin = $req->cin_resp_cfp;
        $this->user->telephone = $req->tel_resp_cfp;
        $ch1 = "0000";
        $this->user->password = Hash::make($ch1);
        $this->user->save();

        $user_id = User::where('email', $req->email_resp_cfp)->value('id');
        $data = [
            $req->nom_resp_cfp, $req->prenom_resp_cfp, $req->cin_resp_cfp, $req->email_resp_cfp,
            $req->tel_resp_cfp, $req->fonction_resp_cfp, $req->cfp_id, $user_id
        ];

        DB::beginTransaction();
        try {
            DB::insert('insert into responsables_cfp(nom_resp_cfp,prenom_resp_cfp,cin_resp_cfp,email_resp_cfp,telephone_resp_cfp,fonction_resp_cfp
            ,cfp_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,?,?,1,NOW(),false)', $data);
            $this->fonct->insert_role_user($user_id, "7", true); // CFP
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
            return back();
    }

    public function save_new_resp_etp(Request $req)
    {
        $verify_matricule = $this->fonct->findWhere("responsables", ["matricule","entreprise_id"], [$req->matricule_resp_etp,$req->entreprise_id]);
        if(count($verify_matricule)<=0){

        $this->user->name = $req->nom_resp . " " . $req->prenom_resp;
        $this->user->email = $req->email_resp;
        $this->user->cin = $req->cin_resp;
        $this->user->telephone = $req->tel_resp;
        $ch1 = "0000";
        $this->user->password = Hash::make($ch1);
        $this->user->save();

        $user_id = User::where('email', $req->email_resp)->value('id');
        $data = [
           $req->matricule_resp_etp, $req->nom_resp, $req->prenom_resp, $req->cin_resp, $req->email_resp,
            $req->tel_resp, $req->fonction_resp, $req->entreprise_id, $user_id
        ];

        DB::beginTransaction();
        try {
            DB::insert('insert into responsables(matricule,nom_resp,prenom_resp,cin_resp,email_resp,telephone_resp,fonction_resp
            ,entreprise_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,?,?,?,1,NOW(),false)', $data);
            $this->fonct->insert_role_user($user_id, "2", true); // RH
            $this->fonct->insert_role_user($user_id, "3", false); // STG
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
            return back();
        } else{
            return back()->with('error','matricule ');
        }
    }


    public function delete_entreprise($id)
    {
        $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$id]);
        $resp = $this->fonct->findWhere("responsables", ["entreprise_id"], [$id]);

        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($resp); $i += 1) {
                DB::delete('delete from users where id = ?', [$resp[$i]->user_id]);
                if ($resp[$i]->photos != null) {
                    File::delete("images/responsables/" . $resp[$i]->photos);
                }
            }
            DB::delete('delete from appel_offres where entreprise_id = ?', [$id]);
            DB::delete('delete from responsables where entreprise_id = ?', [$id]);
            DB::delete('delete from entreprises where id = ?', [$id]);
            if ($entreprise != null) {
                File::delete("images/entreprises/" . $entreprise->logo);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back();
    }

    public function new_cfp()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin.utilisateur.new_cfp', compact('liste'));
    }

    public function new_entreprise()
    {
        // dd("ok");
        $secteur = $this->fonct->findAll("secteurs");
        return view('admin.utilisateur.new_etp', compact('secteur'));
    }


    public function profil_cfp($id)
    {
        // $liste_cfps = cfp::findOrFail($id)->get();
        $fonct = new FonctionGenerique();
        $liste_cfps = DB::select('select * from cfps where id = ' . $id);
        $horaire = $fonct->findWhere("v_horaire_cfp",["cfp_id"],[$id]);
        $reseaux_sociaux = $fonct->findWhere("reseaux_sociaux",["cfp_id"],[$id]);

        return view('admin.utilisateur.profil_cfp', compact('liste_cfps','horaire','reseaux_sociaux'));
    }
    public function register_cfp(Request $request)
    {

        $new_cfp = new cfp();

        $new_cfp->nom = $request->get('nom');
        $new_cfp->adresse_lot = $request->get('adresse_lot');
        $new_cfp->adresse_ville = $request->get('adresse_ville');
        $new_cfp->adresse_region = $request->get('adresse_region');
        $new_cfp->email = $request->get('email');
        $new_cfp->telephone = $request->get('telephone');
        $new_cfp->domaine_de_formation = $request->get('domaine');
        $new_cfp->nif = $request->get('nif');
        $new_cfp->stat = $request->get('stat');
        $new_cfp->rcs = $request->get('rcs');
        $new_cfp->cif = $request->get('cif');
        $new_cfp->site_cfp = $request->get('site');

        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->email;
        $ch1 = $request->nom;
        $ch2 = substr($request->telephone, 8, 2);
        $user->password = Hash::make($ch1 . $ch2);
        $user->role_id = '7';
        $user->save();
        //get user id
        $user_id = User::where('email', $request->email)->value('id');

        $date = date('d-m-Y');
        $nom_image = str_replace(' ', '_', $request->nom . '' . $date . '.' . $request->logo->extension());

        $str = 'images/CFP';
        //stocker logo dans google drive

        $dossier = 'entreprise';
        $stock_cfp = new getImageModel();
        $stock_cfp->store_image($dossier, $nom_image, $request->file('logo')->getContent());
        // $request->logo->move(public_path($str), $nom_image);

        $new_cfp->logo = $nom_image;
        $new_cfp->user_id = $user_id;
        $new_cfp->save();

        $cfps = cfp::all();
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin/utilisateur/cfp', compact('cfps', 'liste'));
    }
    public function update_cfp(Request $request, $id)
    {
        $update_cfp = cfp::where('id', $id)->update([
            'nom' => $request->get('nom_cfp'),
            'adresse_lot' => $request->get('adresse_lot'),
            'adresse_quartier' => $request->get('adresse_quartier'),
            'adresse_ville' => $request->get('adresse_ville'),
            'adresse_region' => Str::upper($request->get('adresse_region')),
            'email' => $request->get('email_cfp'),
            'telephone' => $request->get('telephone_cfp'),
            'site_cfp' => $request->get('site_web'),
            'domaine_de_formation' => $request->get('domaine_cfp'),
            'nif' => $request->get('nif_cfp'),
            'stat' => $request->get('stat_cfp'),
            'rcs' => $request->get('rcs_cfp'),
            'cif' => $request->get('cif_cfp'),
        ]);
        return back();
    }

    public function update_entreprise(Request $request, $id)
    {
        $update_cfp = entreprise::where('id', $id)->update([
            'nom_etp' => $request->get('nom_etp'),
            'adresse_rue' => $request->get('adresse_lot'),
            'adresse_quartier' => $request->get('adresse_quartier'),
            'adresse_ville' => $request->get('adresse_ville'),
            'adresse_region' => Str::upper($request->get('adresse_region')),
            'email_etp' => $request->get('email_etp'),
            'telephone_etp' => $request->get('telephone_etp'),
            'site_etp' => $request->get('site_web'),
            'nif' => $request->get('nif_etp'),
            'stat' => $request->get('stat_etp'),
            'rcs' => $request->get('rcs_etp'),
            'cif' => $request->get('cif_etp'),
        ]);
        return back();
    }

    public function update_resp_cfp(Request $req, $id)
    {
        $resp = $this->fonct->findWhereMulitOne("responsables_cfp", ["id"], [$id]);
        DB::beginTransaction();
        try {
            DB::update(
                "UPDATE users SET name=?,email=?,cin=?,telephone=? WHERE id=?",
                [$req->nom . " " . $req->prenom, $req->email_resp_cfp, $req->cin, $req->telephone, $resp->user_id]
            );
            DB::update(
                "UPDATE responsables_cfp SET nom_resp_cfp=?,prenom_resp_cfp=?,email_resp_cfp=?,cin_resp_cfp=?,telephone_resp_cfp=?,fonction_resp_cfp=?,sexe_resp_cfp=? WHERE id=?",
                [$req->nom, $req->prenom, $req->email_resp_cfp, $req->cin, $req->telephone, $req->fonction, $req->sexe, $id]
            );
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back();
    }

    public function update_resp_etp(Request $req, $id)
    {
        $resp = $this->fonct->findWhereMulitOne("responsables", ["id"], [$id]);
        DB::beginTransaction();
        try {
            DB::update(
                "UPDATE users SET name=?,email=?,cin=?,telephone=? WHERE id=?",
                [$req->nom . " " . $req->prenom, $req->email_resp, $req->cin, $req->telephone, $resp->user_id]
            );
            DB::update(
                "UPDATE responsables SET nom_resp=?,prenom_resp=?,email_resp=?,cin_resp=?,telephone_resp=?,fonction_resp=?,sexe_resp=? WHERE id=?",
                [$req->nom, $req->prenom, $req->email_resp, $req->cin, $req->telephone, $req->fonction, $req->sexe, $id]
            );
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back();
    }



    public function show_resp_cfp()
    {

        $responsables = $this->fonct->findAll("v_responsable_cfp");
        return view("admin.utilisateur.responsable_cfp", compact('responsables'));
    }
    public function show($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = responsable::orderBy('nom_resp')->where('entreprise_id', $id)->get();
        return view('admin.utilisateur.utilisateur', compact('datas', 'liste'));
    }
    public function show_stagiaire($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = stagiaire::orderBy('nom_stagiaire')->where('entreprise_id', $id)->get();
        return view('admin.utilisateur.utilisateur_stagiaire', compact('datas', 'liste'));
    }


    public function edit(Request $request)
    {
        $id = $request->Id;
        $user = User::where('id', $id)->get();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $id = $request->Id;
        //modifier les données
        $nom = $request->Nom;
        $mail = $request->Mail;
        User::where('id', $id)
            ->update([
                'name' => $nom,
                'email' => $mail
            ]);
        return redirect()->route('liste_utilisateur');
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
        //   $user = User::find($id);
        //   $user->delete();
        DB::beginTransaction();
        try {
            DB::delete('delete from users where id = ?', [$id]);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
}

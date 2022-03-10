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
        if (count($datas) <= 0) {
            return view('admin.utilisateur.guide');
        } else {
            return view('admin.utilisateur.utilisateur_formateur', compact('datas'));
        }
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
                DB::delete('delete from responsables_cfp where cfp_id = ?', [$id]);
                DB::delete('delete from cfps where id = ?', [$resp->cfp_id]);
                DB::delete('delete from modules where cfp_id = ?', [$id]);
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

    public function create_compte_employeur(Request $req)
    {


                // ======= responsable

                $resp["nom_resp"] = $req->nom_resp_cfp;
                $resp["prenom_resp"] = $req->prenom_resp_cfp;
                $resp["cin_resp"] = $req->cin_resp_cfp;
                $resp["email_resp"] = $req->email_resp_cfp;
                $resp["tel_resp"] = $req->tel_resp_cfp;
                $resp["fonction_resp"] = $req->fonction_resp_cfp;

                $verify_resp_cin = $this->fonct->findWhere("users", ["cin"], [$req->cin_resp_cfp]);
                $verify_resp_mail = $this->fonct->findWhere("users", ["email"], [$req->email_resp_cfp]);

                $verify_resp_tel = $this->fonct->findWhere("users", ["telephone"], [$req->tel_resp_cfp]);

                        if (count($verify_resp_cin) <= 0) {
                            if (count($verify_resp_mail) <= 0) {
                                if (count($verify_resp_tel) <= 0) {

                                    $this->user->name = $req->nom_resp_cfp . " " . $req->prenom_resp_cfp;
                                    $this->user->email = $req->email_resp_cfp;
                                    $this->user->cin = $req->cin_resp_cfp;
                                    $this->user->telephone = $req->tel_resp_cfp;
                                    $ch1 = "0000";
                                    $this->user->password = Hash::make($ch1);

                                    $this->user->save();

                                    $user_id = User::where('email', $req->email_resp_cfp)->value('id');
                                    $this->new_compte->insert_CFP($data);

                                    $cfp_id = $this->fonct->findWhereMulitOne("cfps", ["email"], [$req->email_resp_cfp])->id;
                                    $this->new_compte->insert_resp_CFP($resp, $cfp_id, $user_id);
                                    DB::beginTransaction();
                                    try {
                                        $this->fonct->insert_role_user($user_id, "7", true); // CFP
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
                                    }

                                    return redirect()->route('inscription_save');
                                } else {
                                    return back()->with('error', 'télephone existe déjà!');
                                }
                            } else {
                                return back()->with('error', 'email existe déjà!');
                            }
                        } else {
                            return back()->with('error', 'CIN existe déjà!');
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
                if ($resp[$i]->photos_resp != null) {
                    File::delete("images/responsables/" . $resp[$i]->photos_resp);
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
    public function profil_cfp($id)
    {
        // $liste_cfps = cfp::findOrFail($id)->get();
        $liste_cfps = DB::select('select * from cfps where id = ' . $id);
        return view('admin.utilisateur.profil_cfp', compact('liste_cfps'));
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

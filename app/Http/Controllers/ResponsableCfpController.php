<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
use App\ResponsableCfpModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class ResponsableCfpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }


    public function affReferent($id = null)
    {
        $fonct = new FonctionGenerique();

        if (Gate::allows('isCFP')) {
            if ($id!=null) {
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["id"],[$id]);

            }
            else{
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id]);
            }
            return view('cfp.responsable_cfp.profile', compact('refs'));

        }

    }


    public function index()
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        if (Gate::allows('isCFP')) {
            $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
            $responsable = DB::select("select * from responsables_cfp where cfp_id=? and id!=?", [$resp_cfp_connecter->cfp_id, $resp_cfp_connecter->id]);
            return view('cfp.responsable_cfp.nouveau_responsable', compact('resp_cfp_connecter', 'responsable'));
        }
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        $resp = new ResponsableCfpModel();
        $user = new User();

        $user_id = Auth::id();
        if (Gate::allows('isCFP')) {
            $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
            if ($resp_cfp_connecter->prioriter == 1) {
                $resp->verify_form($request);

                $verify_cin = $resp->verify_cin($request->input());
                $verify_email = $fonct->findWhere("users", ["email"], [$request->email]);
                $verify_phone = $fonct->findWhere("users", ["telephone"], [$request->phone]);

                $doner["cin"] = $resp->concat_nb_cin($request->input());
                $doner["nom"] = $request->nom;
                $doner["prenom"] = $request->prenom;
              //  $doner["sexe"] = $request->sexe;
              //  $doner["dte"] = $request->dte;
                $doner["email"] = $request->email;
                $doner["phone"] = $request->phone;
                $doner["fonction"] = $request->fonction;

                if (count($verify_cin) > 0) {
                    return back()->with('error', 'cin existe déjà');
                } else {
                    if (count($verify_email) > 0) {
                        return back()->with('error', 'mail existe déjà');
                    } else {
                        if (count($verify_phone) > 0) {
                            return back()->with('error', 'télephone existe déjà');
                        } else {
                            $user->name = $request->nom . " " . $request->prenom;
                            $user->email = $request->email;
                            $user->cin = $resp->concat_nb_cin($request->input());
                            $user->telephone =  $request->phone;
                            $ch1 = "0000";
                            $user->password = Hash::make($ch1);
                         //   $user->role_id = '7';
                            $user->save();
                            $use_id_inserer = $fonct->findWhereMulitOne("users",["email"],[$request->email])->id;

                            DB::beginTransaction();
                            try {
                                $fonct->insert_role_user($use_id_inserer,"7",true); // cfp
                                DB::commit();
                            } catch (Exception $e) {
                                DB::rollback();
                                echo $e->getMessage();
                            }


                            if (Gate::allows('isCFP')) {
                                $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
                                $result = $resp->insert_resp_CFP($doner, $resp_cfp_connecter->cfp_id, $user->id);
                                return $result;
                            }
                            if (Gate::allows('isSuperAdmin')) {
                                $result = $resp->insert_resp_CFP($doner, $request->cfp_id, $user->id);
                                return $result;
                            }
                            if (Gate::allows('isAdmin')) {
                                $result = $resp->insert_resp_CFP($doner, $request->cfp_id, $user->id);
                                return $result;
                            }
                        }
                    }
                }
            } else {
                return back()->with('error', "seul lre responsable principale a le droit d'ajouter un nouveau responsable");
            }
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $req)
    {
        $resp = new ResponsableCfpModel();
        $result = $resp->delete_resp_CFP($req->id);
        return $result;
    }
    //modification
    public function edit_photo($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_photo', compact('responsable'));
    }
    public function edit_nom($id){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_nom', compact('responsable'));
    }
    public function edit_naissance($id){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_dtn', compact('responsable'));
    }
    public function edit_genre($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_genre', compact('responsable'));
    }
    public function edit_mdp($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_mdp', compact('responsable'));
    }
    public function edit_mail($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_email', compact('responsable'));
    }
    public function edit_phone($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_phone', compact('responsable'));
    }
    public function edit_cin($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_cin', compact('responsable'));
    }
    public function edit_adresse($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_adresse', compact('responsable'));
    }
    public function edit_fonction($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_fonction', compact('responsable'));
    }


    //update responsable cfp
    public function update_nom_responsable($id,Request $request){
        DB::update('update users set name = ? where id = ?', [$request->nom.' '.$request->prenom, Auth::id()]);
        DB::update('update responsables_cfp set nom_resp_cfp = ?,prenom_resp_cfp = ? where user_id = ?', [$request->nom,$request->prenom, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_dtn_responsable($id,Request $request){
         DB::update('update responsables_cfp set date_naissance_resp_cfp = ? where user_id = ?', [$request->date_naissance, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_genre_responsable($id,Request $request){

        if($request->genre == "Homme") $genre = 2;
        if($request->genre == "Femme") $genre = 1;

        DB::update('update responsables_cfp set sexe_resp_cfp = ? where user_id = ?', [$genre, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_mdp_responsable($id,Request $request){
        $users =  db::select('select * from users where id = ?', [Auth::id()]);
        $pwd = $users[0]->password;
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->get('ancien_password'), $pwd)) {
            DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
            return redirect()->route('profil_du_responsable');
        } else {
            return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
        }
    }
    public function update_email_responsable($id,Request $request){
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id])->cfp_id;
        DB::update('update users set email = ? where id = ?', [$request->mail_resp, Auth::id()]);
        DB::update('update responsables_cfp set email_resp_cfp = ? where user_id = ?', [$request->mail_resp, Auth::id()]);
        DB::update('update cfps set email = ? where id = ?', [$request->mail_resp, $cfp_id]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_telephone_responsable($id,Request $request){
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id])->cfp_id;
        DB::update('update users set telephone = ? where id = ?', [$request->phone, Auth::id()]);
        DB::update('update responsables_cfp set telephone_resp_cfp = ? where user_id = ?', [$request->phone, Auth::id()]);
        DB::update('update cfps set telephone = ? where id = ?', [$request->phone, $cfp_id]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_cin_responsable($id,Request $request){
        DB::update('update users set cin = ? where id = ?', [$request->cin, Auth::id()]);
        DB::update('update responsables_cfp set cin_resp_cfp = ? where user_id = ?', [$request->cin, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_adresse_responsable($id,Request $request){
        DB::update('update responsables_cfp set adresse_lot = ?, adresse_quartier = ?, adresse_code_postal = ?, adresse_ville = ?, adresse_region = ? where user_id = ?', [$request->lot,$request->quartier,$request->code_postal,$request->ville,$request->region, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_fonction_responsable($id,Request $request){
        DB::update('update responsables_cfp set fonction_resp_cfp = ? where user_id = ?', [$request->fonction, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_photo_responsable($id,Request $request){
        $image = $request->file('image');
		 if($image != null){
			if($image->getSize() > 60000){
				return redirect()->back()->with('error_logo', 'La taille maximale doit être de 60Ko');
			}
			else{

					$user_id =  $users = Auth::user()->id;
					$responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
					$image_ancien = $responsable->photos_resp_cfp;
					//supprimer l'ancienne image
					File::delete(public_path("images/responsables/".$image_ancien));
					//enregiistrer la nouvelle photo

					$nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.' . $request->image->extension());
					$destinationPath = 'images/responsables';
					$image->move($destinationPath, $nom_image);
					$url_photo = URL::to('/')."/images/responsables/".$nom_image;

					DB::update('update responsables_cfp set photos_resp_cfp = ?,url_photo = ? where user_id = ?', [$nom_image,$url_photo, Auth::id()]);
					return redirect()->route('profil_du_responsable');
			}
		}
		else{
			return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
		}
    }
}

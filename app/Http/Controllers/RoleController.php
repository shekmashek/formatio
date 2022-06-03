<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\entreprise;
use App\RoleUser;
use App\Models\FonctionGenerique;
use App\Role;
use Illuminate\Support\Facades\Gate;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->liste_entreprise = entreprise::orderBy('nom_etp')->get();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }



    public function add_role_user(Request $request)
    {

        $user_id = $request->user_id;
        $role_id = $request->role_id;



        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            if ($resp_connecter->prioriter == true) {
                DB::beginTransaction();
                try {
                    DB::insert("insert into role_users(user_id,role_id,activiter) values (?,?,false)", [$user_id, $role_id]);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                return response()->json(['success' => "Terminé!"]);
            } else {
                return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
            }
        }
    }

    /*  public function add_role_user(Request $request, $user_id, $role_id)
    {
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            if ($resp_connecter->prioriter == true) {
                DB::beginTransaction();
                try {
                    DB::insert("insert into role_users(user_id,role_id,activiter) values (?,?,false)", [$user_id, $role_id]);
                    if ($role_id == 2) { // referent
                        $stg = $this->fonct->findWhereMulitOne("stagiaires", ["user_id"], [$user_id]);

                        $data = [
                            $stg->matricule, $stg->nom_stagiaire, $stg->prenom_stagiaire, $stg->cin, $stg->mail_stagiaire, $stg->telephone_stagiaire, $stg->fonction_stagiaire,
                            $stg->entreprise_id, $stg->user_id, $stg->genre_stagiaire, $stg->date_naissance, $stg->lot, $stg->ville, $stg->region, $stg->code_postal, $stg->quartier
                        ];
                        DB::insert('insert into responsables(matricule,nom_resp,prenom_resp,cin_resp,email_resp,telephone_resp,fonction_resp
                        ,entreprise_id,user_id,activiter,created_at,prioriter,sexe_resp,date_naissance_resp,adresse_lot,adresse_ville,adresse_region,adresse_code_postal,adresse_quartier) values(?,?,?,?,?,?,?,?,?,1,NOW(),false,?,?,?,?,?,?,?)', $data);
                    }
                    if ($role_id == 3) { // stagiaire
                    }
                    if ($role_id == 4) { // formateur
                    }
                    if ($role_id == 5) { // manager
                    }
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                return back();
            } else {
                return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
            }
        }
    }  */

    public function delete_role_user(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        // , $user_id, $role_id
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            if ($resp_connecter->prioriter == true) {
                DB::beginTransaction();
                try {
                    DB::delete("delete from role_users where user_id=? and role_id=?", [$user_id, $role_id]);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                return response()->json(['success' => "Terminé!"]);

              //  return back()->with('success_' . $user_id, "role de l'utilisateur a été rétiré!");
            } else {
                return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
            }
        }
    }

    public function change_role_user(Request $rq, $user_id, $role_id)
    {
        $role_user = new RoleUser();
        return $role_user->update_role_user($user_id, $role_id);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

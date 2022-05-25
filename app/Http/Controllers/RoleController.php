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
        $resp_new = $this->fonct->findWhereMulitOne("employers", ["user_id"], [$user_id]);
        //
        if (Gate::allows('isReferentPrincipale')) {
            DB::beginTransaction();
            try {
                DB::insert("insert into role_users(user_id,role_id,prioriter,activiter) values (?,?,false,true)", [$user_id, $role_id]);
                DB::update("update role_users set activiter=false where user_id=? and role_id=? ", [$user_id, 3]); // desactiver role stg
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
            return back()->with('success', 'attributtion de nouveau role "responsable" à "'.$resp_new->nom_emp.' '.$resp_new->prenom_emp.'" a été terminer avec success!');

        } else {
            return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
        }
    }

    /*  public function add_role_user(Request $request, $user_id, $role_id)
    {
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            if ($resp_connecter->prioriter == true) {
                DB::beginTransaction();
                try {
                    DB::insert("insert into role_users(user_id,role_id,prioriter,activiter) values (?,?,false,false)", [$user_id, $role_id]);
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

        $resp_new = $this->fonct->findWhereMulitOne("employers", ["user_id"], [$user_id]);

        if (Gate::allows('isReferentPrincipale')) {
            DB::beginTransaction();
            try {
                DB::delete("delete from role_users where user_id=? and role_id=?", [$user_id, $role_id]);
                DB::update("update role_users set activiter=true where user_id=? and role_id=? ", [$user_id, 3]); // activer role stg
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
            return back()->with('success', 'le role "responsable" à "'.$resp_new->nom_emp.' '.$resp_new->prenom_emp.'" a été rétiré avec success!');

        } else {
            return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
        }

        // if (Gate::allows('isReferent')) {
        //     $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
        //     if ($resp_connecter->prioriter == true) {
        //         DB::beginTransaction();
        //         try {
        //             DB::delete("delete from role_users where user_id=? and role_id=?", [$user_id, $role_id]);
        //             DB::commit();
        //         } catch (Exception $e) {
        //             DB::rollback();
        //             echo $e->getMessage();
        //         }
        //         return response()->json(['success' => "Terminé!"]);

        //       //  return back()->with('success_' . $user_id, "role de l'utilisateur a été rétiré!");
        //     } else {
        //         return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
        //     }
        // }
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

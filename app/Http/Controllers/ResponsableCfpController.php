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

class ResponsableCfpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
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
                                $fonct->insert_role_user($use_id_inserer,"7"); // cfp
                                // $fonct->insert_role_user($use_id_inserer,"3"); // stagiaire
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
}

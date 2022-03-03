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

    public function add_role_user(Request $request, $user_id_stg, $role_id)
    {
        // dd("user_id: ".$user_id_stg."  ,role_id: ".$role_id);
        // dd( $this->fonct->findWhereMulitOne("role_users", ["user_id"], [$user_id_stg]));

        if (Gate::allows('isReferent')) {

            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);

            if ($resp_connecter->prioriter == true) {
                // DB::beginTransaction();
                // try {
                    DB::insert("insert into role_users(user_id,role_id) values (?,?)", [$user_id_stg, $role_id]);
                //     DB::commit();
                // } catch (Exception $e) {
                //     DB::rollback();
                //     echo $e->getMessage();
                // }
                return back();
            } else {
                return back()->with('error', 'désolé,seul le responsable principale à le droit de modifier les roles des employés!');
            }
        }
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

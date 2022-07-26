<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Models\FonctionGenerique;


class AuthController extends Controller
{  public function __construct()
    {
        $this->fonct = new FonctionGenerique();
    }
    public function login(Request $request){
        $request->validate([
            'email' => ["required","email"],
            'password' => ["required"]
        ]);

        $data=null;
        $pwd = $this->fonct->findWhereMulitOne("users",["email"],[$request->email])->password;
        $verify=false;
        if (Hash::check($request->password, $pwd)) {
            $verify=true;
        }
        if($verify==true){
            $connected = $this->fonct->findWhereMulitOne("users",["email"],[$request->email]);
             $data["name"] = $connected->name;
             $data["token"] = Hash::make($connected->name."IOKL?".$connected->password."dsfsgdfsdf".$connected->email);
        } else {
            $data["name"] = null;
            $data["token"] =null;
        }
        $user_id = DB::table('users')->latest()->first()->id;
        $role_id_active =  $this->fonct->findWhereMulitOne("role_users",["user_id","activiter"],[$user_id,1]);
        return response()->json([
                    'connected' => $data,
                    'role' => $role_id_active
                ], 200);
    }
    public function inscription(Request $request)
    {
        $nom = $request->name;
        $password = Hash::make($request->password);

        DB::insert('insert into users(name,email,cin,password) values(?,?,?,?)', [$nom.' '.$request->prenom_emp,$request->email,$request->cin,$password]);
        DB::commit();

        $matricule = $request->matricule_emp;
        $nom_etp = $request->nom_etp;
        $nif = $request->nif;
        $logo = $request->logo;
            
           
        if($request->type_entreprise_id == "1"){
            $url_logo = URL::to('/')."/images/entreprises/".$logo;
             DB::insert('insert into entreprises (nom_etp, nif,logo,email_etp,url_logo,type_entreprise_id) values (?,?,?,?,?,?)', [$nom_etp,$nif,$logo,$request->email,$url_logo,1]);
             DB::commit();
             DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?, ?, ?, ?)', [$user_id, 3,0,0]);
             DB::commit();
             DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?, ?, ?, ?)', [$user_id, 2,1,1]);
             DB::commit();
        }
        if($request->type_entreprise_id == "2"){
            $url_logo = URL::to('/')."/images/CFP/".$logo;
             DB::insert('insert into entreprises (nom_etp, nif,logo,email_etp,url_logo,type_entreprise_id) values (?,?,?,?,?,?)', [$nom_etp,$nif,$logo,$request->email,$url_logo,2]);
             DB::commit();
             DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?, ?, ?, ?)', [$user_id, 7,1,1]);
             DB::commit();
        }
        $entreprise_id = DB::table('entreprises')->latest()->first()->id;
        $user_id = DB::table('users')->latest()->first()->id;

        DB::insert('insert into employers (matricule_emp, nom_emp,prenom_emp,cin_emp,email_emp,user_id,entreprise_id,prioriter) values (?, ?,?,?,?,?,?,?)', [$matricule,$nom,$request->prenom_emp,$request->cin,$request->email,$user_id,$entreprise_id,1]);
        DB::commit();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

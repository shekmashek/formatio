<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FonctionGenerique;

use Illuminate\Support\Facades\Gate;

class EmployeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
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

        $rules = [
            'nom.required' => 'le Nom ne doit pas être null',
            'matricule.required' => 'invalid',
            'mail.required' => 'invalid',
            'cin.required' => 'invalid',
            'fonction.required' => 'invalid',
            'phone.required' => 'invalid',
            'phone.email' => 'email est invalid'
        ];
        $critereForm = [
            'nom' => 'required',
            'matricule' => 'required',
            'mail' => 'required|email',
            'cin' => 'required',
            'fonction' => 'required',
            'phone' => 'required'
        ];
        $request->validate($critereForm, $rules);

        $user = new User();
        // dd($request->input());
        $matricule = $request->matricule;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $cin = $request->cin;
        $fonction = $request->fonction;
        $mail = $request->mail;
        $phone = $request->phone;

        if (Gate::allows('isReferent')) {

            $user->name = $request->nom . " " . $request->prenom;
            $user->email = $request->mail;
            $user->cin = $cin;
            $user->telephone =  $request->phone;
            $ch1 = "0000";
            $user->password = Hash::make($ch1);
            $user->save();
            // $nom_img = "images/users/user.png";

            $resp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;

            if ($request->type_enregistrement == "STAGIAIRE") {

                DB::beginTransaction();
                try {
                    $this->fonct->insert_role_user($user_id, "3"); // EMPLOYEUR
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                DB::insert("insert into stagiaires(matricule,nom_stagiaire,prenom_stagiaire,cin,mail_stagiaire,telephone_stagiaire,fonction_stagiaire,
                entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
                return back();
            }
            if ($request->type_enregistrement == "REFERENT") {
                DB::beginTransaction();
                try {
                    $this->fonct->insert_role_user($user_id, "2"); // RH
                    $this->fonct->insert_role_user($user_id, "3"); // EMPLOYEUR
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                DB::insert("insert into responsables(matricule,nom_resp,prenom_resp,cin_resp,email_resp,telephone_resp,fonction_resp
                ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
                return back();
            }
            if ($request->type_enregistrement == "MANAGER") {
                DB::beginTransaction();
                try {
                    $this->fonct->insert_role_user($user_id, "5"); // MANAGER
                    $this->fonct->insert_role_user($user_id, "3"); // EMPLOYEUR
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id,$user_id];
                DB::insert("insert into chef_departements(matricule,nom_chef,prenom_chef,cin_chef,mail_chef,telephone_chef,fonction_chef
                ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
                return back();
            }
        }


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

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Mail;
use App\Mail\new_employer\create_compte_new_employer_mail;
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
       $fonction_employer=null;
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
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$resp->entreprise_id]);
            $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;

            DB::beginTransaction();
                try {
                    if ($request->type_enregistrement == "STAGIAIRE") {
                        $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["3"])->role_description;
                        $this->fonct->insert_role_user($user_id, "3",false,true); // EMPLOYEUR
                    }
                    if ($request->type_enregistrement == "REFERENT") {
                        $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["2"])->role_description;
                        $this->fonct->insert_role_user($user_id, "2",false,true); // RH
                        $this->fonct->insert_role_user($user_id, "3",false,false); // EMPLOYEUR
                    }
                    if ($request->type_enregistrement == "MANAGER") {
                        $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["5"])->role_description;
                        $this->fonct->insert_role_user($user_id, "5",false,true); // MANAGER
                        $this->fonct->insert_role_user($user_id, "3",false,false); // EMPLOYEUR
                    }
                    $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                    DB::insert("insert into employers(matricule_emp,nom_emp,prenom,cin_emp,email_emp,telephone_emp,fonction_emp
                    ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);

                    DB::commit();

                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
            Mail::to($resp->email_resp)->send(new create_compte_new_employer_mail($entreprise->nom_etp, $resp, $request->nom.' '.$request->prenom, $request->mail,$fonction_employer));
            return back()->with('success',"Terminé !");
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

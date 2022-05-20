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
            $entreprise_id = $this->fonct->findWhere("responsables",["user_id"],[Auth::user()->id]);
             /**On doit verifier le dernier abonnement de l'entreprise pour pouvoir limité le referent à ajouter */
            $nb_referent = $this->fonct->findWhere("responsables",["entreprise_id"],[$entreprise_id]);
            $nb_stagiaire = $this->fonct->findWhere("stagiaires",["entreprise_id"],[$entreprise_id]);

            $abonnement_etp =  DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1',[$entreprise_id]);

            $user->name = $request->nom . " " . $request->prenom;
            $user->email = $request->mail;
            $user->cin = $cin;
            // $user->telephone =  $request->phone;
            $ch1 = "0000";
            $user->password = Hash::make($ch1);
            $user->save();
            // $nom_img = "images/users/user.png";

            $resp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$resp->entreprise_id]);
            $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;


            if ($request->type_enregistrement == "STAGIAIRE") {
                if($abonnement_etp[0]->max_emp == count($nb_stagiaire) && $abonnement_etp[0]->illimite = 0) return back()->with('error', "Vous avez atteint le nombre maximum d'employé, veuillez upgrader votre compte pour ajouter plus d'employé");
                else{
                    $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["3"])->role_description;

                    DB::beginTransaction();
                    try {
                        $this->fonct->insert_role_user($user_id, "3",true); // EMPLOYEUR
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }
                    $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                    DB::insert("insert into stagiaires(matricule,nom_stagiaire,prenom_stagiaire,cin,mail_stagiaire,telephone_stagiaire,fonction_stagiaire,
                    entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
                }
           }
            if ($request->type_enregistrement == "REFERENT") {
                if($abonnement_etp[0]->nb_utilisateur == count($nb_referent) && $abonnement_etp[0]->illimite = 0) return back()->with('error', "Vous avez atteint le nombre maximum de référént, veuillez upgrader votre compte pour ajouter plus de référent");
                else{
                    $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["2"])->role_description;

                    DB::beginTransaction();
                    try {
                        $this->fonct->insert_role_user($user_id, "2",true); // RH
                        $this->fonct->insert_role_user($user_id, "3",false); // EMPLOYEUR
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }
                    $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                    DB::insert("insert into responsables(matricule,nom_resp,prenom_resp,cin_resp,email_resp,telephone_resp,fonction_resp
                    ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
                }
            }
            if ($request->type_enregistrement == "MANAGER") {
                $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["5"])->role_description;

                DB::beginTransaction();
                try {
                    $this->fonct->insert_role_user($user_id, "5",true); // MANAGER
                    $this->fonct->insert_role_user($user_id, "3",false); // EMPLOYEUR
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    echo $e->getMessage();
                }
                $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id,$user_id];
                DB::insert("insert into chef_departements(matricule,nom_chef,prenom_chef,cin_chef,mail_chef,telephone_chef,fonction_chef
                ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,1,NOW())", $data);
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
        DB::delete('delete from users where id = ?', [$id]);
        DB::delete("delete from role_users where user_id=?",[$id]);
        DB::delete("delete from stagiaires where user_id=?",[$id]);
        return back();
    }
}

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
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
        DB::delete("delete from role_users where user_id=?", [$id]);
        DB::delete("delete from employers where user_id=?", [$id]);
        return back();
    }

    public function store(Request $request)
    {
        $rules = [
            'nom.required' => 'le Nom ne doit pas être null',
            'matricule.required' => 'invalid',
            'mail.required' => 'invalid',
            'cin.required' => 'invalid',
            'mail.email' => 'email est invalid'
        ];
        $critereForm = [
            'nom' => 'required',
            'matricule' => 'required',
            'mail' => 'required|email',
            'cin' => 'required'
        ];
        $request->validate($critereForm, $rules);

        $user = new User();
        // dd($request->input());
        $matricule = $request->matricule;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $cin = $request->cin;
        $mail = $request->mail;
        $phone = $request->phone;
        $fonction_employer = $request->fonction;

        $verify_mail = $this->fonct->findWhere("users", ["email"], [$mail]);
        $verify_cin = $this->fonct->findWhere("employers", ["cin"], [$cin]);

        if (count($verify_mail) < 0) {
            if (count($verify_cin) < 0) {
                if (Gate::allows('isReferent')) {
                    $entreprise_id = $this->fonct->findWhere("responsables", ["user_id"], [Auth::user()->id]);

                    /**On doit verifier le dernier abonnement de l'entreprise pour pouvoir limité le referent à ajouter */
                    $nb_referent = $this->fonct->findWhere("responsables", ["entreprise_id"], [$entreprise_id[0]->entreprise_id]);
                    $nb_stagiaire = $this->fonct->findWhere("stagiaires", ["entreprise_id"], [$entreprise_id[0]->entreprise_id]);

                    $abonnement_etp =  DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1', [$entreprise_id[0]->entreprise_id]);

                    $user->name = $request->nom . " " . $request->prenom;
                    $user->email = $request->mail;
                    $user->cin = $cin;
                    // $user->telephone =  $request->phone;
                    $ch1 = "0000";
                    $user->password = Hash::make($ch1);
                    $user->telephone = $phone;
                    $user->save();

                    $resp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
                    $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;


                    if ($abonnement_etp != null) {
                        if ($abonnement_etp[0]->max_emp == count($nb_stagiaire) && $abonnement_etp[0]->illimite = 0) return back()->with('error', "Vous avez atteint le nombre maximum d'employé, veuillez upgrader votre compte pour ajouter plus d'employé");
                    } else {
                    }
                    DB::beginTransaction();
                    try {
                        $this->fonct->insert_role_user($user_id, "3", true, true); // EMPLOYEUR
                        $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $resp->entreprise_id, $user_id, $fonction_employer];
                        DB::insert("insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp,telephone_emp,
                    entreprise_id,user_id,activiter,created_at,fonction_emp) values(?,?,?,?,?,?,?,?,1,NOW(),?)", $data);

                        //    Mail::to($resp->email_resp)->send(new save_new_compte_stagiaire_Mail($nom . ' ' . $prenom, $email, $etp->nom_etp));

                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }
                    return back()->with('success',"l'employer a été bien rétirer de la plateforme");
                    // return redirect()->route('employes.liste');
                } else {
                    return back()->with('error', 'CIN déjà utilisé');
                }
            } else {
                return back()->with('error', 'E-mail est déjà utilisé');
            }
        }
    }
}

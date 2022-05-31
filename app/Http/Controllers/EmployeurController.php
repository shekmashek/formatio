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
        $fonction_employer=$request->fonction;
        $niveau_etude_id = $request->niveau_etude_id;

        // if (Gate::allows('isReferent')) {
            
        //     $user->name = $request->nom . " " . $request->prenom;
        //     $user->email = $request->mail;
        //     $user->cin = $cin;
        //     $user->telephone = $phone;

        //     $ch1 = "0000";
        //     $user->password = Hash::make($ch1);
        //     // enregistrement de l'utilisateur

        //     // getting all from users table and check if the the email is already exist (pas vraiment utile avec la validation)
        //     $users = DB::table('users')->get();
        //     foreach ($users as $u) {
        //         if ($u->email == $mail) {
        //             // dd("email existe déjà");
        //             return redirect()->back()->with('error', 'email existe déjà');
        //         } 
        //     }

        //     $user->save();


            // $nom_img = "images/users/user.png";

            // getting the user from database responsables table where user_id = Auth::user()->id
            // $user_id = Auth::user()->id;
            // $user_responsable = DB::table('responsables')->where('user_id', $user_id)->first();

            // obtenir l'utilisateur dans la base de donnée de la table responsables qui a le meme id que l'utilisateur connecté
            // $user_responsable = DB::table('responsables')->where('user_id', Auth::user()->id)->first();

            // $resp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            // $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$resp->entreprise_id]);

            // $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;
            


            // if ($request->type_enregistrement == "STAGIAIRE") {

            //     $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["3"])->role_description;
                
            //     DB::beginTransaction();
            //     try {

            //         // insert into role_users (user_id, role_id,activiter) values (?, ?,?)
            //         // DB::table('role_users')->insert([
            //         //     'user_id' => $user_id,
            //         //     'role_id' => 3,
            //         //     'activiter' => true
            //         // ]);

            //         $this->fonct->insert_role_user($user_id, 3,true); // EMPLOYEUR

            //         DB::commit();
            //     } catch (Exception $e) {
            //         DB::rollback();
            //         echo $e->getMessage();
            //     }
            //     // generer un chiffre aleatoire entre 1 et 5 pour un id temporaire
            //     $temp_service_id = rand(1, 5);
                

            //     $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $niveau_etude_id, $user_id, $temp_service_id];
            //     // DB::insert("insert into stagiaires(matricule,nom_stagiaire,prenom_stagiaire,cin,mail_stagiaire,telephone_stagiaire,fonction_stagiaire,
            //     // entreprise_id, niveau_etude_id,user_id,service_id, activiter) values(?,?,?,?,?,?,?,?,?, ?, ?,1)", $data);

            //     DB::table('stagiaires')->insert([
            //         'matricule' => $matricule,
            //         'nom_stagiaire' => $nom,
            //         'prenom_stagiaire' => $prenom,
            //         'cin' => $cin,
            //         'mail_stagiaire' => $mail,
            //         'telephone_stagiaire' => $phone,
            //         'fonction_stagiaire' => $fonction,
            //         'entreprise_id' =>  $entreprise->id,
            //         'niveau_etude_id' => $niveau_etude_id,
            //         'user_id' => $user_id,
            //         'service_id' => $temp_service_id,
            //         'activiter' => true
            //     ]);
                
            // }

            
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhere("responsables",["user_id"],[Auth::user()->id]);

             /**On doit verifier le dernier abonnement de l'entreprise pour pouvoir limité le referent à ajouter */
            $nb_referent = $this->fonct->findWhere("responsables",["entreprise_id"],[$entreprise_id[0]->entreprise_id]);
            $nb_stagiaire = $this->fonct->findWhere("stagiaires",["entreprise_id"],[$entreprise_id[0]->entreprise_id]);

            $abonnement_etp =  DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1',[$entreprise_id[0]->entreprise_id]);

            $user->name = $request->nom . " " . $request->prenom;
            $user->email = $request->mail;
            $user->cin = $cin;
            // $user->telephone =  $request->phone;
            $ch1 = "0000";
            $user->password = Hash::make($ch1);
            $user->telephone = $phone;
            $user->save();
            // $nom_img = "images/users/user.png";

            $resp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$resp->entreprise_id]);
            $user_id = $this->fonct->findWhereMulitOne("users", ["email"], [$mail])->id;


            // if ($request->type_enregistrement == "STAGIAIRE") {
                if($abonnement_etp !=null){
                    if($abonnement_etp[0]->max_emp == count($nb_stagiaire) && $abonnement_etp[0]->illimite = 0) return back()->with('error', "Vous avez atteint le nombre maximum d'employé, veuillez upgrader votre compte pour ajouter plus d'employé");
                }
                else{
                    $fonction_employer = $this->fonct->findWhereMulitOne("roles",["id"],["3"])->role_description;

                    DB::beginTransaction();
                    try {
                        $this->fonct->insert_role_user($user_id, "3",false,true); // EMPLOYEUR
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }

                    $temp_service_id = rand(1, 5);
                    $data = [$matricule, $nom, $prenom, $cin, $mail, $phone, $fonction, $resp->entreprise_id, $user_id];
                    DB::table('stagiaires')->insert([
                    'matricule' => $matricule,
                    'nom_stagiaire' => $nom,
                    'prenom_stagiaire' => $prenom,
                    'cin' => $cin,
                    'mail_stagiaire' => $mail,
                    'telephone_stagiaire' => $phone,
                    'fonction_stagiaire' => $fonction,
                    'entreprise_id' =>   $resp->entreprise_id,
                    'niveau_etude_id' => $niveau_etude_id,
                    'user_id' => $user_id,
                    'service_id' => $temp_service_id,
                    'activiter' => true
                ]);
                }


            // cause une swift exception error
            // Mail::to($resp->email_resp)->send(new create_compte_new_employer_mail($entreprise->nom_etp, $resp, $request->nom.' '.$request->prenom, $request->mail,$fonction_employer));
        
            return redirect()->route('employes.liste')->with('success', 'Enregistrement réussi : '.$nom.' '.$prenom);

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

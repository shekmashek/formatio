<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\ReferentMail;
use App\Models\getImageModel;
use PDF;
use App\responsable;
use App\entreprise;
use App\User;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;
use App\branche;
/* ====================== Exportation Excel ============= */
use App\Exports\ResponsableExport;
use Excel;
use Illuminate\Support\Facades\URL;
use Exception;
use Image;

class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }

    public function show_responsable()
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        if (Gate::allows('isReferent')) {
            if (Gate::allows('isReferentPrincipale')) {
                $resp_etp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
                $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);

            }
            if (Gate::allows('isStagiairePrincipale')) {
                $resp_etp_connecter = $fonct->findWhereMulitOne('stagiaires', ["user_id"], [$user_id]);
                $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);

            }
            if (Gate::allows('isManagerPrincipale')) {
                $resp_etp_connecter = $fonct->findWhereMulitOne('chef_departements', ["user_id"], [$user_id]);
                $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);

            }
            return view('admin.entreprise.responsable.nouveau_responsable', compact('resp_etp_connecter', 'responsable'));
        }
    }

    public function save_responsable(Request $request)
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        $resp = new responsable();
        $user = new User();

        $user_id = Auth::id();
        if (Gate::allows('isReferent')) {
            $resp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
            if ($resp_connecter->prioriter == 1) {
                $resp->verify_form($request);

                $verify_cin = $resp->verify_cin($request->input());
                $verify_email = $fonct->findWhere("users", ["email"], [$request->email]);
                $verify_phone = $fonct->findWhere("users", ["telephone"], [$request->phone]);

                $doner["cin"] = $resp->concat_nb_cin($request->input());
                $doner["nom"] = $request->nom;
                $doner["prenom"] = $request->prenom;
                // $doner["sexe"] = $request->sexe;
                // $doner["dte"] = $request->dte;
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
                            $user->telephone = $request->phone;
                            $ch1 = "0000";
                            $user->password = Hash::make($ch1);
                            // $user->role_id = '2';
                            $user->save();
                            $use_id_inserer = $fonct->findWhereMulitOne("users", ["email"], [$request->email])->id;

                            DB::beginTransaction();
                            try {
                                $fonct->insert_role_user($use_id_inserer, "2",1); // referent etp
                                $fonct->insert_role_user($use_id_inserer, "3",1); // stagiaire
                                DB::commit();
                            } catch (Exception $e) {
                                DB::rollback();
                                echo $e->getMessage();
                            }

                            if (Gate::allows('isReferent')) {
                                $resp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
                                $result = $resp->insert_resp_ETP($doner, $resp_connecter->entreprise_id, $user->id);
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


    public function index($id = null)
    {
        $liste = entreprise::orderBy("nom_etp")->get();

        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];

        if ($id) $datas = responsable::orderBy('nom_resp')->with('User', 'entreprise')->take($id)->get();
        else  $datas =  responsable::orderBy("nom_resp")->with('User', 'entreprise')->get();

        return view('admin.responsable.responsable', compact('datas', 'liste', 'info_impression'));
    }

    public function create()
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        return view('admin.responsable.nouveauResponsable', compact('liste'));
    }

    public function store(Request $request)
    {
        // //condition de validation de formulaire
        // $request->validate(
        //     [
        //         'nom' => ["required"],
        //         'prenom' =>  ["required"],
        //         'fonction' => ["required"],
        //         'mail' => ["required"],
        //         'phone' => ["required"],
        //         'photos' => ["required"],
        //         'cin' => ["required"],
        //         'dte_resp' => ["required"],
        //         'lot' => ["required"],
        //         'code_postal' => ["required"],
        //         'ville' => ["required"],
        //         'region' => ["required"],
        //         'quartier' => ["required"],

        //     ],
        //     [
        //         'nom.required' => 'Veuillez remplir le champ',
        //         'prenom.required' => 'Veuillez remplir le champ',
        //         'fonction.required' =>  'Veuillez remplir le champ',
        //         'mail.required' =>  'Veuillez remplir le champ',
        //         'phone.required' => 'Veuillez remplir le champ',
        //         'photos.required' => 'Veuillez remplir le champ',
        //         'cin.required' => 'Veuillez remplir le champ',
        //         'lot.required' => 'Veuillez remplir le champ',
        //         'ville.required' => 'Veuillez remplir le champ',
        //         'code_postal.required' => 'Veuillez remplir le champ',
        //         'region.required' => 'Veuillez remplir le champ',
        //         'quartier.required' => 'Veuillez remplir le champ',
        //   'dte_resp' => 'Veuillez remplir le champ',





        //         // 'naissance.required' => 'Veuillez remplir le champ'
        //     ]
        // );


        //enregistrer les projets dans la bdd
        $resp = new responsable();
        $resp->nom_resp = $request->nom;
        $resp->prenom_resp = $request->prenom;
        $resp->fonction_resp = $request->fonction;
        $resp->email_resp = $request->mail;
        $resp->cin_resp = $request->cin_resp;
        // $resp->date_naissance_resp = $request->naissance;
        $resp->telephone_resp = $request->phone;
        $resp->adresse_lot = $request->lot;
        $resp->adresse_region = $request->region;
        $resp->adresse_ville = $request->ville;
        $resp->adresse_quartier = $request->quartier;
        $resp->adresse_code_postal = $request->code_postal;
        $resp->genre_id = $request->sexe_resp;
        $resp->poste_resp = $request->poste;
        $resp->date_naissance_resp = $request->dte_resp;
        //insertion image
        $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom .  '' . $request->phone . '.' . $request->photos->extension());
        $str = 'images/responsables/';
        //stocker logo dans google drive
        $dossier = 'responsable';
        $stock_resp = new getImageModel();
        $stock_resp->store_image($dossier, $nom_image, $request->file('photos')->getContent());
        $request->photos->move(public_path($str), $nom_image);
        $resp->photos = $nom_image;
        //enregistrer les emails , name et mot de passe dans user
        $user = new User();
        $user->name = $request->nom . " " . $request->prenom;
        $user->email = $request->mail;

        $user->cin = $request->cin;
        $user->telephone = $request->phone;

        $ch1 = '0000';
        // $ch2 = substr($request->phone, 8, 2);
        $user->password = Hash::make($ch1);
        $user->role_id = '2';
        $user->save();

        $user_id = User::where('email', $request->mail)->value('id');
        $resp->user_id = $user_id;
        //etp_id
        $resp->entreprise_id = $request->liste_etp;
        $resp->activiter = TRUE;
        $resp->save();

        DB::beginTransaction();
        try {
            $this->fonct->insert_role_user($user_id, "2",true); // Referent
            $this->fonct->insert_role_user($user_id, "3",false); // Manager
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        //envoyer un mail de notification à tous les utilisateurs admin
        $emails = User::where('role_id', '1')->get();
        foreach ($emails as $email) {
            Mail::to($email)->send(new ReferentMail());
        }

        //  $user_id=DB::select('select * from users where email = ?', [$request->mail]);
        //   $user_id = DB::table('users')->where('email', $request->mail)->value('email');
        //  $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom .  '' . $request->phone . '.' . $request->photos->extension());
        //     $str = 'images/responsables/';
        // $rqt =     DB::insert('insert into responsables (nom_resp,prenom_resp,sexe_resp,date_naissance_resp,cin_resp,email_resp,telephone_resp,fonction_resp,poste_resp,adresse_quartier,adresse_code_postal,adresse_lot,adresse_ville ,adresse_region,user_id,photos)
        //     values (?, ?,?,?,?,?,?,?,?,?,?,?,?)',
        //      [$request->nom,$request->prenom,$request->sexe_resp,$request->dte_resp,$request->cin_resp,$request->mail,$request->phone,$request->fonction,$request->poste,$request->quartier,$request->code_postal,$request->lot,$request->ville,$request->region,$user_id,$nom_image

        //  ]);
        //  dd($rqt);
        return redirect()->route('liste_responsable');
    }
    public function affReferent()
    {
        $user_id = Auth::user()->id;
         if (Gate::allows('isReferentPrincipale')) {


            // if ($id != null) {

            //     $refs = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];

            // } else {

                $id = responsable::where('user_id', Auth::user()->id)->value('id');

                $entreprise = responsable::where('user_id',$user_id)->value('id');

                // $branche = branche::findorFail($id);

                $refs = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
                $nom_entreprise = $this->fonct->findWhereMulitOne("entreprises",["id"],[$refs->entreprise_id]);
            // }
            // dd($refs);
            return view('admin.responsable.profilResponsables', compact('refs','nom_entreprise'));
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') || Gate::allows('isCFP')) {

            $refs = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];

            return view('admin.responsable.profilResponsable', compact('refs'));
        }
    }


    public function affParametreReferent($id = null){

        // $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        if (Gate::allows('isReferent')) {
            // dd('eto');
            // if ($id != null) {
            //     dd($id);
            //     $refs = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
            // } else {
                $id = responsable::where('user_id', Auth::user()->id)->value('entreprise_id');
                $branche = $fonct->findWhereMulitOne('branches',['entreprise_id'],[$id]);
                // dd($branche);
                $refs = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
                $nom_entreprise = $this->fonct->findWhereMulitOne("entreprises",["id"],[$refs->entreprise_id]);
                $referent = entreprise::findOrFail($id);
                $entreprise = entreprise::with('Secteur')->findOrFail($id);
            // }

            return view('admin.responsable.affichage_parametreReferent', compact('refs','nom_entreprise','branche','referent','entreprise'));
        }
         if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') || Gate::allows('isCFP')) {
            $refs = $fonct->findWhereMulitOne("responsables",["id"],[$id]);

            $entreprise = entreprise::with('Secteur')->findOrFail($refs->entreprise_id);

            $branche = $fonct->findWhereMulitOne('branches',['entreprise_id'],[$refs->entreprise_id]);
            // $referent = entreprise::findOrFail($id);
            //  $entreprise_id=entreprise::where('id',$id)->value('id');

             $abonnement = $fonct->findWhere("v_abonnement_facture_entreprise",["entreprise_id"],[$refs->entreprise_id]);

            $responsables=responsable::where('entreprise_id',$refs->entreprise_id)->where('prioriter',0)->get();

           return view('admin.responsable.affichage_parametreReferents', compact('refs','entreprise','branche','responsables','abonnement'));
        }
    }
    public function show($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = responsable::orderBy('nom_resp')->where('entreprise_id', $id)->get();

        $info = entreprise::orderBy("nom_etp")->where('id', $id)->get();
        $info_impression = [
            'id' => $info[0]->id,
            'nom_entreprise' => $info[0]->nom_etp
        ];

        return view('admin.responsable.responsable', compact('datas', 'liste', 'info_impression'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $resp = responsable::where('id', $id)->with('entreprise')->get();
        return response()->json($resp);
    }
    //edit page pur chaque champs
    public function edit_nom($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_nom', compact('responsable'));
    }
    public function edit_naissance($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_naissance', compact('responsable'));
    }
    public function edit_genre($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_genre', compact('responsable'));
    }
    public function edit_mail($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_mail', compact('responsable'));
    }
    public function edit_phone($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_phone', compact('responsable'));
    }
    public function edit_adresse_etp($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_adresse_etp', compact('responsable'));
    }
    public function edit_logo($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_logo', compact('responsable'));
    }
    public function edit_site($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_site', compact('responsable'));
    }
    public function edit_email_etp($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_email_etp', compact('responsable'));
    }
    public function edit_phone_etp($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_phone_etp', compact('responsable'));
    }
    public function edit_cin($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_cin', compact('responsable'));
    }
    public function edit_adresse($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_adresse', compact('responsable'));
    }
    public function edit_fonction($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_fonction', compact('responsable'));
    }

    public function edit_entreprise($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_entreprise', compact('responsable'));
    }
    public function edit_nif($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_nif', compact('responsable'));
    }
    // public function edit_departement($id, Request $request){
    //     $liste_dep = Departement::all();
    //     $user_id =  $users = Auth::user()->id;
    //     $responsable_connecte = responsable::where('user_id', $user_id)->exists();
    //     $responsable = responsable::findOrFail($id);
    //     return view('admin.responsable.edit_departement', compact('responsable','liste_dep'));
    // }
    public function edit_stat($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_stat', compact('responsable'));
    }
    public function edit_rcs($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_rcs', compact('responsable'));
    }
    public function edit_cif($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_cif', compact('responsable'));
    }
    public function edit_photos($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_photos', compact('responsable'));
    }
    public function edit_pwd($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_pwd', compact('responsable'));
    }
    public function edit_poste($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.edit_poste', compact('responsable'));
    }
    public function update_etp(Request $request, $id)
    {
        $fonct = new FonctionGenerique();

        $resp_etp = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/responsables';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input = "$profileImage";
        }
        if ($input != null) {
            DB::update('update entreprises set nom_etp=?,adresse=?,logo=?,cif=?,nif=?,stat=?,rcs=?,email_etp=?,site_etp=?,telephone_etp=?
        where id=?', [
                $request->etp, $request->adresse_etp, $input, $request->cif, $request->nif,
                $request->stat, $request->rcs, $request->email_etp, $request->site, $request->phone_etp, $resp_etp->entreprise_id
            ]);

            //return redirect()->route('profil_referent');
        }
    }
    //modification photos
    public function update_photos_resp(Request $request)
    {
        $image = $request->file('image');
        //tableau contenant les types d'extension d'images
        $extension_type = array('jpeg','jpg','png','gif','psd','ai','svg');
        if($image != null){
            // if($image->getSize() > 60000){
            //     return redirect()->back()->with('error_logo', 'La taille maximale doit être de 60Ko');
            // }
            if(in_array($request->image->extension(),$extension_type)){
                $user_id =  $users = Auth::user()->id;
                $responsable = $this->fonct->findWhereMulitOne("responsables",["user_id"],[$user_id]);
                $image_ancien = $responsable->photos;
                //supprimer l'ancienne image
                File::delete(public_path("images/responsables/".$image_ancien));
                //enregiistrer la nouvelle photo
                $nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.' . $request->image->extension());
                $destinationPath = 'images/responsables';
                 //imager  resize

                 $image_name = $nom_image;

                 $destinationPath = public_path('images/responsables');

                 $resize_image = Image::make($image->getRealPath());

                 $resize_image->resize(228,128, function($constraint){
                     $constraint->aspectRatio();
                 })->save($destinationPath . '/' .  $image_name);
                // $image->move($destinationPath, $nom_image);
                $url_photo = URL::to('/')."/images/responsables/".$nom_image;
                DB::update('update responsables set photos = ?,url_photo = ? where user_id = ?', [$nom_image,$url_photo, Auth::id()]);
                return redirect()->route('profil_referent');
            }
            else{
                return redirect()->back()->with('error_format', 'Le format de votre fichier n\'est pas acceptable,choisissez entre : .jpeg,.jpg,.png,.gif,.psd,.ai,.svg');
            }
        }
        else{
            return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
        }

    }
    //update password
    public function update_responsable_mdp(Request $request)
    {

        $users =  db::select('select * from users where id = ?', [Auth::id()]);
        $pwd = $users[0]->password;
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->get('ancien_password'), $pwd)) {
            DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
            return redirect()->route('profil_referent');
        } else {
            return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
        }
    }
    //update e-mail
    public function update_mail_resp(Request $request)
    {
        DB::update('update users set email = ? where id = ?', [$request->mail_resp, Auth::id()]);
        DB::update('update responsables set email_resp = ? where user_id = ?', [$request->mail_resp, Auth::id()]);
        return redirect()->route('profil_referent');
    }
    public function update(Request $request, $id)
    {


        if (Gate::allows('isReferent')) {
            $fonct = new FonctionGenerique();

            $resp_etp = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);

            //modifier les données
            $nom = $request->nom;
            $prenom = $request->prenom;
            $date_naiss = $request->date_naissance;

            $cin = $request->cin;
            $genre = $request->genre;
            $code_postal = $request->code_postal;
            $ville = $request->ville;
            $region = $request->region;
            $quartier = $request->quartier;
            $lot = $request->lot;
            $mail = $request->mail;
            $poste = $request->poste;
            $fonction = $request->fonction;
            $phone =  $request->phone;
            $mdp = $request->password;
            $mdpHash = Hash::make($mdp);

            $input = $request->image;

            //stocker logo dans google drive
            //stocker logo dans google drive
            // $dossier = 'responsable';
            // $stock_stg = new getImageModel();
            // $nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.'. $request->image->extension());
            // $stock_stg->store_image($dossier,$nom_image , $request->file('image')->getContent());


            if ($image = $request->file('image')) {

                $destinationPath = 'images/responsables';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input = "$profileImage";
            }
            if ($input != null) {

                responsable::where('id', $id)
                    ->update([
                        'nom_resp' => $nom,
                        'prenom_resp' => $prenom,
                        'fonction_resp' => $fonction,
                        'email_resp' => $mail,
                        'telephone_resp' => $phone,
                        'date_naissance_resp' => $date_naiss,
                        'genre_id' => $genre,
                        'cin_resp' => $cin,
                        'adresse_lot' => $lot,
                        'adresse_code_postal' => $code_postal,
                        'adresse_quartier' => $quartier,
                        'adresse_ville' => $ville,
                        'adresse_region' => $region,
                        'poste_resp' => $poste,
                        'photos' => $input
                    ]);

            } else {
                responsable::where('id', $id)
                    ->update([
                        'nom_resp' => $nom,
                        'prenom_resp' => $prenom,
                        'fonction_resp' => $fonction,
                        'email_resp' => $mail,
                        'telephone_resp' => $phone,
                        'date_naissance_resp' => $date_naiss,
                        'genre_id' => $genre,
                        'cin_resp' => $cin,
                        'adresse_lot' => $lot,
                        'adresse_code_postal' => $code_postal,
                        'adresse_quartier' => $quartier,
                        'adresse_ville' => $ville,
                        'adresse_region' => $region,
                        'poste_resp' => $poste,

                    ]);
            }

            DB::update('update users set name = ? where id = ?', [$nom.' '.$prenom,Auth::user()->id]);
            DB::update('update users set telephone = ? where id = ?', [$phone,Auth::user()->id]);
            // DB::update('update users set cin = ? where id = ?', [$cin,Auth::user()->id]);

            return redirect()->route('profil_referent');
        }


        if (Gate::allows('isSuperAdmin') || Gate::allows('isReferent')) {
            $id = $request->Id;
            $user_id = responsable::where('id', $id)->value('user_id');
            //modifier les données
            // $dossier = 'stagiaire';
            // $stock_stg = new getImageModel();
            //  $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());
            $input = $request->image;
            if ($image = $request->file('image')) {
                $destinationPath = 'images/stagiaires';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input = "$profileImage";
            }
            $nom = $request->Nom;
            $prenom = $request->Prenom;
            $mail = $request->Mail;
            $fonction = $request->Fonction;
            $phone =  $request->Phone;
            if ($input != null) {


                responsable::where('id', $id)
                    ->update([
                        'nom_resp' => $nom,
                        'prenom_resp' => $prenom,
                        'fonction_resp' => $fonction,
                        'email_resp' => $mail,
                        'telephone_resp' => $phone,
                        'photos' => $input,
                        'adresse_lot' => $request->lot,
                        'adresse_region' => $request->region,
                        'adresse_ville' => $request->ville,
                        'adresse_quartier' => $request->quartier,
                        'adresse_code_postal' => $request->code_postal
                    ]);

            } else {
                responsable::where('id', $id)
                    ->update([
                        'nom_resp' => $nom,
                        'prenom_resp' => $prenom,
                        'fonction_resp' => $fonction,
                        'email_resp' => $mail,
                        'telephone_resp' => $phone,
                        'adresse_lot' => $request->lot,
                        'adresse_region' => $request->region,
                        'adresse_ville' => $request->ville,
                        'adresse_quartier' => $request->quartier,
                        'adresse_code_postal' => $request->code_postal
                    ]);
            }
            User::where('id', $user_id)
                ->update([
                    'name' => $nom,
                    'email' => $mail
                ]);
            return redirect()->route('liste_responsable');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $resp = Responsable::findOrFail($id);
        DB::beginTransaction();
        try {
            DB::delete('delete from users where id = ?', [$id]);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        //  $sup = User::where('id', $resp->user_id)->delete();
        //  $del = Responsable::where('id', $id)->delete();
        File::delete("images/responsables/" . $resp->photos);

        return back();
    }

    /*
        ====================  Generate PDF Liste de Responsable par Entreprise
    */
    public function generatePDF($id = null)
    {
        $entreprise = new entreprise();
        $responsable = new responsable();

        $nom_entr = null;

        if ($id == null) {
            $entreprises = $entreprise->orderBy('nom_etp')->get();
            $responsables = $responsable->orderBy('nom_resp')->with('User', 'entreprise')->get();
            $info_impression = [
                'id' => null,
                'nom_entreprise' => 'Tout'
            ];
        } else {
            $entreprises = $entreprise->orderBy('nom_etp')->where('id', $id)->get();
            $responsables = $responsable->orderBy('nom_resp')->where('entreprise_id', $id)->get();

            $info_impression = [
                'id' => $entreprises[0]->id,
                'nom_entreprise' => $entreprises[0]->nom_etp
            ];

            $nom_entr = $entreprises[0]->nom_etp;
        }


        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);


        $pdf = PDF::loadView('admin.pdf.pdf_responsable', compact('entreprises', 'responsables', 'info_impression'));
        if ($nom_entr != null) {
            return $pdf->download('Liste(s) Responsable(s) de ' . $nom_entr . '.pdf');
        } else {
            return $pdf->download('Liste(s) Responsable(s).pdf');
        }


        // return view('admin.pdf.pdf_responsable', compact('entreprises', 'responsables', 'info_impression'));
    }

    public function export()
    {

        return Excel::download(new ResponsableExport, 'gestion des responsables.xlsx');
    }

    //editer profil responsable
    public function edit_profil()
    {
        $id = responsable::where('user_id', Auth::user()->id)->value('id');
        $ref = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where id = ?',[$id])[0];
        return view('admin.responsable.updateResponsable', compact('ref'));
    }
    //fonction récupération photos depuis google drive
    public function getImage($path)
    {
        $dossier = 'responsable';
        $etp = new getImageModel();
        return $etp->get_image($path, $dossier);
    }
}

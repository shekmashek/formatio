<?php

namespace App\Http\Controllers;

use App\branche;
use App\chefDepartement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;
use App\Departement;
use App\DepartementEntreprise;
use App\entreprise;
use App\stagiaire;
use App\User;
use App\responsable;
use App\Models\getImageModel;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Mail;
use App\Mail\create_new_compte\save_new_compte_stagiaire_Mail;
use Image;

/* ====================== Exportation Excel ============= */
use App\Exports\ParticipantExport;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ParticipantController extends Controller
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

    public function get_service(Request $req)
    {
        $service = db::select('select * from v_departement_service_entreprise where departement_entreprise_id = ? ', [$req->id]);
        return response()->json($service);
    }



    public function desactiver_stagiaire(Request $req)
    {

        $stg = new stagiaire();
        $user_id = $req->user_id;
        $emp_id = $req->emp_id;
        $entreprise_id = 0;
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("chef_departements", ["user_id"], [$user_id])->entreprise_id;
        }
        $status = $stg->desactiver($user_id, $emp_id, $entreprise_id);

        return response()->json($status);
    }

    public function activer_stagiaire(Request $req)
    {

        $stg = new stagiaire();
        $user_id = $req->user_id;
        $emp_id = $req->emp_id;
        $entreprise_id = 0;
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("chef_departements", ["user_id"], [$user_id])->entreprise_id;
        }
        $status = $stg->activer($user_id, $emp_id, $entreprise_id);

        return response()->json($status);
    }

    public function new_emp()
    {
        // $fonct = new FonctionGenerique();


        // if (Gate::allows('isReferent')) {
        //     $entreprise_id = responsable::where('user_id', Auth()->user()->id)->value('entreprise_id');
        //     $liste_departement = db::select('select * from departement_entreprises where entreprise_id = ?', [$entreprise_id]);
        //     return view('admin.chefDepartement.chef', compact('liste_departement'));
        // }
        return view('admin.entreprise.employer.nouveau_employer');
    }

    public function liste_employer($paginations = null)
    {
        $entreprise_id = 0;
        $nb_limit = 10;
        $user_id = Auth::user()->id;
        $piasa = null;
        $employers = [];
        $responsables = [];
        $chefs = [];

        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id])->entreprise_id;
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("chef_departements", ["user_id"], [$user_id])->entreprise_id;
        }
        $totale_pag_stg = $this->fonct->getNbrePagination("stagiaires", "id", ["entreprise_id"], ["="], [$entreprise_id], "AND");
        $totale_pag_resp = $this->fonct->getNbrePagination("responsables", "id", ["entreprise_id"], ["="], [$entreprise_id], "AND");
        $totale_pag_chef = $this->fonct->getNbrePagination("chef_departements", "id", ["entreprise_id"], ["="], [$entreprise_id], "AND");

        $totale_pag = ($totale_pag_stg + $totale_pag_resp);

        // $totale_pag =  $totale_pag_stg;

        $service = $this->fonct->findWhere("v_departement_service_entreprise", ["entreprise_id"], [$entreprise_id]);

        if ($paginations != null) {

            if ($paginations <= 0) {
                $paginations = 1;
            }
            $piasa = DB::select("SELECT *, SUBSTRING(nom_stagiaire,1,1) AS nom_stg,SUBSTRING(prenom_stagiaire,1,1) AS prenom_stg FROM stagiaires WHERE entreprise_id=? ORDER BY created_at DESC LIMIT " . $nb_limit . " OFFSET " . ($paginations - 1), [$entreprise_id]);
            $resp = DB::select("SELECT *, SUBSTRING(nom_resp,1,1) AS nom_rsp,SUBSTRING(prenom_resp,1,1) AS prenom_rsp,role_users.prioriter FROM responsables,role_users WHERE responsables.user_id = role_users.user_id AND entreprise_id=?  ORDER BY created_at DESC LIMIT " . $nb_limit . " OFFSET " . ($paginations - 1), [$entreprise_id]);
            $sefo = DB::select("SELECT *, SUBSTRING(nom_chef,1,1) AS nom_cf,SUBSTRING(prenom_chef,1,1) AS prenom_cf FROM chef_departements WHERE entreprise_id=? LIMIT " . $nb_limit . " OFFSET " . ($paginations - 1), [$entreprise_id]);

            $pagination = $this->fonct->nb_liste_pagination($totale_pag, $paginations, $nb_limit);
        } else {
            if ($paginations <= 0) {
                $paginations = 1;
            }
            $piasa = DB::select("SELECT *, SUBSTRING(nom_stagiaire,1,1) AS nom_stg,SUBSTRING(prenom_stagiaire,1,1) AS prenom_stg FROM stagiaires WHERE entreprise_id=?  ORDER BY created_at DESC LIMIT " . $nb_limit . " OFFSET 0", [$entreprise_id]);
            $resp = DB::select("SELECT *, SUBSTRING(nom_resp,1,1) AS nom_rsp,SUBSTRING(prenom_resp,1,1) AS prenom_rsp,role_users.prioriter FROM responsables,role_users WHERE responsables.user_id = role_users.user_id AND entreprise_id=?  ORDER BY created_at DESC LIMIT " . $nb_limit . " OFFSET 0", [$entreprise_id]);
            $sefo = DB::select("SELECT *, SUBSTRING(nom_chef,1,1) AS nom_cf,SUBSTRING(prenom_chef,1,1) AS prenom_cf FROM chef_departements WHERE entreprise_id=?  ORDER BY created_at DESC LIMIT " . $nb_limit . " OFFSET 0", [$entreprise_id]);

            $pagination = $this->fonct->nb_liste_pagination($totale_pag, 0, $nb_limit);
        }

        for ($i = 0; $i < count($piasa); $i += 1) {
            if (count($service) > 0) {
                for ($j = 0; $j < count($service); $j += 1) {
                    if ($piasa[$i]->service_id != null && $piasa[$i]->service_id == $service[$j]->service_id) {
                        $piasa[$i]->departement_entreprise_id = $service[$j]->departement_entreprise_id;
                        $piasa[$i]->nom_service = $service[$j]->nom_service;
                        $piasa[$i]->nom_departement = $service[$j]->nom_departement;
                    }
                }
            } else {
                $piasa[$i]->departement_entreprise_id = null;
                $piasa[$i]->nom_service = null;
                $piasa[$i]->nom_departement = null;
            }
            $employers[] = $piasa[$i];
        }

        for ($i = 0; $i < count($resp); $i += 1) {
            if (count($service) > 0) {
                for ($j = 0; $j < count($service); $j += 1) {
                    if ($resp[$i]->service_id != null && $resp[$i]->service_id == $service[$j]->service_id) {
                        $resp[$i]->departement_entreprise_id = $service[$j]->departement_entreprise_id;
                        $resp[$i]->nom_service = $service[$j]->nom_service;
                        $resp[$i]->nom_departement = $service[$j]->nom_departement;
                    }
                }
            } else {
                $resp[$i]->departement_entreprise_id = null;
                $resp[$i]->nom_service = null;
                $resp[$i]->nom_departement = null;
            }
            $responsables[] = $resp[$i];
        }

        // for ($i = 0; $i < count($sefo); $i += 1) {
        //     if (count($service) > 0) {
        //         for ($j = 0; $j < count($service); $j += 1) {
        //             if ($sefo[$i]->service_id != null && $sefo[$i]->service_id == $service[$j]->service_id) {
        //                 $sefo[$i]->departement_entreprise_id = $service[$j]->departement_entreprise_id;
        //                 $sefo[$i]->nom_service = $service[$j]->nom_service;
        //                 $sefo[$i]->nom_departement = $service[$j]->nom_departement;
        //             }
        //         }
        //     } else {
        //         $sefo[$i]->departement_entreprise_id = null;
        //         $sefo[$i]->nom_service = null;
        //         $sefo[$i]->nom_departement = null;
        //     }
        //     $chefs[] = $sefo[$i];
        // }


        return view("admin.entreprise.employer.liste_employer", compact('responsables', 'employers', 'pagination'));
    }

    public function index()
    {
        $email_error = "";
        $matricule_error = "";
        $user_id = Auth::user()->id;

        if (Gate::allows('isSuperAdmin')) {
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            $liste_dep = Departement::all();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'liste_etp', 'email_error', 'matricule_error'));
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $liste_dep = db::select('select * from departement_entreprises where entreprise_id = ? ', [$entreprise_id]);
            $lieu_travail = db::select('select * from branches where entreprise_id = ? ', [$entreprise_id]);
            // $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->get();
            // return view('admin.participant.nouveauParticipant', compact('lieu_travail','liste_dep', 'email_error', 'matricule_error'));
            $service = db::select('select * from v_departement_service_entreprise where entreprise_id = ? ', [$entreprise_id]);



            // $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->get();
            return view('admin.participant.nouveauParticipant', compact('lieu_travail', 'service', 'liste_dep', 'email_error', 'matricule_error'));
        }
        if (Gate::allows('isManager')) {

            $entreprise_id = chefDepartement::where('user_id', [$user_id])->value('entreprise_id');
            $fonct = new FonctionGenerique();
            $chef = $fonct->findWhereMulitOne(
                "v_chef_departement_entreprise",
                ["entreprise_id", "user_id_chef_departement"],
                [$entreprise_id, $user_id]
            );

            $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->where('departement_id', [$chef->departement_id])->get();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'email_error', 'matricule_error'));
        }
    }

    public function create($id = null)
    {

        $user_id = Auth::user()->id;
        $id_etp = responsable::where('id', $user_id)->value('entreprise_id');
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        if (Gate::allows('isSuperAdmin')) {
            $datas = stagiaire::with('entreprise', 'User')->where('activiter', [true])->get();
        }
        if (Gate::allows('isReferent')) {
            if (Gate::allows('isReferentPrincipale')) {
                $entreprise_id = responsable::where('user_id', [$user_id])->value('entreprise_id');
            }
            if (Gate::allows('isStagiairePrincipale')) {
                $entreprise_id = stagiaire::where('user_id', [$user_id])->value('entreprise_id');
            }
            if (Gate::allows('isManagerPrincipale')) {
                $entreprise_id = chefDepartement::where('user_id', [$user_id])->value('entreprise_id');
            }

            // $rqt = DB::select('SELECT * from v_stagiaire_entreprise WHERE entreprise_id = ' . $entreprise_id);
            $datas = DB::select('SELECT * from stagiaires WHERE entreprise_id = ' . $entreprise_id);

            $ancien = DB::select('select * from v_historique_stagiaires where ancien_entreprise_id =' . $entreprise_id);
            // $datas = stagiaire::with('entreprise', 'User')->where('entreprise_id',[$entreprise_id])->get();
        }
        if (Gate::allows('isManagerPrincipale')) {
            $entreprise_id = chefDepartement::where('user_id', [$user_id])->value('entreprise_id');
            $fonct = new FonctionGenerique();
            $chef = $fonct->findWhereMulitOne(
                "v_chef_departement_entreprise",
                ["entreprise_id", "user_id_chef_departement"],
                [$entreprise_id, $user_id]
            );

            $datas = stagiaire::with('entreprise', 'User')->where('entreprise_id', [$entreprise_id])->where('departement_id', [$chef->departement_id])->where('activiter', [true])->get();
        }


        // if ($entreprise_id) {
        //     $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise')->where('entreprise_id', $entreprise_id)->get();
        // } else {
        //     if ($id) {
        //         $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise', 'user')->take($id)->get();
        //     } else {
        //         $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise', 'user')->get();
        //     }
        // }

        // dd($datas);
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        // return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression','id_etp'));
        return view('admin.participant.stagiaire_entreprise', compact('ancien', 'liste_etp', 'datas', 'info_impression', 'id_etp'));
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire


        /*      $request->validate(
            [
                'matricule' => ["required"],
                'nom' => ["required"],
                'prenom' =>  ["required"],
                'rue' =>  ["required"],
                'quartier' =>  ["required"],
                'code_postal' =>  ["required"],
                'ville' =>  ["required"],
                'region' =>  ["required"],
                'lot' =>  ["required"],
                'fonction' => ["required"],
                'mail' => ["required", "email"],
                'phone' => ["required"],
                'lieu' => ["required"],
                'image' => ["required"],
                'cin' =>  ["required"],

            ],
            [
                'matricule.required' => 'Veuillez remplir le champ',
                'nom.required' => 'Veuillez remplir le champ',
                'prenom.required' => 'Veuillez remplir le champ',
                'fonction.required' =>  'Veuillez remplir le champ',
                'mail.required' =>  'Veuillez remplir le champ',
                'mail.email' => 'Addresse mail non valide',
                'rue.required' => 'Veuillez remplir le champ',
                'quartier.required' => 'Veuillez remplir le champ',
                'ville.required' => 'Veuillez remplir le champ',
                'code_postal.required' => 'Veuillez remplir le champ',
                'lot.required' => 'Veuillez remplir le champ',
                'region.required' => 'Veuillez remplir le champ',
                'phone.required' => 'Veuillez remplir le champ',
                'image.required' => "Veuillez importer une photo",
                'cin.required' => 'Entrer le CIN',
            ]
        );

*/

        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', Auth::user()->id)->value('entreprise_id');
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = chefDepartement::where('user_id', Auth::user()->id)->value('entreprise_id');
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise_id = $request->liste_etp;
        }

        $participant = new stagiaire();
        $email = $participant->checkEmail($request->mail);
        $mat = $participant->checkMatricule($request->matricule);
        if ($email && $mat) {
            $email_error = "Cette addresse e-mail existe déjà.";
            $matricule_error = "Le numéro matricule saisi existe déjà.";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } elseif ($email) {
            $email_error = "Cette addresse e-mail existe déjà.";
            $matricule_error = "";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } elseif ($mat) {
            $email_error = "";
            $matricule_error = "Le numéro matricule saisi existe déjà.";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } else {
            $participant->matricule = $request->matricule;
            $participant->nom_stagiaire = $request->nom;
            $participant->branche_id = $request->lieu_travail;
            $participant->code_postal = $request->code_postal;
            $participant->region = $request->region;
            $participant->ville = $request->ville;
            $participant->lot = $request->lot;
            $participant->quartier = $request->quartier;
            $participant->prenom_stagiaire = $request->prenom;
            $participant->genre_stagiaire = $request->genre;
            $participant->titre = $request->titre;
            $participant->fonction_stagiaire = $request->fonction;
            $participant->mail_stagiaire = $request->mail;
            $participant->telephone_stagiaire = $request->phone;
            // $participant->CIN = $request->cin;
            $participant->date_naissance = $request->naissance;
            $participant->niveau_etude = $request->niveau;
            $date = date('d-m-Y');
            $nom_image = str_replace(' ', '_', $request->nom . '' . $request->phone . '' . $date . '.' . $request->image->extension());

            $str = 'images/stagiaires';

            //stocker logo dans google drive
            //stocker logo dans google drive

            $participant->photos = $nom_image;

            //enregistrer les emails , name et mot de passe dans user
            $user = new User();
            $user->name = $request->nom . " " . $request->prenom;
            $user->email = $request->mail;

            $user->cin = $request->cin;
            $user->telephone = $request->phone;

            $ch1 = '0000';
            // $ch2 = substr($request->phone, 8, 2);

            $user->password = Hash::make($ch1);
            $user->role_id = '3';
            $user->save();
            //get user id
            $user_id = User::where('email', $request->mail)->value('id');
            $participant->user_id = $user_id;

            $participant->service_id = $request->service_id;
            $participant->cin = $request->cin;
            $participant->date_naissance = $request->naissance;
            $participant->niveau_etude = $request->niveau;
            $participant->entreprise_id = $entreprise_id;
            // $request->image->move(public_path($str), $nom_image);
            $participant->save();
            // $request->image->move(public_path($str), $nom_image);
            DB::beginTransaction();
            try {
                $this->fonct->insert_role_user($user_id, "3", true); // Stagiaire
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }

            // $dossier = 'stagiaire';
            // $stock_stg = new getImageModel();
            // $stock_stg->store_image($dossier, $nom_image, $request->file('image')->getContent());

            return redirect()->route('liste_participant');
        }
    }

    public function show($id)
    {
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $datas = stagiaire::orderBy('nom_stagiaire')->where('entreprise_id', $id)->get();
        $info = entreprise::orderBy("nom_etp")->where('id', $id)->get();
        $info_impression = [
            'id' => $info[0]->id,
            'nom_entreprise' => $info[0]->nom_etp
        ];
        return view('admin.participant.participant', compact('datas', 'liste_etp', 'info_impression'));
    }

    public function edit($id, Request $request)
    {
        if ($id != null) {
            $user_id =  $users = Auth::user()->id;
            $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
            $stagiaire = stagiaire::findOrFail($id);
            if (Gate::allows('isReferent') || (Gate::allows('isSuperAdmin') || (Gate::allows('isManager')))) {
                return view('admin.participant.update', compact('stagiaire'));
            } else {
                return view('admin.participant.update', compact('stagiaire'));
            }
        } else {


            $participant = stagiaire::where('id', $id)->get();

            return response()->json($participant);
        }
    }
    //edit page pur chaque champs
    public function edit_nom($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        // $rqt = db::select('select * from stagiaires where id = ?',[$id]);
        // $stagiaire = $rqt[0];
        return view('admin.participant.edit_nom', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_naissance($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_naissance', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_genre($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        // dd($branche);
        return view('admin.participant.edit_genre', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_mail($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_mail', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_phone($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_phone', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_cin($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_cin', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_adresse($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_adresse', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_fonction($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_fonction', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_matricule($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_matricule', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_entreprise($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;


        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        // return view('admin.participant.edit_entreprise', compact('stagiaire','service','departement','branche'));
        return view('admin.participant.edit_entreprise', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_niveau($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;

        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        // return view('admin.participant.edit_niveau', compact('stagiaire','service','departement','branche'));
        $niveau_etude = $fonct->findAll('niveau_etude');
        return view('admin.participant.edit_niveau', compact('stagiaire', 'service', 'branche','niveau_etude'));
    }
    public function edit_departement($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $liste_dep = $fonct->findWhere("departement_entreprises", ["entreprise_id"], [$stagiaire->entreprise_id]);

        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_departement', compact('stagiaire', 'liste_dep', 'branche', 'service'));
    }
    public function edit_branche($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;

        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        $liste_branche = $fonct->findWhere("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_branche', compact('liste_branche', 'stagiaire', 'service', 'branche'));
    }
    public function edit_photos($id, Request $request)
    {

        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_photos', compact('stagiaire', 'service', 'branche'));
    }
    public function edit_pwd($id, Request $request)
    {

        $fonct = new FonctionGenerique();
        $stagiaire = $fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
        $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
        // $departement = $fonct->findWhereMulitOne("departement_entreprises",["id"],[$service->departement_entreprise_id]);
        $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
        return view('admin.participant.edit_pwd', compact('stagiaire', 'service', 'branche'));
    }
    public function update(Request $request)
    {
        $participant = new stagiaire();
        $id = $request->id_get;
        $input = $request->image;
        //storage photos dans drive
        $dossier = 'stagiaire';
        $stock_stg = new getImageModel();
        $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());
        if ($image = $request->file('image')) {
            $destinationPath = 'image/stagiaires';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input = "$profileImage";
        }

        // stagiaire::where('id', $id)->update([']);
        // $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();
        stagiaire::where('id', $id)->update([
            'matricule' => $request->matricule,
            'nom_stagiaire' => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'date_naissance' => $request->date,
            'branche_id' => $request->lieu_travail,
            'genre_stagiaire' => $request->genre,
            'fonction_stagiaire' => $request->fonction,
            'telephone_stagiaire' => $request->phone,
            'mail_stagiaire' => $request->mail,
            'photos' => $input,
            'cin' => $request->cin,
            'titre' => $request->titre,
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'code_postal' => $request->code_postal,
            'lot' => $request->lot,
            'region' => $request->region,

        ]);
        return back();
    }
    public function destroy(Request $request)
    {
        $id = request()->id;
        //on récupère le matricule , l'activité,entreprise id, du stagiaire
        $resultat = DB::select('SELECT matricule,entreprise_id,departement_id,activiter FROM stagiaires WHERE id = ' . $id);
        $matricule = $resultat[0]->matricule;
        $entreprise_id = $resultat[0]->entreprise_id;
        $departement_id = $resultat[0]->departement_id;
        $activite = $resultat[0]->activiter;
        if ($activite == 1) {
            $date_depart = $dt = Carbon::today()->toDateString();
            //on insère dans l'historique stagiaire l'entreprise id, le matricule et le stagiaire id
            DB::insert('INSERT INTO historique_stagiaires
                        (`stagiaire_id`, `ancien_entreprise_id`,`ancien_departement_id` ,`nouveau_entreprise_id`,`nouveau_departement_id`, `ancien_matricule`, `nouveau_matricule`, `date_depart`, `date_arrivee`,`particulier`)
                        Values (?,?,?,?,?,?,?,?,?,?)', [$id, $entreprise_id, $departement_id, 0, 0, $matricule, 0, $date_depart, 0, 0]);

            //on modifie l'entreprise id du stagiaire par 0
            DB::update('update stagiaires set activiter = 0  where id = ' . $id);
        }
        if ($activite == 0) {
            $date_depart = $dt = Carbon::today()->toDateString();
            //on insère dans l'historique stagiaire l'entreprise id, le matricule et le stagiaire id
            DB::insert('INSERT INTO historique_stagiaires
                        (`stagiaire_id`, `ancien_entreprise_id`,`ancien_departement_id` ,`nouveau_entreprise_id`,`nouveau_departement_id`, `ancien_matricule`, `nouveau_matricule`, `date_depart`, `date_arrivee`)
                        Values (?,?,?,?,?,?,?,?,?)', [$id, $entreprise_id, $departement_id, $entreprise_id, $departement_id, $matricule, $matricule, $date_depart, $date_depart]);

            //on modifie l'entreprise id du stagiaire par 0
            DB::update('update stagiaires set activiter = 1 where id = ' . $id);
        }

        // $stag = stagiaire::findOrFail($id);
        // $user_id = stagiaire::where('id', $id)->value('user_id');
        // $del_stagiaire = stagiaire::where('id', $id)->delete();
        // $del_user = User::where('id', $user_id)->delete();
        // File::delete("images/stagiaires/".$stag->photos);
        return back();
    }

    public function getStagiaires(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->where('matricule', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->matricule);
        }
        return response()->json($response);
    }

    public function getStagiairesFonction(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $stagiaires = stagiaire::orderby('fonction_stagiaire', 'asc')->select('id', 'fonction_stagiaire')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('fonction_stagiaire', 'asc')->select('id', 'fonction_stagiaire')->where('fonction_stagiaire', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->fonction_stagiaire);
        }
        return response()->json($response);
    }

    public function getStagiairesCIN(Request $request)
    {
        $search = $request->search;
        $etp_id = responsable::where('id', Auth::id())->value('entreprise_id');

        if ($search == '') {
            $stagiaires = stagiaire::orderby('nom_stagiaire', 'asc')->select('id', 'cin')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('nom_stagiaire', 'asc')->select('id', 'cin')->where([['entreprise_id', '!=', $etp_id], ['cin', 'like', $search . '%']])->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->cin);
        }
        return response()->json($response);
    }

    public function recherche(Request $request)
    {
        $matricule = $request->matricule;
        if ($matricule == '') {
            $datas = stagiaire::get();
        } else {
            $datas = stagiaire::where('matricule', $matricule)->get();
        }
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    }

    //recherche par CIN

    public function rechercheCIN(Request $request)
    {
        $cin = $request->cin;
        $id = stagiaire::where('cin', $cin)->value('id');
        if ($id == null) {
            $datas["exist"] = 0;
            $datas["msg"] = "Verifier le CIN";
            return response()->json($datas);
        }
        $etp_id = stagiaire::where('cin', $cin)->value('entreprise_id');
        $etp_id_referent = responsable::where('user_id', Auth::id())->value('entreprise_id');

        if ($etp_id != $etp_id_referent) {
            $stg = db::select('select * from historique_stagiaires where stagiaire_id =' . $id);
            if ($stg != null) {
                if ($stg[0]->nouveau_entreprise_id == $etp_id_referent) {
                    $datas["exist"] = 0;
                    $datas["msg"] = "Cette personne est déjà dans votre entreprise";
                    return response()->json($datas);
                } else {
                    $stg_particulier = $stg[0]->particulier;
                    $datas["stg"] = stagiaire::where('cin', $cin)->get();
                    $datas["exist"] = 1;
                    return response()->json($datas);
                }
            }
            if ($stg == null) {
                $datas["exist"] = 0;
                $datas["msg"] = "Aucun résultat";
                return response()->json($datas);
            }
            // return response()->json($datas);

        } else {
            $datas["exist"] = 0;
            $datas["msg"] = "Cette personne est déjà dans votre entreprise";
            return response()->json($datas);
        }
    }
    // public function rechercheCIN(Request $request){
    //     $cin = $request->cin;
    //     $id = stagiaire::where('cin',$cin)->value('id');

    //     $etp_id = stagiaire::where('cin',$cin)->value('entreprise_id');

    //     $etp_id_referent = responsable::where('user_id',Auth::id())->value('entreprise_id');
    //     $liste_etp = entreprise::orderBy('nom_etp')->get();
    //     $info_impression = [
    //         'id' => null,
    //         'nom_entreprise' => 'Tout'
    //     ];
    //     if ($cin == '') {
    //         $datas = stagiaire::get();
    //         return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    //     } else {
    //         if ($etp_id != $etp_id_referent) {
    //             $existe = db::select('select * from historique_stagiaires where stagiaire_id ='.$id);
    //             if($existe == null ) return redirect()->route('liste_participant');
    //             else{
    //                 $stg = db::select('select particulier from historique_stagiaires where stagiaire_id ='.$id);
    //                 $stg_particulier = $stg[0]->particulier;
    //                 $datas = stagiaire::where('cin', $cin)->get();
    //                 return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression','stg_particulier','etp_id_referent'));
    //             }

    //         }
    //         else{
    //             $datas = stagiaire::where('cin', $cin)->get();
    //             return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    //         }

    //     }

    //  }
    //ajout stagiaire dans une nouvelle entreprise
    public function nouvelle_entreprise_stagiaire(Request $request)
    {
        //on récupère l'id entreprise du référent connecté
        $etp_id = responsable::where('user_id', Auth::id())->value('entreprise_id');
        $id = $request->stg;
        $matricule = $request->matricule;
        $email_nouveau = $request->mail_prof;
        //on met à jour le nouveau entreprise du stagiaire dans historique et remplacer la valeur particulier par 0
        db::update('update historique_stagiaires set nouveau_entreprise_id = ?, nouveau_matricule = ? , particulier = ?', [$etp_id, $matricule, 0]);
        db::update('update stagiaires set entreprise_id = ?, matricule = ? ,mail_stagiaire = ? ,activiter = ? where id = ?', [$etp_id, $matricule, $email_nouveau, 1, $id]);
        return redirect()->route('liste_participant');
    }
    public function rechercheFonction(Request $request)
    {
        $fonction = $request->fonction;
        if ($fonction == '') {
            $datas = stagiaire::get();
        } else {
            $datas = stagiaire::where('fonction_stagiaire', $fonction)->get();
        }
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    }
    /*
        ====================  Generate PDF Liste des stagiaire par Entreprise
    */
    public function generatePDF($id = null)
    {
        $entreprise = new entreprise();
        $stagiaire = new stagiaire();

        $nom_entr = null;

        if ($id == null) {
            $entreprises = $entreprise->orderBy('nom_etp')->get();
            $stagiaires = $stagiaire->orderBy('nom_stagiaire')->with('entreprise', 'User')->get();

            $info_impression = [
                'id' => null,
                'nom_entreprise' => 'Tout'
            ];
        } else {
            $entreprises = $entreprise->orderBy('nom_etp')->where('id', $id)->get();
            $stagiaires = $stagiaire->orderBy('nom_stagiaire')->where('entreprise_id', $id)->get();
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

        $pdf = PDF::loadView('admin.pdf.pdf_stagiaire', compact('entreprises', 'stagiaires'));

        if ($id != null) {
            return $pdf->download('liste des stagiaires de ' . $nom_entr . '.pdf');
        } else {
            return $pdf->download('gestion des stagiaires.pdf');
        }
    }
    public function export()
    {
        return Excel::download(new ParticipantExport, 'gestion des stagiaires.xlsx');
    }
    public function profile_stagiaire($id = null)
    {
        $user_id =  $users = Auth::user()->id;
        //   $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
        $fonct = new FonctionGenerique();
        $genre = null;
        if (Gate::allows('isStagiaire')) {

            $matricule = stagiaire::where('user_id', $user_id)->value('matricule');
            $stagiaire = $fonct->findWhereMulitOne("v_stagiaire_entreprise", ["matricule"], [$matricule]);
            $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
            $entreprise = $fonct->findWhereMulitOne("entreprises", ["id"], [$stagiaire->entreprise_id]);
            if ($service == null) {
                $departement = [];
            } else {
                $departement = $fonct->findWhereMulitOne("departement_entreprises", ["id"], [$service->departement_entreprise_id]);
            }
            $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);

            if ($stagiaire->genre_stagiaire == 1) {
                $genre = 'Femme';
            }
            if ($stagiaire->genre_stagiaire == 2) {
                $genre = 'Homme';
            }
            if ($stagiaire->genre_stagiaire == null) {
                $genre = '';
            }
            return view('admin.participant.profile', compact('entreprise', 'stagiaire', 'service', 'departement', 'branche', 'genre'));
            // $stagiaires = db::select('select * from stagiaires where matricule = ?',[$matricule]);
            // $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();

        } else {
            $stagiaires_tmp = DB::select('SELECT * FROM stagiaires where id = ?', [$id]);

            $stagiaire = $stagiaires_tmp[0];
            $initial_stagiaire = DB::select('select SUBSTRING(nom_stagiaire, 1, 1) AS nm,  SUBSTRING(prenom_stagiaire, 1, 1) AS pr from stagiaires where id =  ?', [$id]);

            if ($stagiaire->service_id == null) {
                $service = "---------------";
                $departement = "---------------";
            } else {
                $service = $fonct->findWhereMulitOne("services", ["id"], [$stagiaire->service_id]);
                $departement = $fonct->findWhereMulitOne("departement_entreprises", ["id"], [$service->departement_entreprise_id]);
            }

            if($stagiaire->niveau_etude_id == null){
                $niveau = "---------------";
            }
            else{
                $niveau = $fonct->findWhereMulitOne("niveau_etude", ["id"], [$stagiaire->niveau_etude_id]);
            }
            $entreprise = $fonct->findWhereMulitOne("entreprises", ["id"], [$stagiaire->entreprise_id]);
            $branche = $fonct->findWhereMulitOne("branches", ["entreprise_id"], [$stagiaire->entreprise_id]);
            if ($stagiaire->genre_stagiaire == 1) {
                $genre = 'Femme';
            }
            if ($stagiaire->genre_stagiaire == 2) {
                $genre = 'Homme';
            }
            return view('profil_public.stagiaire', compact('niveau','initial_stagiaire','entreprise', 'stagiaire', 'service', 'departement', 'branche','genre'));
        }
        // $stagiaire=stagiaire::findOrFail($id);
        // if(Gate::allows('isStagiaire') || (Gate::allows('isSuperAdmin') || (Gate::allows('isManager'))))
        // {
        //     return view('admin.participant.profiles', compact('stagiaires'));

        // }
        // else
        // {
        // $requete = db::select('select * from v_stagiaire_entreprise where stagiaire_id = ?', [$id]);
        // $stagiaire = $requete[0];

        // return view('admin.participant.profile', compact('stagiaire'));

        // }
    }
    //update_stagiaire connecte
    public function update_mot_de_passe_stagiaire(Request $request,$id){
        if($request->ancien_password == null){
            return back()->with('error_ancien_pwd','Entrez votre ancien mot de passe');
        }
        elseif($request->new_password == null){
            return back()->with('error_new_pwd','Entrez votre nouveau mot de passe avant de cliquer sur enregistrer');
        }
        else{
            $users =  db::select('select * from users where id = ?', [Auth::id()]);
            $pwd = $users[0]->password;
            $new_password = Hash::make($request->new_password);
            if (Hash::check($request->get('ancien_password'), $pwd)) {
                DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
                return redirect()->route('profile_stagiaire');
            } else {
                return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
            }
        }
    }
    public function update_niveau_stagiaire(Request $request,$id){
        $niveau = $request->niveau;
        DB::update('update stagiaires set niveau_etude_id = ? where id = ?', [$niveau, $id]);
        return redirect()->route('profile_stagiaire');
    }
    public function update_email_stagiaire(Request $request,$id){
        if ($request->mail == null) {
            return back()->with('error_email','Entrez votre adresse e-mail avant de cliquer sur enregistrer');
        }
        else{
            DB::update('update users set email = ? where id = ?', [$request->mail, Auth::id()]);
            DB::update('update stagiaires set mail_stagiaire = ? where user_id = ?', [$request->mail, Auth::id()]);
            return redirect()->route('profile_stagiaire');
        }
    }
    public function update_stagiaire(Request $request, $id)
    {
        if($request->nom == null){
            return back()->with('error_nom','Entrez votre nom avant de cliquer sur enregistrer');
        }
        elseif($request->prenom == null){
            return back()->with('error_prenom','Entrez votre prénom avant de cliquer sur enregistrer');
        }
        elseif($request->phone == null){
            return back()->with('error_phone','Entrez votre numéro de téléphone avant de cliquer sur enregistrer');
        }
        elseif($request->cin == null){
            return back()->with('error_cin','Entrez votre CIN avant de cliquer sur enregistrer');
        }
        elseif($request->fonction == null){
            return back()->with('error_fonction','Entrez votre fonction avant de cliquer sur enregistrer');
        }
        else{
            $user_id = Auth::user()->id;
            $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();

            $input = $request->image;
            if ($image = $request->file('image')) {
                $destinationPath = 'images/stagiaires';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input = "$profileImage";
            }

            if ($input != null) {
                $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();
                stagiaire::where('id', $id)->update([

                    'matricule' => $request->matricule,
                    'nom_stagiaire' => $request->nom,
                    'prenom_stagiaire' => $request->prenom,
                    'date_naissance' => $request->date,
                    'genre_stagiaire' => $request->genre,
                    'fonction_stagiaire' => $request->fonction,
                    'telephone_stagiaire' => $request->phone,
                    'mail_stagiaire' => $request->mail,
                    'photos' => $input,
                    'branche_id' => $request->lieu_travail,
                    'cin' => $request->cin,
                    'niveau_etude' => $request->niveau,
                    'titre' => $request->titre,
                    'ville' => $request->ville,
                    'quartier' => $request->quartier,
                    'code_postal' => $request->code_postal,
                    'lot' => $request->lot,
                    'region' => $request->region,

                ]);

                // Departement::where('id',$id)->update([
                //     'nom_departement'=>$request->departement
                // ]);
                entreprise::where('id', $id)->update([
                    'nom_etp' => $request->entreprise
                ]);
            } else {
                stagiaire::where('id', $id)->update([
                    'matricule' => $request->matricule,
                    'nom_stagiaire' => $request->nom,
                    'prenom_stagiaire' => $request->prenom,
                    'date_naissance' => $request->date,
                    'genre_stagiaire' => $request->genre,
                    'fonction_stagiaire' => $request->fonction,
                    'telephone_stagiaire' => $request->phone,
                    'mail_stagiaire' => $request->mail,
                    'branche_id' => $request->lieu_travail,
                    'cin' => $request->cin,
                    'niveau_etude_id' => $request->niveau,
                    'titre' => $request->titre,
                    'ville' => $request->ville,
                    'quartier' => $request->quartier,
                    'code_postal' => $request->code_postal,
                    'lot' => $request->lot,
                    'region' => $request->region,


                ]);
                // Departement::where('id',$id)->update([
                //     'nom_departement'=>$request->departement
                // ]);
                // entreprise::where('id',$id)->update([
                //     'nom_etp'=>$request->entreprise
                // ]);
            }
            // $password = $request->password;
            // $nom = $request->nom;
            // $mail = $request->mail;
            // $hashedPwd = Hash::make($password);
            // // $user = User::where('id', Auth::user()->id)->update([
            // //     'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
            // // ]);
            DB::update('update users set telephone = ? where id = ?', [$request->phone, Auth::id()]);
            DB::update('update users set cin = ? where id = ?', [$request->cin, Auth::id()]);
            return redirect()->route('profile_stagiaire', $id);
        }
    }
    public function update_photo_stagiaire($id, Request $request)
    {
        $image = $request->file('image');
        //tableau contenant les types d'extension d'images
        $extension_type = array('jpeg', 'jpg', 'png', 'gif', 'psd', 'ai', 'svg');
        if ($image != null) {
            if ($image->getSize() > 1692728 or $image->getSize() == false) {
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 1.7 MB');
            } elseif (in_array($request->image->extension(), $extension_type)) {

                $stagiaire = $this->fonct->findWhereMulitOne("stagiaires", ["id"], [$id]);
                $image_ancien = $stagiaire->photos;
                //supprimer l'ancienne image
                File::delete(public_path("images/stagiaires/" . $image_ancien));
                //enregiistrer la nouvelle photo

                $nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.' . $request->image->extension());
                $destinationPath = 'images/stagiaires';
                //imager  resize
                $image_name = $nom_image;
                $destinationPath = public_path('images/stagiaires');
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(228, 128, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' .  $image_name);
                // $image->move($destinationPath, $nom_image);
                $url_photo = URL::to('/') . "/images/stagiaires/" . $nom_image;

                DB::update('update stagiaires set photos= ?,url_photo = ? where id = ?', [$nom_image, $url_photo, $id]);
                return redirect()->route('profile_stagiaire');
            } else {
                return redirect()->back()->with('error_format', 'Le format de votre fichier n\'est pas acceptable,choisissez entre : .jpeg,.jpg,.png,.gif,.psd,.ai,.svg');
            }
        } else {
            return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
        }
    }
    public function last_record()
    {
        $last_record_historique = DB::select(' SELECT *
        FROM (
          SELECT *
          FROM stagiaires
          ORDER BY id DESC
          LIMIT 1
        ) tmp
        ORDER BY id ASC
        LIMIT 1');
        dd($last_record_historique);
    }
    //fonction récupération photos depuis google drive
    public function getImage($path)
    {
        $dossier = 'stagiaire';
        $etp = new getImageModel();
        return $etp->get_image($path, $dossier);
    }

    // ============== export excel new participant

    public function teste()
    {
        $fonct = new FonctionGenerique();
        $liste_dep = $fonct->findAll("departement_entreprises");
        // return view("admin.entreprise.employer.export_nouveau_employer", compact('liste_dep'));
        return view("admin.participant.export_excel_nouveau_participant", compact('liste_dep'));
    }

    public function export_excel_new_participant()
    {
        $user_id = Auth::user()->id;

        $fonct = new FonctionGenerique();
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $liste_dep = $fonct->findWhere("departement_entreprises", ["entreprise_id"], [$entreprise_id]);
            return view("admin.entreprise.employer.export_nouveau_employer", compact('liste_dep'));
            // return view("admin.participant.export_excel_nouveau_participant", compact('liste_dep'));

        }

        if (Gate::allows('isManager')) {
            $chef_id = $fonct->findWhereMulitOne("chef_departements", ["user_id"], [$user_id])->id;
            $dep_etp_id = $fonct->findWhereMulitOne("chef_dep_entreprises", ["chef_departement_id"], [$chef_id])->departement_entreprise_id;
            $liste_dep = $fonct->findWhere("v_departement", ["departement_id"], [$dep_etp_id]);
            // return view("admin.participant.export_excel_nouveau_participant", compact('liste_dep'));

            return view('admin.entreprise.employer.export_nouveau_employer', compact('liste_dep'));
        }
        return view("admin.participant.export_excel_nouveau_participant", compact('liste_dep'));
    }

    public function save_multi_stagiaire(Request $req)
    {
        $user_id = Auth::user()->id;
        $stg = new stagiaire();
        $fonct = new FonctionGenerique();
        $totale_valide = 0;
        for ($i = 1; $i <= 30; $i += 1) {

            $doner["matricule"] = $req["matricule_" . $i];
            $doner["nom"]  = $req["nom_" . $i];
            $doner["prenom"]  = $req["prenom_" . $i];
            $doner["cin"]  = $req["cin_" . $i];
            $doner["email"]  = $req["email_" . $i];
            $doner["tel"]  = $req["tel_" . $i];
            if ($req["matricule_" . $i] != null && $req["nom_" . $i] != null) {
                if (
                    $req["cin_" . $i] != null
                    && $req["email_" . $i] != null
                ) {
                    $totale_valide += 1;
                    $verify = $fonct->findWhere("stagiaires", ["mail_stagiaire"], [$req["email_" . $i]]);

                    if (count($verify) <= 0) {

                        $user = new User();
                        $user->name = $req["nom_" . $i];
                        $user->email = $req["email_" . $i];
                        $user->cin = $req["cin_" . $i];
                        $ch1 = "0000";
                        $user->password = Hash::make($ch1);
                        $user->save();
                        $user_stg_id = $fonct->findWhereMulitOne("users", ["email"], [$req["email_" . $i]])->id;
                        $fonct->insert_role_user($user_stg_id, 3, True);
                        if (Gate::allows('isReferent')) {
                            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
                            $etp = $fonct->findWhereMulitOne("entreprises", ["id"], [$entreprise_id]);

                            $stg->insert_multi($doner, $user_stg_id, $entreprise_id);

                            Mail::to($doner['email'])->send(new save_new_compte_stagiaire_Mail($doner["nom"] . ' ' . $doner["prenom"], $doner['email'], $etp->nom_etp));
                        }
                    } else {
                        return back()->with('error', "erreur,l'une des données existes déjà!");
                    }
                } else {
                    return back()->with('error', "l'une des champs sont est invalid!");
                }
            } else {
                return back()->with('error', "matricule ou autre champs vide");
            }
        }

        return back()->with('success', "" + $totale_valide + " desc nouveaux employés sont terminés avec succès!");
    }

    public function verify_matricule_stg(Request $req)
    {
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhere("stagiaires", ["matricule"], [$req->valiny]);
        return response()->json($data);
    }

    public function verify_email_stg(Request $req)
    {
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhere("stagiaires", ["mail_stagiaire"], [$req->valiny]);
        return response()->json($data);
    }

    public function verify_cin_stg(Request $req)
    {
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhere("stagiaires", ["cin"], [$req->valiny]);
        return response()->json($data);
    }
}

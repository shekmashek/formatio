<?php

namespace App\Http\Controllers;

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

/* ====================== Exportation Excel ============= */
use App\Exports\ParticipantExport;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
            $liste_dep = db::select('select * from departement_entreprises where entreprise_id = ? ',[$entreprise_id]);
            // $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->get();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'email_error', 'matricule_error'));
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
            $entreprise_id = responsable::where('user_id', [$user_id])->value('entreprise_id');
            $datas = DB::select('SELECT * from v_stagiaire_entreprise WHERE entreprise_id = ' . $entreprise_id);
            $ancien = DB::select('select * from v_historique_stagiaires where ancien_entreprise_id =' . $entreprise_id);
            // $datas = stagiaire::with('entreprise', 'User')->where('entreprise_id',[$entreprise_id])->get();
        }
        if (Gate::allows('isManager')) {
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
        $request->validate(
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
            $participant->lieu_travail = $request->lieu;
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

            $date = date('d-m-Y');
            $nom_image = str_replace(' ', '_', $request->nom . '' . $request->phone . '' . $date . '.' . $request->image->extension());

            $str = 'images/stagiaires';

            //stocker logo dans google drive
            //stocker logo dans google drive
            $dossier = 'stagiaire';
            $stock_stg = new getImageModel();
            $stock_stg->store_image($dossier, $nom_image, $request->file('image')->getContent());

            $participant->photos = $nom_image;

            //enregistrer les emails , name et mot de passe dans user
            $user = new User();
            $user->name = $request->nom. " " . $request->prenom;
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
            $participant->departement_id = $request->liste_dep;
            $participant->CIN = $request->cin;
            $participant->date_naissance = $request->naissance;
            $participant->niveau_etude = $request->niveau;
            $participant->entreprise_id = $entreprise_id;
            $participant->save();
            // $request->image->move(public_path($str), $nom_image);

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
            if(Gate::allows('isReferent') || (Gate::allows('isSuperAdmin') || (Gate::allows('isManager'))))
            {
                return view('admin.participant.updates', compact('stagiaire'));
            }
            else{
            return view('admin.participant.update', compact('stagiaire'));

            }
        } else {


            $participant = stagiaire::where('id', $id)->get();

            return response()->json($participant);
        }
    }

    public function update(Request $request)
    {
        $participant = new stagiaire();
        $id = $request->id_get;

        $input = $request->image;

        if ($image = $request->file('image')) {
            $destinationPath = 'image/stagiaires';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input= "$profileImage";
        }

        // stagiaire::where('id', $id)->update([']);
        $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();
        stagiaire::where('id', $id)->update([
            'matricule' => $request->matricule,
            'nom_stagiaire' => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'date_naissance' => $request->date,
            'lieu_travail' => $request->lieu,
            'genre_stagiaire' => $request->genre,
            'fonction_stagiaire' => $request->fonction,
            'telephone_stagiaire' => $request->phone,
            'mail_stagiaire' => $request->mail,
            'photos'=>$input,
            'cin' => $request->cin,
            'niveau_etude' => $request->niveau,
            'titre'=>$request->titre,
            'ville'=>$request->ville,
            'quartier'=>$request->quartier,
            'code_postal'=>$request->code_postal,
            'lot'=>$request->lot,

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
        $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
        if ($stagiaire_connecte) {
            $matricule = stagiaire::where('user_id', $user_id)->value('matricule');
            $stagiaires = db::select('select * from v_stagiaire_entreprises where matricule = ?',[$matricule]);
            // $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();

        } else {
            $stagiaires = stagiaire::with('entreprise', 'Departement')->where('id', $id)->get();
        }
        // $stagiaire=stagiaire::findOrFail($id);
        return view('admin.participant.profile', compact('stagiaires'));
    }
    //update_stagiaire connecte
    public function update_stagiaire(Request $request, $id)
    {
        $user_id =  $users = Auth::user()->id;
        $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
        // $date = date('d-m-Y');
        // $participant = new stagiaire();
        // $nom_image = str_replace(' ', '_', $request->nom . '' . $request->phone . '' . $date . '.' . $request->image->extension());
        //  $str = 'images/stagiaires';
          //stocker logo dans google drive
            //stocker logo dans google drive
        //     $dossier = 'stagiaire';
        //     $stock_stg = new getImageModel();
        //     $stock_stg->store_image($dossier, $nom_image, $request->file('image')->getContent());
        //     $participant->photos = $nom_image;
        $input = $request->image;
        if ($image = $request->file('image')) {
            $destinationPath = 'image/stagiaires';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input= "$profileImage";
        }
        if ($input !=null){
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
            'photos'=>$input,
            'lieu_travail' => $request->lieu,
            'cin' => $request->cin,
            'niveau_etude' => $request->niveau,
            'titre'=>$request->titre,
            'ville'=>$request->ville,
            'quartier'=>$request->quartier,
            'code_postal'=>$request->code_postal,
            'lot'=>$request->lot,

        ]);
        }
        else{
        stagiaire::where('id', $id)->update([
            'matricule' => $request->matricule,
            'nom_stagiaire' => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'date_naissance' => $request->date,
            'genre_stagiaire' => $request->genre,
            'fonction_stagiaire' => $request->fonction,
            'telephone_stagiaire' => $request->phone,
            'mail_stagiaire' => $request->mail,
            'lieu_travail' => $request->lieu,
            'cin' => $request->cin,
            'niveau_etude' => $request->niveau,
            'titre'=>$request->titre,
            'ville'=>$request->ville,
            'quartier'=>$request->quartier,
            'code_postal'=>$request->code_postal,
            'lot'=>$request->lot,

        ]);
    }
        $password = $request->password;
        $nom = $request->nom;
        $mail = $request->mail;
        $hashedPwd = Hash::make($password);
        $user = User::where('id', Auth::user()->id)->update([
            'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        ]);
        return redirect()->route('profile_stagiaire', $id);
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

    public function export_excel_new_participant()
    {
        $user_id = Auth::user()->id;

        $fonct = new FonctionGenerique();
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $liste_dep = $fonct->findWhere("departement_entreprises", ["entreprise_id"], [$entreprise_id]);

            return view('admin.participant.export_excel_nouveau_participant', compact('liste_dep'));
        }

        if (Gate::allows('isManager')) {
            $chef_id = $fonct->findWhereMulitOne("chef_departements", ["user_id"], [$user_id])->id;
            $dep_etp_id = $fonct->findWhereMulitOne("chef_dep_entreprises", ["chef_departement_id"], [$chef_id])->departement_entreprise_id;
            $liste_dep = $fonct->findWhere("v_departement", ["departement_id"], [$dep_etp_id]);

            return view('admin.participant.export_excel_nouveau_participant', compact('liste_dep'));
        }

        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {
            $liste_dep = $fonct->findAll("departements");
            $liste_etp = $fonct->findAll("entreprises");

            return view('admin.participant.export_excel_nouveau_participant', compact('liste_dep', 'liste_etp'));
        }
    }

    public function save_multi_stagiaire(Request $req)
    {
        $user_id = Auth::user()->id;
        $stg = new stagiaire();
        $fonct = new FonctionGenerique();

        for ($i = 1; $i <= 30; $i += 1) {

            $doner["matricule"] = $req["matricule_" . $i];
            $doner["nom"]  = $req["nom_" . $i];
            $doner["prenom"]  = $req["prenom_" . $i];
            $doner["sexe"]  = $req["sexe_" . $i];
            $doner["dte"]  = $req["naissance_" . $i];
            $doner["cin"]  = $req["cin_" . $i];
            $doner["email"]  = $req["email_" . $i];
            $doner["tel"]  = $req["tel_" . $i];
            $doner["fonction"]  = $req["fonction_" . $i];
            $doner["departement_id"]  = $req["departement_id"];

            if ($req["matricule_" . $i] != null && $req["nom_" . $i] != null) {
                if (
                    $req["prenom_" . $i] != null && $req["sexe_" . $i] != null && $req["naissance_" . $i] != null && $req["cin_" . $i] != null
                    && $req["email_" . $i] != null && $req["tel_" . $i] != null && $req["fonction_" . $i] != null
                ) {

                    $verify = $fonct->findWhere("stagiaires", ["mail_stagiaire"], [$req["email_" . $i]]);

                    if (count($verify) <= 0) {

                        $user = new User();
                        $user->name = $req["nom_" . $i];
                        $user->email = $req["email_" . $i];
                        $ch1 = "0000";
                        $user->password = Hash::make($ch1);
                        $user->role_id = '3';
                        $user->save();

                        $user_stg_id = User::where('email', $req["email_" . $i])->value('id');

                        if (Gate::allows('isReferent')) {
                            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
                            $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$entreprise_id]);

                            $stg->insert_multi($doner, $user_stg_id, $entreprise_id);

                            Mail::to($doner['email'])->send(new save_new_compte_stagiaire_Mail($doner["nom"].' '.$doner["prenom"],$doner['email'],$etp->nom_etp));

                            return back()->with('success', "terminé!");
                        }
                    } else {
                        return back()->with('error', "erreur,l'une des données existes déjà!");
                    }
                } else {
                    return back()->with('error', "l'une des champs sont invalid!");
                }
            } else {
                return back()->with('error', "champs vide");
            }
        }


    }
}

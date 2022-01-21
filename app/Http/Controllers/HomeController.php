<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\detail;
use App\entreprise;
use App\formation;
use App\module;
use App\projet;
use App\responsable;
use App\stagiaire;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Models\FonctionGenerique;
use App\cfp;
use App\chefDepartement;
use App\formateur;
use App\Collaboration;

use function Ramsey\Uuid\v1;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->collaboration = new Collaboration();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });

    }


    public function index(Request $request)
    {
        if (Auth::user()->exists) {
            $totale_invitation = $this->collaboration->count_invitation();
            return view('layouts.accueil_admin', compact('totale_invitation'));
        }

    }

    public function liste_projet(Request $request, $id = null)
    {
        $fonct = new FonctionGenerique();

        $user_id = Auth::user()->id;
        $totale_invitation = $this->collaboration->count_invitation();


        //récupérer id de l'utilisateur en fonction de l'email
        $role_id = User::where('email', Auth::user()->email)->value('role_id');

        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {

            //on récupère tous les projets de formation
            $projet = projet::get()->unique('nom_projet');
            $data = $fonct->findAll("v_projetentreprise");
            $cfp = $fonct->findAll("cfps");
            $entreprise = entreprise::all();
            return view('admin.projet.home', compact('data', 'cfp', 'projet', 'totale_invitation', 'entreprise'));
        }
        if (Gate::allows('isReferent')) {
            //on récupère l'entreprise id de la personne connecté

            // $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            // $data = $fonct->findWhere("v_projetentreprise", ["entreprise_id"], [$entreprise_id]);
            // $cfp = $fonct->findAll("cfps");
            // return view('admin.projet.home', compact('data', 'cfp', 'totale_invitation'));
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $data = $fonct->findWhere("v_projetentreprise", ["entreprise_id"], [$entreprise_id]);
            $infos = DB::select('select * from where entreprise_id = ?',[$entreprise_id]);
            $stagiaires = DB::select('select * from v_participant_groupe where entreprise_id = ?',[$entreprise_id]);
            return view('projet_session.index2',compact('data','infos','stagiaires'));
        }
        if (Gate::allows('isManager')) {
            //on récupère l'entreprise id de la personne connecté

            $entreprise_id = chefDepartement::where('user_id', $user_id)->value('entreprise_id');
            $data = $fonct->findWhere("v_projetentreprise", ["entreprise_id"], [$entreprise_id]);
            $cfp = $fonct->findAll("cfps");
            return view('admin.projet.home', compact('data', 'cfp', 'totale_invitation'));
        }
        elseif (Gate::allows('isStagiaire')) {
            return view('layouts.accueil_admin');
        } elseif (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');

            $data = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id"], [$cfp_id]);

            $entreprise = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            return view('projet_session.index2', compact('data', 'entreprise', 'totale_invitation'));
        }
    }

    public function compte(Request $request)
    {
        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.compte', compact('totale_invitation'));
    }
    public function detail($id)
    {
        $totale_invitation = $this->collaboration->count_invitation();
        $id_module =detail::where('id', $id)->value('module_id');
        $nom_module = module::where('id', $id_module)->value('nom_module');
        $id_formation = module::where('id', $id_module)->value('formation_id');
        $nom_formation = formation::where('id', $id_formation)->value('nom_formation');
        //récupérer id du projet en fonction de l'id du détail
        $id_projet = detail::where('id', $id)->value('projet_id');
        //récupérer nom du projet en fonction de l'id projet
        $nom_projet =projet::where('id', $id_projet)->value('nom_projet');

        $datas = DB::table('executions')
            ->join('details', 'details.id', '=', 'executions.detail_id')
            ->join('stagiaires', 'stagiaires.id', '=', 'executions.stagiaire_id')

            ->select(
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',
                'executions.qualite_formation',
                'executions.evaluation_formation',
                'executions.note',
                'stagiaires.id',

            )
            ->where('details.id', $id)
            ->get();
        return view('suivi.liste', compact('nom_module', 'nom_formation', 'datas', 'nom_projet', 'totale_invitation'));
    }
    public function profil($id)
    {
        //récupérer les informations personnelles du stagiaire
        $my_data = DB::table('stagiaires')
            ->select(
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',

            )
            ->where('stagiaires.id', $id)
            ->get();
        //recupérer le détail des formations que le/le stagiaire a suivi
        $datas = DB::table('executions')
            ->join('details', 'details.id', '=', 'executions.detail_id')
            ->join('entreprises', 'entreprises.id', '=', 'details.entreprise_id')
            ->join('stagiaires', 'stagiaires.id', '=', 'executions.stagiaire_id')
            ->join('modules', 'modules.id', '=', 'details.module_id')
            ->join('formations', 'formations.id', '=', 'modules.formation_id')
            ->select(
                'modules.nom_module',
                'formations.nom_formation',
                'details.lieu',
                'details.date_debut',
                'details.date_fin',
                'executions.evaluation_formation',
                'executions.qualite_formation',
                'executions.note',
                'details.id'
            )
            ->where('executions.stagiaire_id', $id)
            ->distinct()
            ->get();

        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.profil', compact('datas', 'my_data', 'totale_invitation'));
    }
    public function liste()
    {
        //récupérer id de l'utilisateur en fonction de l'email
        $user_id = User::where('email', Auth::user()->email)->value('id');
        //récupérer id responsable
        $id_resp = responsable::where('user_id', $user_id)->value('id');
        $datas = DB::table('stagiaires')
            ->join('entreprises', 'entreprises.id', '=', 'stagiaires.entreprise_id')
            ->select(

                'stagiaires.id',
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',
                'entreprises.nom_etp'
            )


            ->orderBy('stagiaires.nom_stagiaire')
            ->paginate(10);
        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.liste_generale', compact('datas', 'totale_invitation'));
    }

    public function accueil()
    {
        $totale_invitation = $this->collaboration->count_invitation();
        return view('layouts.accueil_admin', compact('totale_invitation'));
    }

    public function liste_notification()
    {
        return  view('layouts.notifications');
    }

    public function liste_message()
    {
        return  view('layouts.messages');
    }

    public function profil_user()
    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isSuperAdmin')) {
            $profil_user = 'images/entreprises/TEST15-11-2021.png';
        }
        if (Gate::allows('isAdmin')) {
            $profil_user = 'images/entreprises/TEST15-11-2021.png';
        }
        if (Gate::allows('isCFP')) {
            $logo = cfp::where('user_id', $id_user)->value('logo');
            $profil_user = 'images/CFP/' . $logo;
        }
        if (Gate::allows('isFormateur')) {
            $photo_formateur = formateur::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/formateurs/' . $photo_formateur;
        }
        if (Gate::allows('isStagiaire')) {
            $photo_stagiaire = stagiaire::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/stagiaires/' . $photo_stagiaire;
        }
        if (Gate::allows('isReferent')) {
            $photo_referent = responsable::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/responsables/' . $photo_referent;
        }
        if (Gate::allows('isManager')) {
            $photo_manager = chefDepartement::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/chefDepartement/' . $photo_manager;
        }
        return response()->json($profil_user);
    }
}

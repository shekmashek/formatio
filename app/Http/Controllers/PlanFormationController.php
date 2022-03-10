<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\PlanFormation;
use App\recueil_information;
use App\stagiaire;
use App\responsable;
use App\Domaine;
use App\formation;
use App\annee_plan;
use App\User;

class PlanFormationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        $users_id = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $users_id)->value('entreprise_id');
        $collaborateur = stagiaire::where('entreprise_id', $entreprise_id)->get();
        $liste_domaine = Domaine::all();
        $entreprise_id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        $annee = annee_plan::where(['Etat' => 'Ouvert'], ['entreprise_id' => $entreprise_id])->get();
        $liste_formation = formation::orderBy('nom_formation')->get();
        return view('stagiaire.formulairePlanDeFormation', compact('collaborateur', 'annee', 'liste_formation', 'liste_domaine'));
    }

    public function create()
    {
        $liste_formation = PlanFormation::all();
        return view('stagiaire.formulairePlanDeFormation', compact('liste_formation'));
    }

    public function store(Request $request)
    {
        //enregistrement formulaire de demande de formation par le stagiaire
        $info = new recueil_information();
        $info->formation_id = $request->IdFormation;

        if (Gate::allows('isReferent')) {
            $id = $request->stagiaire_id;
            $info->stagiaire_id = $id;
            $users_id = Auth::user()->id;
            $entreprise_id = responsable::where('user_id', $users_id)->value('entreprise_id');
        }
        if (Gate::allows('isStagiaire')) {
            $id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('id');
            $info->stagiaire_id = $id;
            $entreprise_id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        }
        $info->entreprise_id = $entreprise_id;

        $info->duree_formation = $request->duree_formation;

        $res = explode("-", $request->date_previsionnelle);
        $info->mois_previsionnelle = $res[1];
        $info->annee_previsionnelle = $res[0];
        $info->statut = "En attente";
        $info->typologie_formation = $request->typologie;
        $info->objectif_attendu = $request->objectif;
        //get date now
        $dt = Carbon::today()->toDateString();
        $info->date_demande = $dt;
        $info->annee_plan_id = $request->IdAnnee;
        $info->save();
        if (Gate::allows('isReferent')) {
            return redirect()->route('liste_demande_stagiaire');
        }
        if (Gate::allows(('isStagiaire'))) {
            return redirect()->route("liste_demande_formation");
        }
    }

    //liste des demandes des stagiaires
    public function liste_demande_stagiaire()
    {
        $users = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');

        $yearNow = Carbon::now()->format('Y');
        $idAnnee = annee_plan::where('Annee', $yearNow)->value('id');
        $test = annee_plan::where('Annee', $yearNow)->exists();
        $domaine = Domaine::all();
        $stagiaire = stagiaire::all();
        // $role_id = User::where('email', Auth::user()->email)->value('role_id');

        if (Gate::allows('isReferent')) {
            $liste = recueil_information::with('formation', 'annee_plan')->where('entreprise_id', $entreprise_id)->get();
        }

        if (Gate::allows('isManager')) {

            $liste = recueil_information::with('formation', 'annee_plan')->where('entreprise_id', $entreprise_id)->get();

        }


        if (Gate::allows('isSuperAdmin')) {

            $liste = recueil_information::with('formation')->get();
        }

        return view('referent.listeDemandeFormation', compact('liste', 'domaine', 'stagiaire', 'yearNow', 'users'));
    }


    public function show()
    {
    }

    //modification plan formation
    public function edit($id)
    {
        $liste_plan = PlanFormation::findOrFail($id);
        return view('referent.liste_planFormation', compact('liste_plan'));
    }

    public function update(Request $request, $id)
    {
        $liste_plan = PlanFormation::findOrFail($id);
        $liste_plan->update([
            'cout_previsionnel' => $request->cout, 'mode_financement' => $request->mode_financement
        ]);
        return   redirect()->route('listePlanFormation');
    }

    public function destroy($id)
    {
        //
    }
    public function formation_demandee()
    {

        $liste_domaine = Domaine::all();
        $id =stagiaire::where('mail_stagiaire', Auth::user()->email)->value('id');
        $recueilInfo = recueil_information::with('formation')->where('stagiaire_id', $id)->get();

        return view('stagiaire.liste_demande', compact('recueilInfo', 'liste_domaine'));
    }
    //accepter une demande de formation
    public function accepter_demande(Request $request)
    {
        $idRecueil = $request->Id;
        $Statut = $request->Statut;
        DB::table('recueil_informations')
            ->where('id', $idRecueil)

            ->update(['statut' => $Statut]);
        $liste =  recueil_information::where('id', $idRecueil)
            ->get();
        return response()->json($liste);
    }
    //enregistrer plan de formation
    public function enregistrer_planFormation(Request $request)
    {
        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        //condition de validation de formulaire
        $request->validate(
            [
                'cout' =>  ["required"]
            ],
            [
                'cout.required' => 'Entrez le coût previsionnel'
            ]
        );

        $planFormation = new PlanFormation();
        $planFormation->entreprise_id = $entreprise_id;
        $planFormation->cout_previsionnel = $request->cout;
        $planFormation->mode_financement = $request->mode_financement;
        $planFormation->recueil_information_id = $request->idRecueil;
        $planFormation->status = "A venir";

        $planFormation->annee_plan_id = $request->idAnnee;
        $planFormation->save();
        return redirect()->route('listePlanFormation');
    }

    //liste des plans de formation de l'année
    public function liste_plan()
    {
        $formations = formation::with('domaine')->get();
        $stagiaire = stagiaire::all();
        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        $liste_plan = PlanFormation::with('recueil_information','entreprise')->where('entreprise_id', $entreprise_id)->get();
        return view('referent.liste_planFormation', compact('liste_plan', 'formations', 'stagiaire'));
    }

    //liste de formations par domaines
    public function domaineParFormation(Request $request)
    {
        $idDomaine = $request->id;
        $formation_domaine = formation::where('domaine_id', $idDomaine)->get();
        return response()->json($formation_domaine);
    }

    //autocomplete
    public function getAnnee(Request $request)
    {
        $search = $request->annee;

        if ($search == '') {
            $annee = annee_plan::orderby('Annee', 'desc')->select('id', 'Annee')->limit(5)->get();
        } else {
            $annee = annee_plan::orderby('Annee', 'desc')->select('id', 'Annee')->where('Annee', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($annee as $annees) {
            $response[] = array("value" => $annees->id, "label" => $annees->Annee);
        }
        return response()->json($response);
    }

    //recherche de demande par année
    public function rechercheDemandeAnnee(Request $request)
    {
        $annee = $request->annee;
        $entreprise_id =stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        if ($annee == '') {
            $liste = recueil_information::get();
        } else {
            $idAnnee = annee_plan::where('Annee', $annee)->value('id');
            $liste = recueil_information::where(['annee_plan_id' => $idAnnee], ['entreprise_id' => $entreprise_id])->get();
        }
        $domaine = Domaine::all();
        $stagiaire = stagiaire::all();
        return view('referent.listeDemandeFormation', compact('liste', 'domaine', 'stagiaire'));
    }
    //ajout annee_plan

    public function enregistrer_plan(Request $request)
    {

        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        //condition de validation de formulaire
        $request->validate(
            [
                'annee' => ["required"],

            ],
            [
                'annee.required' => 'Veuillez remplir le champ',
            ]
        );
        $annee_plan = new annee_plan();
        $annee_plan->entreprise_id = $entreprise_id;
        $annee_plan->Annee = $request->annee;
        $annee_plan->Etat = "Ouvert";
        $annee_plan->save();
        return redirect()->route('listePlanFormation');
    }
    //AFFICHER Detail recueil informations
    public function afficherDetail()
    {
        $id = request()->id;
        $plan = recueil_information::with('stagiaire', 'formation')->where('id', $id)->get();
        return view('referent.ajout', compact('plan'));
    }
}

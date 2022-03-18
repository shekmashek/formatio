<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question_evaluation;
use App\stagiaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\cfp;
use App\formation;
use App\demande_test;
use App\responsable;
use Carbon\Carbon;
use App\entreprise;
use Illuminate\Support\Facades\Gate;

class AutoEvaluationController extends Controller
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
        $mail = Auth::user()->email;
        $stagiaire = stagiaire::where('mail_stagiaire', $mail)->get(['id', 'entreprise_id']);
        $notifications = DB::select('select * from v_notification_demande where stagiaire_id = ? and etat = 0', [$stagiaire[0]->id]);
        return view('admin.qcm.notifications', compact('notifications'));
    }

    public function notifiaction()
    {
        $stagiaire_id = stagiaire::where('user_id', Auth::user()->id)->value('id');
        $notifications = DB::select('select * from v_notification_demande where stagiaire_id = ? and etat = 0', [$stagiaire_id]);
        return response()->json($notifications);
    }

    public function faire_test(Request $request)
    {
        $mail = Auth::user()->email;
        $stagiaire = stagiaire::where('mail_stagiaire', $mail)->get(['id', 'entreprise_id']);
        $question = DB::select('select * from question_evaluations where cfp_id = ? and formation_id = ?', [$request->id_cfp, $request->id_formation]);
        $choix = DB::select('select * from v_question_reponse_test_niveau where cfp_id = ? and formation_id = ?', [$request->id_cfp, $request->id_formation]);
        if (count($question) <= 0) {
            return back();
        } else {
            return view('admin.qcm.auto_evaluation', compact('question', 'choix'));
        }
    }

    public function inserer_reponse(Request $request)
    {
        $mail = Auth::user()->email;
        $stagiaire =stagiaire::where('mail_stagiaire', $mail)->get(['id', 'entreprise_id']);
        $info = DB::select('select * from v_notification_test_niveaux where stagiaire_id = ? and entreprise_id = ?', [$stagiaire[0]->id, $stagiaire[0]->entreprise_id]);
        $formation_id = $info[0]->formation_id;
        $cfp_id = $info[0]->cfp_id;
        $demande_id = $info[0]->demande_tn_id;
        $stg = $stagiaire[0]->id;
        $question = Question_evaluation::where(['cfp_id' => $cfp_id], ['formations_id' => $formation_id])->get();

        if (empty($request->all()['radio'])) {
            $i = 1;
            foreach ($question as $q) {
                DB::insert('insert into reponse_pour_questions (demande_tn_id,stagiaire_id, question_id, points) values (?, ?, ?, ?)', [$demande_id, $stg, $q->id, 0]);
                $i++;
            }
        } else {
            $reponse = $request->all()['radio'];
            $i = 1;
            foreach ($question as $q) {
                if (isset($reponse[$i])) {
                    DB::insert('insert into reponse_pour_questions (demande_tn_id,stagiaire_id, question_id, points) values (?, ?, ?, ?)', [$demande_id, $stg, $q->id, $reponse[$i]]);
                } else {
                    DB::insert('insert into reponse_pour_questions (demande_tn_id,stagiaire_id, question_id, points) values (?, ?, ?, ?)', [$demande_id, $stg, $q->id, 0]);
                }
                $i++;
            }
        }
        DB::update('update stagiaire_pour_test_niveaux set etat = 1 where demande_tn_id = ? and stagiaire_id = ? ', [$demande_id, $stg]);
        return redirect()->route('resultat_qcm');
    }

    public function demande_test(Request $request)
    {
        $entreprises = entreprise::all();
        $centre = cfp::all();
        $formation = formation::all();
        return view('admin.qcm.demande_test_niveau', compact('centre', 'formation', 'entreprises'));
    }

    public function formationCFP(Request $request)
    {
        $id = $request->Id;
        $frm = formation::where('cfp_id', $id)->get();
        return response()->json($frm);
    }

    public function inserer_demande(Request $request)
    {
        $demande = new demande_test();
        $demande->description_test = $request->description;
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {
            $demande->entreprise_id = $request->entreprise;
        }
        if (Gate::allows('isReferent')) {
            $id_entreprise = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
            $demande->entreprise_id = $id_entreprise;
        }
        $demande->cfp_id = $request->centre;
        $demande->formation_id = $request->formation;
        $demande->date_creation = Carbon::now();

        $demande->save();
        return redirect()->route('liste_demande_qcm');
    }

    public function afficher_liste_demande(Request $request)
    {
        $liste = demande_test::with('entreprise', 'cfp', 'formation')->get();
        return view('admin.qcm.liste_demande', compact('liste'));
    }

    public function choix_stagiaire()
    {
        $id_dmd = request()->id;
        $idEtp = demande_test::where('id', $id_dmd)->value('entreprise_id');
        $stagiaire = stagiaire::with('Departement', 'entreprise', 'User')->where('entreprise_id', $idEtp)->get();
        return view('admin.qcm.choix_stagiaires', compact('stagiaire', 'id_dmd'));
    }

    public function insert_stagiaire(Request $request)
    {
        $id_dmd = $request->demande;

        $stagiaire = $request['stagiaire'];
        for ($i = 0; $i < count($stagiaire); $i++) {
            DB::insert('insert into stagiaire_pour_test_niveaux (stagiaire_id, demande_tn_id) values (?, ?)', [$stagiaire[$i], $id_dmd]);
        }
        return redirect()->route('liste_demande_qcm');
    }
    public function resultat_qcm()
    {
        $mail = Auth::user()->email;
        $stagiaire = stagiaire::where('mail_stagiaire', $mail)->get(['id', 'nom_stagiaire', 'prenom_stagiaire', 'entreprise_id']);
        $info = DB::select('select * from v_notification_test_niveaux where stagiaire_id = ? and entreprise_id = ?', [$stagiaire[0]->id, $stagiaire[0]->entreprise_id]);
        $resultat = DB::select('select * from v_resultat_test_niveau where stagiaire_id = ? and demande_tn_id = ?', [$stagiaire[0]->id, $info[0]->demande_tn_id]);
        return view('admin.qcm.resultat_test_niveau', compact('resultat', 'stagiaire'));
    }
}

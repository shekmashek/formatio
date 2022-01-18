<?php

namespace App\Http\Controllers;

use App\cfp;
use App\chefDepartement;
use Illuminate\Http\Request;
use App\detail;
use App\projet;
use App\module;
use App\groupe;
use App\entreprise;
use App\formation;
use App\formateur;
use App\stagiaire;
use App\responsable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\FonctionGenerique;

class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function listEvent()
    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isSuperAdmin')) {
            $detail = DB::select('select * from v_detailmodule');
        }
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $detail = DB::select('select * from v_detailmodule where cfp_id = ?', [$cfp_id]);
        }
        if (Gate::allows('isFormateur')) {
            $formateur_id = formateur::where('user_id', $id_user)->value('id');
            $detail = DB::select('select * from v_detailmodule where formateur_id = ?', [$formateur_id]);
        }
        if (Gate::allows('isStagiaire')) {
            $stagiaire_id = stagiaire::where('user_id', $id_user)->value('id');
            $detail = DB::select('select * from v_participant_groupe where stagiaire_id = ?', [$stagiaire_id]);
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $id_user)->value('entreprise_id');
            $detail = DB::select('select * from v_detailmodule where entreprise_id = ?', [$entreprise_id]);
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = chefDepartement::where('user_id', $id_user)->value('entreprise_id');
            $detail = DB::select('select * from v_detailmodule where entreprise_id = ?', [$entreprise_id]);
        }
        return response()->json($detail);
    }


    public function informationModule(Request $request)
    {
        $id = $request->Id;
        $detail = DB::select('select * from v_detailmodule where detail_id = ' . $id);
        return response()->json($detail);
    }
/*
    public function index()
    {
        $user_id = Auth::user()->id;
        $cfp_id = Cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();

        $id = request()->id_session;

        $formateur = Formateur::orderBy('nom_formateur')->get();
        $formation = Formation::orderBy('nom_formation')->get();
        $formation_id = Formation::orderBy('nom_formation')->first()->id;
        $module = Module::orderBy('nom_module')->where('formation_id', $formation_id)->get();
        $projet = $fonct->findWhere("v_projet", ["cfp_id"], [$cfp_id]);
        $entreprise = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);
        return view('admin.detail.nouveauDetail', compact('id', 'projet', 'formation', 'module', 'formateur','entreprise'));
    }
*/


public function index()
    {
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $id = request()->id_session;
        $fonct = new FonctionGenerique();
        $forma = new formateur();

        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateur = $forma->getFormateur($formateur1,$formateur2);
        $formation = $fonct->findWhere("formations",["cfp_id"],[$cfp_id]);
        $projet = $fonct->findWhere("v_projet", ["cfp_id"], [$cfp_id]);
        $entreprise = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);

        return view('admin.detail.nouveauDetail', compact('id', 'projet', 'formation', 'formateur','entreprise'));
    }


    public function show_projet(Request $req){
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();
        $projet = $fonct->findWhere("v_projet", ["cfp_id","entreprise_id"], [$cfp_id,$req->id]);
        return response()->json($projet);
    }

    public function create()
    {
        $users = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $projet = projet::orderBy('nom_projet')->get();


        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $users)->value('id');

            $datas = $fonct->findWhere("v_detailmodule", ["cfp_id"], [$cfp_id]);
            $liste = $fonct->findWhere("v_entreprise_par_projet",["cfp_id"],[$cfp_id]);
            if(count($datas)<=0){
                return view('admin.detail.guide');
              }
              else{
            return view('admin.detail.detail', compact('datas', 'liste', 'projet'));

              }
        }
        elseif (Gate::allows('isFormateur')) {
            $form_id = formateur::where('user_id', $users)->value('id');
            $datas = $fonct->findWhere("v_detailmodule", ["formateur_id"], [$form_id]);
            $liste = $fonct->findAll("entreprises");
            return view('admin.detail.detail', compact('datas', 'liste', 'projet'));
        }
        elseif (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        }
        elseif (Gate::allows('isStagiaire')) {
            $entreprise_id = stagiaire::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        }
        elseif (Gate::allows('isManager')) {
            $entreprise_id =chefDepartement::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        }
        else {
            return back();
        }

        return view('admin.detail.detail', compact('datas', 'liste', 'projet'));
    }


    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');

        //condition de validation de formulaire
        $request->validate(
            [
                'lieu' => ["required"],
                'debut' => ["required"],
                'fin' => ["required"]
            ],
            [
                'lieu.required' => 'Veuillez remplir le champ',
                'debut.required' => 'Veuillez remplir le champ',
                'fin.required' => 'Veuillez remplir le champ'
            ]
        );


        //enregistrer les projets dans la bdd
        $detail = new detail();
        $detail->lieu = $request->lieu;
        $detail->h_debut = $request->debut;
        $detail->h_fin = $request->fin;
        $detail->date_detail = $request->date;
        $detail->projet_id = $request->projet;
        $detail->groupe_id = $request->groupe;
        $detail->cfp_id = $cfp_id;
        $detail->formateur_id = $request->formateur;
        $detail->save();
        return redirect()->route('liste_detail');
    }

    public function show_detail($id)
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        $projet_id = projet::where('entreprise_id', $id)->value('id');
        $datas = detail::orderBy('date_detail')->where('projet_id', $id)->get();
        return view('admin.detail.detail', compact('datas', 'liste'));
    }


    public function show($id)
    {
        $module = module::where('formation_id', $id)->orderBy('Reference')->get();
        return response()->json($module);
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $detail = detail::where('id', $id)->with('projet')->get();
        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        //modifier les données
        $lieu = $request->Lieu;
        $date_debut = $request->Debut;
        $date_fin = $request->Fin;
        detail::where('id', $id)
            ->update([
                'lieu' => $lieu,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
            ]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data updated successfully',

            ]
        );
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
        $detail = detail::find($id);
        $detail->delete();
        return redirect()->route('liste_detail');
    }
    //affichage date en fonction session
    public function showDate(Request $request){

        $id_groupe = $request->id;
        $date_groupe = groupe::findOrFail($id_groupe);
        return response()->json($date_groupe);

    }
}

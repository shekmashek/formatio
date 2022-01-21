<?php

namespace App\Http\Controllers;

use App\cfp;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\session;
use App\detail;
use App\stagiaire;

use App\projet;
use App\groupe;
use App\formation;
use App\module;
use App\formateur;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id=null)
    {
        $users = Auth::user()->id;

        $groupe = groupe::orderBy('nom_groupe')->get();
        $stagiaire_id= stagiaire::where('user_id',$users)->value('entreprise_id');

       $projet=projet::where('entreprise_id',$stagiaire_id)->value('id');
       $detail=Detail::with('projet')->where('projet_id',$projet)->value('id');

       $formateur = formateur::orderBy('nom_formateur')->get();
       //$session_id=Detail::where('')->get();
       $formation = formation::orderBy('nom_formation')->get();
       $module = module::orderBy('nom_module')->get();
        if($detail){
            $session = Detail::with('session')->where('projet_id',$projet)->get();

         }
        else{
           // $projet = Projet::orderBy('nom_projet')->get();
            //$session = Session::orderBy('date_debut')->get();
            $session = Detail::with('session')->get();

        }
        return view('admin.session.session',compact('session','projet','groupe','formation','module','formateur'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //enregistrer les projets dans la bdd
        $session = new Session;
        $session->date_debut = $request->date_debut;
        $session->date_fin = $request->date_fin;
        $num = DB::select('select max(id)+1 as numero from sessions')[0]->numero;
        $session->numero_session = 'SES'.$num;
        $session->save();
        return redirect()->route('liste_session');
    }

    public function show($id)
    {
        $groupe = Groupe::where('projet_id',$id)->orderBy('nom_groupe')->get();
        return response()->json($groupe);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function detail_session(){
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $id = request()->id_session;
        $fonct = new FonctionGenerique();
        $forma = new formateur();

        // $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id","activiter_demande"], [$cfp_id,1]);
        // $formateur = $forma->getFormateur($formateur1,$formateur2);
        // $formation = $fonct->findWhere("formations",["cfp_id"],[$cfp_id]);
        $datas = $fonct->findWhere("v_detailmodule", ["cfp_id"], [$cfp_id]);
        $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
        $entreprise = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);
        $nombre_stg = DB::select('select count(stagiaire_id) as nombre from participant_groupe')[0]->nombre;
        return view('projet_session.session', compact('id', 'entreprise', 'projet', 'formateur', 'nombre_stg','datas'));
    }
}

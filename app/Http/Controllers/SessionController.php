<?php

namespace App\Http\Controllers;

use App\Cfp;
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
use App\responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        $session = new session;
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
        $id = request()->id_session;
        // ???--mbola tsy mety
        $test = DB::select('select count(id) as nombre from details')[0]->nombre;
        $nombre_stg = DB::select('select count(stagiaire_id) as nombre from participant_groupe')[0]->nombre;
        // ???--
        $fonct = new FonctionGenerique();
        if(Gate::allows('isCFP')){
            $cfp_id = Cfp::where('user_id', $user_id)->value('id');
            $formateur = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id","activiter_demande"], [$cfp_id,1]);
            $datas = $fonct->findWhere("v_detailmodule", ["cfp_id"], [$cfp_id]);
            $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
        }
        if(Gate::allows('isReferent')){
            $etp_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $formateur = NULL;
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$etp_id]);
            $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["entreprise_id","groupe_id"], [$etp_id,$id]);
        }
        if(Gate::allows('isFormateur')){
            $formateur_id = formateur::where('user_id', $user_id)->value('id');
            $cfp_id = DB::select("select cfp_id from v_demmande_cfp_formateur where user_id_formateur = ?",[$user_id])[0]->cfp_id;
            $formateur = NULL;
            $datas = $fonct->findWhere("v_detailmodule", ["cfp_id","formateur_id"], [$cfp_id,$formateur_id]);
            $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
        }
        // public
        // ---apprenants
        $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$projet[0]->groupe_id]);
        // ---ressources
        $ressource = DB::select('select * from ressources where groupe_id =?',[$projet[0]->groupe_id]);
        // end public

        return view('projet_session.session', compact('id', 'test', 'projet', 'formateur', 'nombre_stg','datas','stagiaire','ressource'));
    }

    public function getFormateur(){
        $user_id = Auth::user()->id;
        $cfp_id = Cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id","activiter_demande"], [$cfp_id,1]);
        return response()->json($data);
    }

    public function getStagiaires(Request $request){
        $search = $request->search;
        $etp_id = $request->etp_id;
        $user_id = Auth::user()->id;
        $cfp_id = Cfp::where('user_id', $user_id)->value('id');
        if ($search == '') {
            $stagiaire = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->limit(5)->get();
        } else {
            $stagiaire = DB::select('select id,matricule from stagiaires where entreprise_id = '.$etp_id.' and matricule like "%'.$search.'%" limit 0,5');
        }

        $response = array();
        foreach ($stagiaire as $stg) {
            $response[] = array("value" => $stg->id, "label" => $stg->matricule);
        }
        return response()->json($response);
    }

    public function getOneStagiaire(Request $request)
    {
        $id = $request->Id;
        $stg = DB::select('select * from v_stagiaire_entreprise where matricule = ?',[$id]);
        return response()->json($stg);
    }

    public function addParticipantGroupe(Request $request){
        $matricule = $request->Id;
        $id_groupe = $request->groupe;
        $id_stg = stagiaire::where('matricule',$matricule)->value('id');
        DB::insert('insert into participant_groupe(stagiaire_id,groupe_id) values(?,?)',[$id_stg,$id_groupe]);
        $stg = DB::select('select * from v_stagiaire_groupe where groupe_id = ?',[$id_groupe]);
        return response()->json($stg);
    }

    public function supprimmer_stagiaire(Request $request)
    {
        $id = $request->Id;
        $groupe_id = $request->groupe;
        DB::delete('delete from participant_groupe where stagiaire_id = ? and groupe_id = ?',[$id,$groupe_id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
    public function ajout_ressource(Request $request){
        $ressource = $request->ressource;
        $groupe_id = $request->groupe;
        $id_user = Auth::user()->id;
        $demandeur = '';
        if (Gate::allows('isCFP')){
            $demandeur = Auth::user()->name;
        }
        if(Gate::allows('isFormateur')){
            $demandeur = DB::select('select nom_cfp from v_demmande_cfp_formateur where user_id_formateur = ?',[$id_user])[0]->nom_cfp;
        }
        if(Gate::allows('isReferent')){
            $demandeur = DB::select('select nom_etp from v_responsable_entreprise where user_id_responsable = ?',[$id_user])[0]->nom_etp;
        }
        DB::insert('insert into ressources(description,demandeur,groupe_id) values(?,?,?)',[$ressource,$demandeur,$groupe_id]);
        $all_ressources = DB::select('select * from ressources where groupe_id = ?',[$groupe_id]);
        return response()->json($all_ressources);
    }

    public function supprimer_ressource(Request $request)
    {
        $id = $request->Id;
        $groupe_id = $request->groupe;
        DB::delete('delete from ressources where id = ? and groupe_id = ?',[$id,$groupe_id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function insert_frais_annexe(Request $request){
        $id_user = Auth::user()->id;
        $etp_id = DB::select('select entreprise_id from v_responsable_entreprise where user_id_responsable = ?',[$id_user])[0]->entreprise_id;
        $description = $request->description;
        $montant = $request->montant;
        $groupe_id = $request->groupe;
        for ($i=0; $i < count($description); $i++) { 
            DB::insert('insert into frais_annexe_formation(description,montant,entreprise_id,groupe_id) values(?,?,?,?)',[$description[$i],$montant[$i],$groupe_id,$etp_id]);
        }
        $all_frais_annexe = DB::select('select * from ressources where groupe_id = ? and entreprise_id = ?',[$groupe_id,$etp_id]);
        return response()->json($all_frais_annexe);
    }

    public function insert_presence(Request $request){
        $presence = $request->presence;
        $groupe_id = $request->groupe;
        $detail_id = $request->detail_id;
        $stagiaire = DB::select('select stagiaire_id from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$groupe_id]);
        $i = 0;
        foreach($stagiaire as $stg){
            DB::insert('insert into presences(stagiaire_id,detail_id,status) values(?,?,?)',[$stg->stagiaire_id,$detail_id,$presence[$i]]);
            $i++;
        }
        $presence_detail = DB::select("select * from presences where detail_id = ? order by stagiaire_id as", [$detail_id]);
        return response()->json($presence_detail);
    }
}

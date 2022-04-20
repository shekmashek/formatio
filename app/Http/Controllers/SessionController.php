<?php

namespace App\Http\Controllers;

use App\cfp;
use App\ChefDepartement;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\session;
use App\detail;
use App\stagiaire;
use App\Facture;
use App\EvaluationChaud;
use App\projet;
use App\groupe;
use App\formation;
use App\module;
use App\formateur;
use App\Models\FonctionGenerique;
use App\responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use phpseclib3\Crypt\RC2;
use App\Mail\acceptation_session;
use App\Mail\annuler_session;
use App\Models\getImageModel;
use App\Presence;
use Exception;
use Illuminate\Support\Facades\URL;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if(Auth::user()->exists == false) return redirect()->route('sign-in');
        //     return $next($request);
        // });
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
        // dd(URL::to('/').'/sarin Gael');
        $user_id = Auth::user()->id;
        $id = request()->id_session;
        $type_formation_id = request()->type_formation;
        // ???--mbola tsy mety
        $test = DB::select('select count(id) as nombre from details where groupe_id = ?',[$id])[0]->nombre;
        $nombre_stg = DB::select('select count(stagiaire_id) as nombre from participant_groupe where groupe_id = ?',[$id])[0]->nombre;
        // ???--
        $competences = [];
        $all_frais_annexe = [];
        $documents = [];
        $stagiaire = [];
        $formateur_cfp = [];
        $salle_formation = [];
        $fonct = new FonctionGenerique();
        $module_session = DB::select('select reference,nom_module from groupes,modules where groupes.module_id = modules.id and groupes.id = ?',[$id])[0];
        if(Gate::allows('isCFP')){
            $drive = new getImageModel();

            $fonct = new FonctionGenerique();
            $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
            $cfp_id = $resp->cfp_id;
            $cfp_nom = $resp->nom_cfp;

            $formateur = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id","activiter_demande"], [$cfp_id,1]);
            $datas = $fonct->findWhere("v_detail_session", ["cfp_id","groupe_id"], [$cfp_id,$id]);
            // dd($datas);
            if($type_formation_id  == 1){
                $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
                $entreprise_id = $projet[0]->entreprise_id;
            }
            elseif($type_formation_id  == 2) {
                $projet = $fonct->findWhere("v_projet_session_inter", ["cfp_id","groupe_id"], [$cfp_id,$id]);
                $entreprise_id = null;
            }

            // $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ['cfp_id'], [$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ['cfp_id'], [$cfp_id]);
            $formateur_cfp = $fonct->concatTwoList($formateur2, []);
            // dd($formateur_cfp);
            $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$projet[0]->groupe_id]);
            $documents = $drive->file_list($cfp_nom,"Mes documents");
            $salle_formation = DB::select('select * from salle_formation_of where cfp_id = ?',[$cfp_id]);
        }
        if(Gate::allows('isReferent')){
            if (Gate::allows('isReferentPrincipale')) {
                $etp_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isStagiairePrincipale')) {
                $etp_id = stagiaire::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isManagerPrincipale')) {
                $etp_id = ChefDepartement::where('user_id', $user_id)->value('entreprise_id');
            }
            $formateur = $fonct->findWhere('v_formateur_projet',['groupe_id'],[$id]);
            $datas = $fonct->findWhere("v_detail_session", ["groupe_id"], [$id]);
            $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["entreprise_id","groupe_id"], [$etp_id,$id]);
            $all_frais_annexe = DB::select('select * from frais_annexe_formation where groupe_id = ? and entreprise_id = ?',[$id,$etp_id]);
            $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? and entreprise_id = ? order by stagiaire_id asc',[$projet[0]->groupe_id,$etp_id]);
            $documents = DB::select('select * from mes_documents where groupe_id = ?',[$id]);
            $entreprise_id = $etp_id;
        }
        if(Gate::allows('isFormateur')){
            $drive = new getImageModel();
            $formateur_id = formateur::where('user_id', $user_id)->value('id');
            $cfp_id = DB::select("select cfp_id from v_demmande_cfp_formateur where user_id_formateur = ?",[$user_id])[0]->cfp_id;
            if($type_formation_id  == 1){
                $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
                $entreprise_id = $projet[0]->entreprise_id;
            }
            elseif($type_formation_id  == 2) {
                $projet = $fonct->findWhere("v_projet_session_inter", ["cfp_id","groupe_id"], [$cfp_id,$id]);
                $entreprise_id = null;
            }
            $formateur = $fonct->findWhere('v_formateur_projet',['groupe_id'],[$id]);
            $datas = $fonct->findWhere("v_detailmodule", ["cfp_id","formateur_id","groupe_id"], [$cfp_id,$formateur_id,$id]);
            // $projet = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","groupe_id"], [$cfp_id,$id]);
            $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$projet[0]->groupe_id]);
            // $entreprise_id = $projet[0]->entreprise_id;
            $cfp_nom = cfp::where('id',$cfp_id)->value('nom');
            $documents = $drive->file_list($cfp_nom,"Mes documents");
        }

        $prix = $fonct->findWhereMulitOne('v_montant_session',['groupe_id'],[$id]);
        // public
        $competences = DB::select('select * from competence_a_evaluers where module_id = ?',[$projet[0]->module_id]);
        $evaluation_stg = DB::select('select * from evaluation_stagiaires where groupe_id = ?', [$id]);
        $ressource = DB::select('select * from ressources where groupe_id =?',[$projet[0]->groupe_id]);
        // end public
        $presence_detail = DB::select("select * from v_emargement where groupe_id = ?", [$projet[0]->groupe_id]);
        // ----evaluation
        $evaluation_apres = DB::select('select sum(note_apres) as somme from evaluation_stagiaires where groupe_id = ?',[$projet[0]->groupe_id])[0]->somme;
        $evaluation_avant = DB::select('select sum(note_avant) as somme from evaluation_stagiaires where groupe_id = ?',[$projet[0]->groupe_id])[0]->somme;
        //--modalite de formation
        $modalite = DB::select('select modalite from groupes where id = ?',[$id])[0]->modalite;
        return view('projet_session.session', compact('id', 'test', 'projet', 'formateur', 'nombre_stg','datas','stagiaire','ressource','presence_detail','competences','evaluation_avant','evaluation_apres','all_frais_annexe','evaluation_stg','documents','type_formation_id','entreprise_id','prix','module_session','formateur_cfp','modalite','salle_formation'));
    }

    public function getFormateur(){
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        $cfp_id = $resp->cfp_id;
        $data = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id","activiter_demande"], [$cfp_id,1]);
        return response()->json($data);
    }

    public function getStagiaires(Request $request){
        $search = $request->search;
        $etp_id = $request->etp_id;
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        $cfp_id = $resp->cfp_id;
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
        $etp = $request->etp;
        $groupe = $request->groupe;
        $stagiaire = DB::select('select id from stagiaires where matricule = ? and entreprise_id = ?',[$id,$etp]);
        $existe = 0;
        if(count($stagiaire) > 0){
            $stg_id = DB::select('select id from stagiaires where matricule = ?',[$id])[0]->id;
            $existe = DB::select('select count(stagiaire_id) as nombre from participant_groupe where stagiaire_id = ? and groupe_id = ?',[$stg_id,$groupe])[0]->nombre;
            $stg = DB::select('select *,concat(SUBSTRING(nom_stagiaire, 1, 1),SUBSTRING(prenom_stagiaire, 1, 1)) as sans_photo from stagiaires where matricule = ? and entreprise_id = ?',[$id,$etp]);
            return response()->json(['status'=>'200','stagiaire'=>$stg,'inscrit'=>$existe]); 
        }else{
            return response()->json(['status'=>'400']);
        }
    }

    public function addParticipantGroupe(Request $request){
        $matricule = $request->Id;
        $id_groupe = $request->groupe;
        try{
            $id_stg = stagiaire::where('matricule',$matricule)->value('id');
            DB::insert('insert into participant_groupe(stagiaire_id,groupe_id) values(?,?)',[$id_stg,$id_groupe]);
            $stg = DB::select('select * from v_stagiaire_groupe where groupe_id = ?',[$id_groupe]);
            return response()->json($stg);

        }catch(Exception $e){
            $stg = DB::select('select * from v_stagiaire_groupe where groupe_id = ?',[$id_groupe]);
            return response()->json($stg);
        }
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
            $demandeur = DB::select('select nom from v_demmande_cfp_formateur where user_id_formateur = ?',[$id_user])[0]->nom;
        }
        if(Gate::allows('isReferent')){
            $demandeur = DB::select('select nom_etp from v_responsable_entreprise where user_id= ?',[$id_user])[0]->nom_etp;
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
        $etp_id = DB::select('select entreprise_id from responsables where user_id = ?',[$id_user])[0]->entreprise_id;
        $description = $request->description;
        $montant = $request->montant;
        $groupe_id = $request->groupe;
        for ($i=0; $i < count($description); $i++) {
            DB::insert('insert into frais_annexe_formation(description,montant,entreprise_id,groupe_id) values(?,?,?,?)',[$description[$i],$montant[$i],$etp_id,$groupe_id]);
        }
        $all_frais_annexe = DB::select('select * from frais_annexe_formation where groupe_id = ? and entreprise_id = ?',[$groupe_id,$etp_id]);
        return response()->json($all_frais_annexe);
    }

    public function insert_presence(Request $request){
        if(isset($request->edit_form)){
            $presence = $request->edit_attendance;
            $h_entree = $request->edit_h_entree;
            $h_sortie = $request->edit_h_sortie;
            $note = $request->edit_note_desc;
            $detail_id = $request->edit_detail_id;
            $stg_id = $request->edit_stg_id;
            DB::update('update presences set status = ? , h_entree = ? , h_sortie = ? , note = ? where detail_id = ? and stagiaire_id = ?', [$presence[$detail_id][$stg_id],$h_entree,$h_sortie,$note,$detail_id,$stg_id]);
        }
        if(isset($request->insert_form)){
            $groupe_id = $request->groupe;
            $detail_id = $request->detail_id;
            $presence = $request->attendance;
            $h_entree = $request->entree;
            $h_sortie = $request->sortie;
            $note = $request->note_desc;
            $stagiaire = DB::select('select stagiaire_id from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$groupe_id]);
            $detail = DB::select('select h_debut,h_fin from details where id = ?',[$detail_id]);
            foreach($stagiaire as $stg){
                if(empty($h_entree[$detail_id][$stg->stagiaire_id])){
                    $h_entree[$detail_id][$stg->stagiaire_id] = $detail[0]->h_debut;
                }
                if(empty($h_sortie[$detail_id][$stg->stagiaire_id])){
                    $h_sortie[$detail_id][$stg->stagiaire_id] = $detail[0]->h_fin;
                }
                if(empty($note[$detail_id][$stg->stagiaire_id])){
                    $note[$detail_id][$stg->stagiaire_id] = "";
                }
                DB::insert('insert into presences(stagiaire_id,detail_id,status,h_entree,h_sortie,note) values(?,?,?,?,?,?)',[$stg->stagiaire_id,$detail_id,$presence[$detail_id][$stg->stagiaire_id],$h_entree[$detail_id][$stg->stagiaire_id],$h_sortie[$detail_id][$stg->stagiaire_id],$note[$detail_id][$stg->stagiaire_id]]);
            }
        }
        // $presence_detail = DB::select("select * from v_detail_presence where detail_id = ? order by stagiaire_id asc", [$detail_id]);
        return back();
    }

    public function modifier_presence(Request $request){
        $presence = $request->attendance;
        $groupe_id = $request->groupe;
        $detail_id = $request->detail_id;
        dd($request->all());
    }

    public function insert_evaluation_stagiaire(Request $request){
        $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$request->groupe]);
        $competences = DB::select('select * from competence_a_evaluers where module_id = ?',[$request->module]);
        foreach($stagiaire as $stg){
            foreach($competences as $comp){
                $stag = $request['stagiaire'][$stg->stagiaire_id];
                $note = $request['note'][$stg->stagiaire_id][$comp->id];
                DB::insert('insert into evaluation_stagiaires(groupe_id,competence_id,stagiaire_id,note_avant) values (?, ?, ?, ?)', [$request->groupe,$comp->id,$stag,$note]);
            }
        }
        return back();
    }
    public function modifier_evaluation_stagiaire(Request $request){
        $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$request->groupe]);
        $competences = DB::select('select * from competence_a_evaluers where module_id = ?',[$request->module]);
        foreach($stagiaire as $stg){
            foreach($competences as $comp){
                $stag = $request['stagiaire'][$stg->stagiaire_id];
                $note = $request['note'][$stg->stagiaire_id][$comp->id];
                // DB::insert('insert into evaluation_stagiaires(groupe_id,competence_id,stagiaire_id,note_avant) values (?, ?, ?, ?)', [$request->groupe,$comp->id,$stag,$note]);
                DB::update('update evaluation_stagiaires set note_avant = ? where groupe_id = ? and competence_id = ? and stagiaire_id = ?',[$note,$request->groupe,$comp->id,$stag]);
            }
        }
        return back();
    }

    public function insert_evaluation_stagiaire_apres(Request $request){
        $stagiaire = DB::select('select * from v_stagiaire_groupe where groupe_id = ? order by stagiaire_id asc',[$request->groupe]);
        $competences = DB::select('select * from competence_a_evaluers where module_id = ?',[$request->module]);
        foreach($stagiaire as $stg){
            foreach($competences as $comp){
                $stag = $request['stagiaire'][$stg->stagiaire_id];
                $note = $request['note'][$stg->stagiaire_id][$comp->id];
                DB::update('update evaluation_stagiaires set note_apres = ? where stagiaire_id = ? and groupe_id = ? and competence_id = ?',[$note,$stag,$request->groupe,$comp->id]);
            }
        }
        return back();
    }

    public function get_competence_stagiaire(Request $request){
        $data = DB::select('select * from v_evaluation_stagiaire_competence where stagiaire_id = ? and groupe_id = ?',[$request->stg,$request->groupe]);
        return response()->json($data);
    }

    public function acceptation_session(Request $request){
        // envoyer mail
        $fonct = new FonctionGenerique();
        $session = $fonct->findWhereMulitOne('v_groupe_projet_entreprise',['groupe_id'],[$request->groupe]);
        $name_session = $session->nom_groupe;
        $name_etp = $session->nom_etp;
        $date_debut = $session->date_debut;
        $date_fin = $session->date_fin;
        $mail_etp = $session->email_etp;
        Mail::to($session->mail_cfp)->send(new acceptation_session($mail_etp,$name_session,$name_etp,$date_debut,$date_fin));
        // fin
        DB::update('update groupes set status = 2 where id = ?',[$request->groupe]);
        return back();
    }

    public function annuler_session(Request $request){
        if(Gate::allows('isReferent')){
            $fonct = new FonctionGenerique();
            $session = $fonct->findWhereMulitOne('v_groupe_projet_entreprise',['groupe_id'],[$request->groupe]);
            $name_session = $session->nom_groupe;
            $name_etp = $session->nom_etp;
            $name_cfp = $session->nom_cfp;
            $date_debut = $session->date_debut;
            $date_fin = $session->date_fin;
            $mail_acteur = $session->email_etp;
            $mail_cfp = $session->mail_cfp;
            Mail::to($mail_cfp)->send(new annuler_session($mail_acteur,$name_session,$name_etp,$name_cfp,$date_debut,$date_fin));
        }
        DB::update('update groupes set status = 1 where id = ?',[$request->groupe]);
        return back();
    }



    public function save_documents(Request $request){
        $user_id = Auth::user()->id;
        // $cfp = Cfp::where('user_id', $user_id)->value('nom');
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        $cfp = $resp->nom_cfp;
        $groupe = $request->groupe;
        $paths = $request->path;
        $nom_docs = $request->nom_doc;
        $extensions = $request->extension;
        for ($i=0; $i < count($paths); $i++) {
            $nombre = DB::select('select count(path) as nombre from mes_documents where path = ? and groupe_id = ?',[$paths[$i],$groupe])[0]->nombre;
            if($nombre <=0){
                DB::insert('insert into mes_documents(path,groupe_id,nom_doc,extension) values(?,?,?,?)',[$paths[$i],$groupe,$nom_docs[$i],$extensions[$i]]);
            }
        }
        return back();
    }

    public function telecharger_fichier(){
        $user_id = Auth::user()->id;
        // $cfp = Cfp::where('user_id', $user_id)->value('nom');
        // $fonct = new FonctionGenerique();
        // $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);

        // $cfp_id = $resp->cfp_id;
        // $cfp = $resp->nom_cfp;
        $namefile = request()->filename;
        $cfp = request()->cfp;
        $extension = request()->extension;
        $drive = new getImageModel();
        return $drive->download_file($cfp,"Mes documents",$namefile,$extension);
    }

    public function get_presence_stg(Request $request){
        $stg = $request->stagiaire;
        $detail = $request->detail;
        $fonct = new FonctionGenerique();
        $data = $fonct->findWhereMulitOne('v_detail_presence_stagiaire',['stagiaire_id','detail_id'],[$stg,$detail]);
        return response()->json($data);
    }

    public function inscription(Request $request){
        try{
            $user_id = Auth::user()->id;
            $etp_id = responsable::where('user_id',$user_id)->value('entreprise_id');
            DB::insert('insert into groupe_entreprises (groupe_id, entreprise_id) values (?, ?)', [$request->id_groupe, $etp_id]);
            return redirect()->route('detail_session',['id_session'=>$request->id_groupe]);
        }catch(Exception $e){
            return back()->with('error','Insription échouée!');
        }
    }

}

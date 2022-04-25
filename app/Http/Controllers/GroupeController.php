<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\responsable;
use App\User;
use Illuminate\Http\Request;
use App\groupe;
use App\projet;
use App\cfp;
use App\Models\FonctionGenerique;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class GroupeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if(Auth::user()->exists == false) return redirect()->route('sign-in');
        //     return $next($request);
        // });
    }
    public function index()
    {
        $users = Auth::user()->id;

        $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');

        $id_groupe = projet::where('entreprise_id', $entreprise_id)->value('id');

        $role_id = User::where('email', Auth::user()->email)->value('role_id');
        if ($role_id == 2) {
            $groupe = groupe::with('projet')->where('projet_id', $id_groupe)->get();
        } else {
            $groupe = groupe::orderBy('nom_groupe')->with('projet')->get();
        }
        return view('admin.groupe.groupe', compact('groupe', 'users'));
    }

    public function create()
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        // $cfp_id = cfp::where('user_id', $user_id)->value('id');
        // dd($fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]));
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        $type_formation = request()->type_formation;
        $formations = $fonct->findWhere("v_formation", ['cfp_id'], [$cfp_id]);
        $modules = $fonct->findAll("modules");

        $etp1 = $fonct->findWhere("v_demmande_cfp_etp", ['cfp_id'], [$cfp_id]);
        $etp2 = $fonct->findWhere("v_demmande_etp_cfp", ['cfp_id'], [$cfp_id]);
        $entreprise = $fonct->concatTwoList($etp1, $etp2);
        $payement = $fonct->findAll("type_payement");
        return view('projet_session.projet_intra_form', compact('type_formation', 'formations', 'modules', 'entreprise', 'payement'));
    }

    public function createInter()
    {
        $fonct = new FonctionGenerique();
        $formations = [];
        $modules = [];
        $user_id = Auth::user()->id;
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        $type_formation = request()->type_formation;
        $formations = $fonct->findWhere("v_formation", ["cfp_id"], [$cfp_id]);
        $modules = $fonct->findWhere("v_module", ["cfp_id", "status"], [$cfp_id, 2]);
        // dd($formations,$modules);
        return view('projet_session.projet_inter_form', compact('type_formation', 'formations', 'modules'));
    }

    public function sessionInter($id)
    {
        $module_id = $id;
        return view('projet_session.session_inter', compact('module_id'));
    }

    public function module_formation(Request $rq)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id])->cfp_id;
        $module = $fonct->findWhere("modules", ["formation_id","cfp_id",'status'], [$rq->id,$cfp_id,2]);

        return response()->json($module);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

        $type_formation = $request->type_formation;
        try {
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de début doit être inférieur date de fin.");
            }

            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if($request->module_id == null){
                throw new Exception("Vous devez choisir un module de formation.");
            }

            if($request->entreprise == null){
                throw new Exception("Vous devez choisir une entreprise pour la formation.");
            }
            if($request->payement == null){
                throw new Exception("Vous devez choisir le mode de payement pour la formation.");
            }
            if($request->min_part >= $request->max_part ){
                throw new Exception("Participant minimal doit être inférieur au participant maximal.");
            }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalité de formation.");
            }
            DB::beginTransaction();
            $projet = new projet();

            $nom_projet = $projet->generateNomProjet();


            DB::insert('insert into projets(nom_projet,cfp_id,type_formation_id,status,activiter,created_at) values(?,?,?,?,TRUE,current_timestamp())', [$nom_projet, $cfp_id, $type_formation, 'Confirmé']);

            $last_insert_projet = DB::table('projets')->latest('id')->first();
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession($last_insert_projet->id);
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,?,?,?,1,?,TRUE)',
                [$request->max_part, $request->min_part, $nom_groupe, $last_insert_projet->id, $request->module_id, $request->payement, $request->date_debut, $request->date_fin,$request->modalite]
            );

            $last_insert_groupe = DB::table('groupes')->latest('id')->first();
            $fonct = new FonctionGenerique();
            $data = $request->all();
            DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)', [$last_insert_groupe->id, $request->entreprise]);
            DB::commit();
            return redirect()->route('detail_session', ['id_session' => $last_insert_groupe->id, 'type_formation' => $type_formation]);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function modifier_session_intra(Request $request){
        try{
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de début doit être inférieur à la date de fin.");
            }
            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if($request->module_id == null){
                throw new Exception("Vous devez choisir un module de formation.");
            }
            if($request->payement == null){
                throw new Exception("Vous devez choisir une entreprise pour la formation.");
            }
            if($request->min_part >= $request->max_part ){
                throw new Exception("Participant minimal doit être inférieur au participant maximal.");
            }
            DB::beginTransaction();
            DB::update('update groupes set max_participant = ? ,min_participant = ? , module_id = ? ,type_payement_id = ? , date_debut = ? , date_fin = ? where id = ?',
            [$request->max_part,$request->min_part,$request->module_id,$request->payement,$request->date_debut,$request->date_fin,$request->id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('groupe_error',$e->getMessage());
        }
    }

    public function modifier_session_inter(Request $request){
        try{
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de début doit être inférieur à la date de fin.");
            }
            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if($request->min_part >= $request->max_part ){
                throw new Exception("Participant minimal doit être inférieur au participant maximal.");
            }
            DB::beginTransaction();
            DB::update('update groupes set max_participant = ? ,min_participant = ? , date_debut = ? , date_fin = ? where id = ?',
            [$request->max_part,$request->min_part,$request->date_debut,$request->date_fin,$request->id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('groupe_error',$e->getMessage());
        }
    }

    public function storeInter(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        $type_formation = $request->type_formation;

        try {
            if ($request->date_debut >= $request->date_fin) {
                throw new Exception("Date de début doit être inférieur à la date de fin.");
            }
            if ($request->date_debut == null || $request->date_fin == null) {
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if ($request->min_part >= $request->max_part) {
                throw new Exception("Participant minimal doit être au participant maximal.");
            }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalité de formation.");
            }
            DB::beginTransaction();
            $projet = new projet();
            $nom_projet = $projet->generateNomProjet();
            DB::insert('insert into projets(nom_projet,cfp_id,type_formation_id,status,activiter,created_at) values(?,?,?,?,TRUE,current_timestamp())', [$nom_projet, $cfp_id, $type_formation, 'Confirmé']);

            $last_insert_projet = DB::table('projets')->latest('id')->first();
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession($last_insert_projet->id);
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,?,?,?,1,?,TRUE)',
                [$request->max_part, $request->min_part, $nom_groupe, $last_insert_projet->id, $request->module_id, 1, $request->date_debut, $request->date_fin,$request->modalite]
            );

            $last_insert_groupe = DB::table('groupes')->latest('id')->first();
            DB::commit();
            return redirect()->route('detail_session', ['id_session' => $last_insert_groupe->id, 'type_formation' => 2]);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $groupe = groupe::where('id', $id)->get();
        return response()->json($groupe);
    }

    public function update(Request $request, $id)
    {
        $maj = groupe::where('id', $id)->update([
            'min_participant' => $request->edit_min_part,
            'max_participant' => $request->edit_max_part,
            'date_debut' => $request->edit_dte_debut,
            'date_fin' => $request->edit_dte_fin
        ]);

        // dd($request->input());
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        // $del = groupe::where('id', $id)->delete();
        DB::delete('delete from groupes where id = ?', [$id]);
        return back();
    }

    public function insert_session(Request $request)
    {
        try {
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de début doit être inférieur date de fin.");
            }

            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de début ou date de fin est vide.");
            }
            if($request->min_part >= $request->max_part ){
                throw new Exception("Participant minimal doit être inférieur au participant maximal.");
            }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalité de formation.");
            }
            DB::beginTransaction();
            $projet = $request->projet;
            $fonct = new FonctionGenerique();
            $session = $fonct->findWhereMulitOne('v_groupe_projet_entreprise', ['projet_id'], [$projet]);
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession($projet);
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,activiter,modalite) values(?,?,?,?,?,?,?,?,1,TRUE,?)',
                [$request->max_part, $request->min_part, $nom_groupe, $projet, $session->module_id, $session->type_payement_id, $request->date_debut, $request->date_fin,$request->modalite]
            );
            $last_insert_groupe = DB::table('groupes')->latest('id')->first();

            DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)', [$last_insert_groupe->id, $session->entreprise_id]);
            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function modifier_statut_session(Request $request){
        try{
            DB::beginTransaction();
            if($request->statut == 8 || $request->statut == 7 || $request->statut == 6){
                DB::delete('delete from details where groupe_id = ?',[$request->id]);
                DB::delete('delete from participant_groupe where groupe_id = ?',[$request->id]);
                DB::delete('delete from mes_documents where groupe_id = ?',[$request->id]);
                DB::delete('delete from ressources where groupe_id = ?',[$request->id]);
                DB::delete('delete from evaluation_stagiaires where groupe_id = ?',[$request->id]);
                DB::update('update groupes set status = ? where id = ? ',[$request->statut,$request->id]);
            }else{
                DB::update('update groupes set status = ? where id = ? ',[$request->statut,$request->id]);
            }
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('groupe_error',"Modification du statut de la session échouée!");
        }
    }

    public function supprimer_groupe($id){
        try{
            DB::beginTransaction();
            DB::delete('delete from details where groupe_id = ?',[$id]);
            DB::delete('delete from participant_groupe where groupe_id = ?',[$id]);
            DB::delete('delete from mes_documents where groupe_id = ?',[$id]);
            DB::delete('delete from ressources where groupe_id = ?',[$id]);
            DB::delete('delete from evaluation_stagiaires where groupe_id = ?',[$id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('groupe_error',"Modification du statut de la session échouée!");
        }
    }
}

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

class GroupeController extends Controller
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


    public function create($idProjet)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $projet = $fonct->findWhereMulitOne("v_projet_cfp", ["projet_id"], [$idProjet]);
        $groupe = $fonct->findWhere("v_groupe_projet_entreprise_module", ["projet_id"], [$idProjet]);
        $module = $fonct->findWhere("v_module", ["cfp_id"], [$cfp_id]);
        $formation = $fonct->findWhere("v_formation", ["cfp_id"], [$cfp_id]);
        $entreprise = $fonct->findAll("v_demmande_cfp_etp");
        $payement = $fonct->findAll("type_payement");
        return view('admin.groupe.nouveauGroupe', compact('projet', 'groupe', 'formation', 'module','entreprise','payement'));
    }

  /*  public function create($idProjet)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $projet = $fonct->findWhereMulitOne("v_projet_cfp", ["projet_id"], [$idProjet]);
        $groupe = $fonct->findWhere("v_groupe_projet_entreprise_module", ["projet_id"], [$idProjet]);
        $formation = $fonct->findWhere("formations", ["cfp_id"], [$cfp_id]);
        $module = $fonct->findAll("modules");
        $entreprise = $fonct->findAll("v_demmande_cfp_etp");
        $payement = $fonct->findAll("type_payement");
        return view('admin.groupe.nouveauGroupe', compact('projet', 'groupe', 'formation', 'module','entreprise','payement'));
    } */


    public function module_formation(Request $rq)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $module = $fonct->findWhere("modules", ["formation_id","cfp_id"], [$rq->id,$cfp_id]);

        return response()->json($module);
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'min_part' => "required|numeric|min:0",
                'max_part' => "required|numeric|min:0",
                'date_debut' => "required|date",
                'date_fin' => "required|date",
                'module_id' => "required",
            ],
            [
                'date_debut.required' => 'la date du debut de formation ne doit pas être null',
                'date_fin.required' => 'la date fin de formation ne doit pas être null',
                'module_id.required' => 'le module  de la formation ne doit pas être null',
            ]
        );

        try{
            DB::beginTransaction();
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession($request->projet_id);
            DB::insert('insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,activiter) values(?,?,?,?,?,?,?,?,"En Cours",TRUE)',
            [$request->max_part,$request->min_part,$nom_groupe,$request->projet_id,$request->module_id,$request->payement,$request->date_debut,$request->date_fin]);

            $last_insert = DB::table('groupes')->latest('id')->first();
            $fonct = new FonctionGenerique();
            $projet = $fonct->findWhereMulitOne("projets", ["id"], [$request->projet_id]);
            $data = $request->all();

            if($projet->type_formation_id == 1){
                DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)',[$last_insert->id,$request->entreprise]);
            }
            if($projet->type_formation_id == 2){
                for($i = 0; $i < count($data['entreprise']); $i++){
                    DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)',[$last_insert->id,$data['entreprise'][$i]]);
                }
            }
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('groupe_error',"insertion de la session échouée!");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $groupe =groupe::where('id', $id)->get();
        return response()->json($groupe);
    }

    public function update(Request $request,$id)
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
}

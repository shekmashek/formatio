<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\programme;
use App\module;
use App\cfp;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgrammeController extends Controller
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
        $fonction = new FonctionGenerique();
        $programme = new programme();
        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $programmes = DB::select('select * from cfpcours where cfp_id = ?', [$cfp_id]);

            if (count($programmes) <= 0) {
                return view('admin.programme.guide');
            } else {
                return view('admin.programme.programme', compact('programmes'));
            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $programmes = $programme->findAllProgramme();
        }
        return view('admin.programme.programme', compact('programmes'));
    }
    public function new()
    {
        return view('admin.programme.programme');
    }

    public function create(Request $request)
    {
        $programme = new programme();
        $programme->validation_form($request);
        $programme->insert($request->input());
        return back()->with('success', 'Création  de nouveau programme terminé');
    }

    public function store(Request $request)
    {
        $id = $request->id_module;
        $donnees = $request->all();
        $fonct = new FonctionGenerique();
        for ($i = 0; $i < count($donnees['titre_prog']); $i++) {
            $verify_prog = $fonct->findWhereMulitOne("programmes", ["titre", "module_id"], [$donnees['titre_prog'][$i], $id]);
            if ($verify_prog != null) {
                $id_prog = $verify_prog->id;
            } else {
                $prog = DB::insert('insert into programmes(titre,module_id) values(?,?)', [$donnees['titre_prog'][$i], $id]);
                $id_prog = $fonct->findWhereMulitOne("programmes", ["titre", "module_id"], [$donnees['titre_prog'][$i], $id])->id;
                    for ($j = 0; $j < count($donnees['cours']); $j++) {
                        if ($donnees['cours'][$j] != null) {
                            $cour = DB::insert('insert into cours(titre_cours,programme_id) values(?,?)', [$donnees['cours'][$j], $id_prog]);
                        }
                    }
            }
        }

        return redirect()->route('liste_module');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function info_data(Request $req)
    {
        $data = array();
        $programme = new programme();
        $modules = new module();

        $data['info'] = $programme->findWhereOne('id_programme', '=', $req->id);
        $data['option'] = $modules->selectDataHTML([$data['info']->formation_id]);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $programme = new programme();

        $programme->validation_form($request);
        $programme->edit($id, $request->input());
        return response()->json(['success' => 'modification des programe est terminé']);
    }

    public function destroy($id, Request $req)
    {

        $programme = new programme();
        $programmes = $programme->findAllProgramme();
        $data = $programme->supression($id);

        return back();
    }


    public function news()
    {
        $module = new module();
        $fonction = new FonctionGenerique();
        $module = $module->findAll();
        $formation = $fonction->findAll("formations");

        return view('admin.programme.nouveauProgramme', compact('module', 'formation'));
    }
}

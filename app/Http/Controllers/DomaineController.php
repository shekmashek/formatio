<?php

namespace App\Http\Controllers;

use App\Domaine;
use Illuminate\Http\Request;
use App\formation;
use App\module;
use App\categories_formations;
use App\cfp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;
use App\responsable_cfp;
use App\demande_devis;

class DomaineController extends Controller
{

    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
        $this->domaine = new domaine();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index($id = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            // $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            return view('admin.formation.formation', compact('formation','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
        }
        if (Gate::allows('isFormateur')) {
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            return view('referent.catalogue.formation', compact('domaines', 'categorie','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager') or Gate::allows('isChefDeService')) {
            //liste formation
            $categorie = formation::orderBy('nom_formation')->get();
            // $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            // $domaine_col5 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*4).'');
            // $infos = DB::select('select * from moduleformation where module_id = ?', [$id])[0];
            // $categorie = DB::select('select * from formations where status = 1 limit 5');
            $module = DB::select('select md.*,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where  status = 2 and etat_id = 1 order by md.pourcentage desc limit 6 ');
            return view('referent.catalogue.formation', compact('devise','categorie', 'module','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
        }
    }

    public function listeCrud($id = null){
        $domaine = Domaine::orderBy('nom_domaine', 'asc')->paginate(10, ['*'], 'domaine');
        $formation  = formation::orderBy('nom_formation', 'asc')->paginate(10, ['*'], 'formation');
        return view("admin.formation.liste_formation",compact('formation','domaine'));
    }

    public function create(){
        return view('superadmin.nouveau_domaine');
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'nom_domaine' => ["required"]
            ],
            [
                'nom_domaine.required' => 'Veuillez remplir le champ'
            ]
        );
        //enregistrer les formations dans la bdd
        $domaine = new domaine();
        $domaine->nom_domaine = $request->nom_domaine;
        $domaine->save();

        // redirection
        $message = 'Le domaine a bien été ajoutée. <a href="crud_formation#Domaines"> Voir la liste</a>';
        return view('superadmin.nouveau_domaine', compact('message'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        // dd($request->nom_domaine);
        domaine::where('id', $request->id)->update(['nom_domaine' => $request->nom_domaine]);
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::delete('delete from domaines where id = ?', [$id]);
        return back();
    }
}
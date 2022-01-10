<?php

namespace App\Http\Controllers;

use App\Domaine;
use Illuminate\Http\Request;
use App\formation;
use App\cfp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{

    public function index($id = null)

    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $formation = formation::with('Domaine')->where('cfp_id', $cfp_id)->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isFormateur')) {
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            return view('referent.catalogue.formation', compact('domaines', 'categorie'));
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire')) {
            //liste formation
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            return view('referent.catalogue.formation', compact('domaines', 'categorie'));
        }
    }

    public function create()
    {
        //
    }

    public function nouvelle_formation()
    {
        $domaine = Domaine::all();
        return view('admin.formation.nouvelleFormation', compact('domaine'));
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'nom_formation' => ["required"]
            ],
            [
                'nom_formation.required' => 'Veuillez remplir le champ'
            ]
        );
        $id_user = Auth::user()->id;

        $id_cfp = cfp::where('user_id', $id_user)->value('id');

        //enregistrer les formations dans la bdd
        $formation = new formation();
        $formation->nom_formation = $request->nom_formation;
        $formation->domaine_id = $request->domaine;
        $formation->cfp_id = $id_cfp;

        $formation->save();


        return redirect()->route('liste_formation');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $maj = formation::where('id', $id)->update([
            'nom_formation' => $request->nom_formation
        ]);
        $id_module = formation::where('id', $id)->value('domaine_id');
        $maj_domaine = Domaine::where('id', $id_module)->update([
            'nom_domaine' => $request->domaine
        ]);
        return back();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        $del = formation::where('id', $id)->delete();
        return back();
    }
    ///--------------CATALOGUE DE FORMATION ------------------------ //////////////
    public function rechercheParModule(Request $request)
    {
        $nom_formation = $request->nom_formation;
        if ($nom_formation == null) {
            $infos = DB::select('select * from moduleFormation');
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            return view('referent.catalogue.liste_formation',compact('infos','liste_avis'));
        }else{
            $id_formation = formation::where('nom_formation',$nom_formation)->value('id');
            $infos = DB::select('select * from moduleFormation where formation_id = ?', [$id_formation]);
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            return view('referent.catalogue.liste_formation',compact('infos','liste_avis'));
        }
    }
    public function getModulesParReference(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->limit(5)->get();
        } else {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->where('nom_formation', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($formation as $formations) {
            $response[] = array("value" => $formations->id, "label" => $formations->nom_formation);
        }
        return response()->json($response);
    }
    public function formation_domaine(Request $request)
    {
        $domaine_id = $request->domaine_id;
        $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $modules = DB::select('select * from moduleformation where domaine_id = ?', [$domaine_id]);
        return response()->json([$formations, $modules, $domaine_id]);
    }
    public function affichageParFormation($id)
    {
        $infos = DB::select('select * from moduleformation where formation_id = ?', [$id]);
        return view('referent.catalogue.liste_formation', compact('infos'));
    }
    public function affichageParModule($id){
        $infos = DB::select('select * from moduleformation where module_id = ?', [$id])[0];
        $nb_avis = DB::select('select ifnull(count(a.module_id),0) as nb_avis from moduleformation mf left join avis a on mf.module_id = a.module_id where mf.module_id = ? group by mf.module_id',[$id])[0]->nb_avis;
        $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
        $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
        $liste_avis = DB::select('select * from v_liste_avis where module_id = ? limit 5',[$id]);
        $statistiques = DB::select('select * from v_statistique_avis where module_id = ? order by nombre desc',[$id]);
        return view('referent.catalogue.detail_formation',compact('infos','cours','programmes','nb_avis','liste_avis','statistiques'));
    }
}

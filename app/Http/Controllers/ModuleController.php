<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\module;
use App\formation;
use App\programme;
use App\Niveau;
use App\cfp;
use PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
/*================ importation class Export et import ======================*/
use App\Exports\FormationExport;
use App\Imports\FormationImport;
use App\Models\FonctionGenerique;

use Excel;
use FontLib\Exception\FontNotFoundException;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    // public function index($id = null)
    // {
    //     $id_user = Auth::user()->id;
    //     $cfp_id =cfp::where('user_id', $id_user)->value('id');
    //     if (Gate::allows('isCFP')) {
    //         $infos = DB::select('select * from moduleformation where cfp_id = ?', [$cfp_id]);
    //         $categorie = formation::where('cfp_id', $cfp_id)->get();
    //         if(count($infos) <= 0){
    //             return view('admin.module.guide');
    //         }else{
    //             return view('admin.module.module', compact('infos', 'categorie'));
    //         }
    //     }
    //     if (Gate::allows('isSuperAdmin')) {
    //         $infos = DB::select('select * from moduleformation');
    //         $categorie = formation::all();
    //     }

    //     return view('admin.module.module', compact('infos', 'categorie'));
    // }

    public function index($id = null)
    {
        $fonct = new FonctionGenerique();
        $infos =null;
        $categorie=null;
        $id_user = Auth::user()->id;
        // $cfp_id = cfp::where('user_id', $id_user)->value('id');
        if (Gate::allows('isCFP')) {
            $cfp_id  = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$id_user])->cfp_id;
            $cfp = $fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);

            $infos = DB::select('select * from moduleformation where cfp_id = ?', [$cfp_id]);
            // $categorie = formation::where('cfp_id', $cfp_id)->get();
            $categorie = formation::all();
            $mod_en_cours = DB::select('select * from moduleformation as mf where NOT EXISTS (
                select * from v_cours_programme as vcp WHERE mf.module_id = vcp.module_id) and cfp_id = ?',[$cfp_id]);
            $mod_non_publies = DB::select('select * from moduleformation as mf where EXISTS (
                select * from v_cours_programme as vcp where mf.module_id = vcp.module_id) and status = 1 and cfp_id = ?',[$cfp_id]);
            $mod_publies = DB::select('select * from moduleformation where status = 2 and cfp_id = ?',[$cfp_id]);
            // $mod_pub_intra = DB::select('select nom_projet,module_id,date_debut,date_fin,nom_groupe,status_groupe from v_projet_session_inter where type_formation_id = ?',[1]);

            if (count($infos) <= 0) {
                return view('admin.module.guide');
            } else {
                return view('admin.module.module', compact('infos', 'categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies', 'cfp'));
            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $infos = DB::select('select * from moduleformation');
            $categorie = formation::all();
        }

        return view('admin.module.module', compact('categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies','infos'));
    }

    /*   ====================  Generate PDF gestion de Catalogue     */

    public function generatePDF()
    {
        $module = new module();
        $formation = new formation();

        $categories = $formation->orderBy('nom_formation')->get();
        $modulo = $module->orderBy('Reference')->with('formation')->get();
        $programmes = $module->getInfo_programme();

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $data = ['title' => 'Laravel 7 Generate PDF From View Example Tutorial'];
        $pdf = PDF::loadView('admin.pdf.pdf_catalogue', compact('modulo', 'categories', 'programmes'));

        return $pdf->download('gestion de catalogue.pdf');
    }

    /*======================  Generate Export Excel gestion de Catalogue =================*/

    public function importExportView()
    {
        return view('admin.excel.excelCatalogue');
    }

    public function export()
    {
        return Excel::download(new FormationExport, 'gestion de catalogue.xlsx');
    }

    public function import()
    {

        Excel::import(new FormationImport, request()->file('file'));
    }

    public function create()
    {
        $fonct = new FonctionGenerique();
        $domaine = $fonct->findAll("domaines");
        $liste = formation::orderBy('nom_formation')->get();
        $niveau = Niveau::all();
        return view('admin.module.nouveauModule', compact('domaine', 'liste', 'niveau'));
    }

    public function get_formation(Request $req)
    {
        $fonct = new FonctionGenerique();
        $formation = $fonct->findWhere("formations", ["domaine_id"], [$req->id]);
        return response()->json($formation);
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire

        // $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();

        $cfp_id = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

        // $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $validator = Validator::make(
            $request->all(),
            [
                'reference' => 'required',
                'nom_module' => 'required',
                'prix' =>  'required',
                'heure' => 'required',
                'jour' => 'required',
                'prerequis' => 'required',
                'objectif' => 'required',
                'description' => 'required',
                'materiel' => 'required',
                'bon_a_savoir' => 'required',
                'cible' => 'required',
                'prestation' => 'required',
                'min_pers' => 'required',
                'max_pers' => 'required'
            ],
            [
                'reference.required' => 'Veuillez remplir le champ',
                'nom_module.required' => 'Veuillez remplir le champ',
                'prix.required' => 'Veuillez remplir le champ',
                'heure.required' => 'Veuillez remplir le champ',
                'jour.required' => 'Veuillez remplir le champ',
                'prerequis.required' => 'Veuillez remplir le champ',
                'objectif.requires' => 'Veuillez remplir le champ',
                'description.required' => 'Veuillez remplir le champ',
                'materiel.required' => 'Veuillez remplir le champ',
                'bon_a_savoir.required' => 'Veuillez remplir le champ',
                'cible.required' => 'Veuillez remplir le champ',
                'prestation.required' => 'Veuillez remplir le champ',
                'min_pers.required' => 'Veuillez remplir le champ',
                'max_pers.required' => 'Veuillez remplir le champ'
            ]

        );
        if ($validator->fails()) {
            return back();
        } else {
            DB::insert('insert into modules(reference,nom_module,formation_id,prix,duree,duree_jour,prerequis,objectif,description,modalite_formation,materiel_necessaire,niveau_id,cible,bon_a_savoir,prestation,status,min,max,cfp_id)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,?,?,?)', [$request->reference, $request->nom_module, $request->categorie, $request->prix, $request->heure, $request->jour, $request->prerequis, $request->objectif, $request->description, $request->modalite, $request->materiel, $request->niveau, $request->cible, $request->bon_a_savoir, $request->prestation, $request->min_pers, $request->max_pers, $cfp_id]);
            return redirect()->route('liste_module');
        }
    }


    public function show($id)
    {
        $categorie = formation::orderBy('nom_formation')->get();
        $module = module::where('formation_id', $id)->orderBy('Reference')->with('Formation')->get();
        return view('admin.module.module', compact('module', 'categorie'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $mod = module::where('id', $id)->get();
        return response()->json($mod);
    }

    public function affichage(Request $request)
    {
        $id = $request->Id;
        $module_en_cours = DB::select('select * from moduleformation where module_id = ?',[$id]);
        $programme = DB::select('select * from v_cours_programme where module_id = ?',[$id]);
        // $nom_formation = formation::where('id', $id_formation)->value('nom_formation');
        if ($programme == null) {
            return response()->json($module_en_cours);
        }else{
            return response()->json($module_en_cours,$programme);
        }

    }

    public function modifier_mod(Request $request)
    {
        $id = $request->id;
        $fonct = new FonctionGenerique();
        if (Gate::allows('isCFP')) {
            $id_user = Auth::user()->id;
            $cfp_id = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

            // $cfp_id = cfp::where('user_id', $id_user)->value('id');

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);

        } else {

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);

        }

        return view('admin.module.modif_module', compact('module_en_modif', 'niveau'));
    }

    public function modifier_mod_prog(Request $request)
    {
        $id = $request->id;
        if (Gate::allows('isCFP')) {
            $id_user = Auth::user()->id;
            $cfp_id = cfp::where('user_id', $id_user)->value('id');

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
            dd($module_en_modif);
        } else {

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
        }

        return view('admin.module.modif_module_prog', compact('module_en_modif', 'niveau'));
    }

    public function modifier_mod_publies(Request $request)
    {
        $id = $request->id;
        if (Gate::allows('isCFP')) {
            $id_user = Auth::user()->id;
            $cfp_id = cfp::where('user_id', $id_user)->value('id');

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
        } else {

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
        }

        return view('admin.module.modif_module_publies', compact('module_en_modif', 'niveau'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        //modifier les donnée
        // DB::update('update modules set reference=?, nom_module=?, prix=?, duree=?, duree_jour=?, prerequis=?, objectif=?, modalite_formation=?, description=?, materiel_necessaire=?, bon_a_savoir=?, cible=?, prestation=?, min=?, max=? where id=?', [$request->reference, $request->nom_module, $request->prix, $request->heure, $request->jour, $request->prerequis, $request->objectif, $request->modalite, $request->description, $request->materiel, $request->bon_a_savoir, $request->cible, $request->prestation, $request->min_pers, $request->max_pers, $id]);
        return redirect()->route('liste_module');
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
        dd($id);
        // $module = module::find($id);
        //   $module->delete();
        DB::delete('delete from modules where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function getModulesReference(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $modules = module::orderby('reference', 'asc')->select('id', 'reference')->limit(5)->get();
        } else {
            $modules = module::orderby('reference', 'asc')->select('id', 'reference')->where('reference', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($modules as $module) {
            $response[] = array("value" => $module->id, "label" => $module->reference);
        }
        return response()->json($response);
    }

    public function rechercheReference(Request $request)
    {
        $reference = $request->reference;
        if ($reference == '') {
            $module = module::orderBy('Reference')->with('formation')->get();
        } else {
            $module = module::where('reference', $reference)->get();
        }
        $categorie = formation::orderBy('nom_formation')->get();
        return view('admin.module.module', compact('module', 'categorie'));
    }
    public function recherchecategorie(Request $request)
    {

        $ctg = $request->categorie;

        if ($ctg == '') {
            $formation = formation::all();
        } else {
            $categorie = formation::where('nom_formation', $ctg)->get();
        }
        $formation_id = formation::where('nom_formation', $ctg)->value('id');
        $module = module::where('formation_id', $formation_id)->get();
        return view('admin.module.module', compact('categorie', 'module'));
    }
    public function getCategorie(Request $request)
    {
        $recheche = $request->recheche;
        if ($recheche == '') {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->limit(5)->get();
        } else {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->where('nom_formation', 'like', $recheche . '%')->limit(5)->get();
        }
        $response = array();
        foreach ($formation as $form) {
            $response[] = array("value" => $form->id, "label" => $form->nom_formation);
        }
        return response()->json($response);
    }

    public function module_publier(Request $request)
    {
        $id = $request->id;
        $statut = 2;
        $competence = $request->all();
        for($i = 0; $i < count($competence['titre_competence']); $i++){
            $prog = DB::insert('insert into competence_a_evaluers(titre_competence,objectif,module_id) values(?,?,?)',[$competence['titre_competence'][$i],$competence['objectif'][$i],$id]);
        }
        $changer_status = DB::update('update modules set status = ? where id = ?',[$statut,$id]);
        return back();
    }

    public function affichageParModule($id){
        $id = request('id');

        $categorie= DB::select('select * from formations where status = 1');
        $test =  DB::select('select exists(select * from moduleformation where module_id = '.$id.') as moduleExiste');
      //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1){
            // $infos = DB::select('select * from moduleformation where formation_id = ?',[$id]);
            $infos = DB::select('select * from moduleformation where module_id = ?',[$id]);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from moduleformation mf left join avis a on mf.module_id = a.module_id where mf.formation_id = ? group by mf.formation_id',[$id]);
            if($nb == null){
                $nb_avis = 0;
            }else{
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
            $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
            $liste_avis = DB::select('select * from v_liste_avis where module_id = ? limit 5',[$id]);
            // $statistiques = DB::select('select * from v_statistique_avis where formation_id = ? order by nombre desc',[$id]);
            return view('admin.module.ajout_programme',compact('infos','cours','programmes','nb_avis','liste_avis','categorie','id'));
        }
        else return redirect()->route('liste_module');
    }

    public function get_thematique(Request $req){
        $formtion_id = $req->formation_id;
        $thematique = DB::select('select * from formations where domaine_id = ?', [$formtion_id]);
        return response()->json($thematique);
    }
}

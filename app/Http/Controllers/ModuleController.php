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
use Carbon\Carbon;

use Excel;
use FontLib\Exception\FontNotFoundException;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index($id = null, $page = null, $index = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $module_model = new module();
        $fonct = new FonctionGenerique();
        $infos =null;
        $categorie=null;
        $id_user = Auth::user()->id;

        // $cfp_id = cfp::where('user_id', $id_user)->value('id');
        if (Gate::allows('isCFP')) {
            $cfp_id  = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$id_user])->cfp_id;
            $cfp = $fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $infos = DB::select('select * from moduleformation where cfp_id = ?', [$cfp_id]);
            $categorie = formation::all();
            $date_creation = module::all();
            $niveau = Niveau::all();
            $mod_en_cours = DB::select('select * from moduleformation as mf where NOT EXISTS (
                select * from v_cours_programme as vcp WHERE mf.module_id = vcp.module_id) and cfp_id = ? order by mf.nom_module desc',[$cfp_id]);
            $mod_non_publies = DB::select('select * from moduleformation as mf where EXISTS (
                select * from v_cours_programme as vcp where mf.module_id = vcp.module_id) and status = 1 and cfp_id = ? order by nom_module desc',[$cfp_id]);
            $mod_hors_ligne = DB::select('select * from moduleformation where status = 2 and etat_id = 2 and cfp_id = ? order by nom_module desc',[$cfp_id]);
            $mod_publies = DB::select('select * from moduleformation where status = 2 and etat_id = 1 and cfp_id = ? order by nom_module desc',[$cfp_id]);


            if (count($infos) <= 0) {
                return view('admin.module.guide');
            } else {
                // return view('admin.module.module', compact('devise','infos', 'categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies', 'cfp','page','nb_module_mod_en_cours','nb_module_mod_non_publies','nb_module_mod_publies','debut','fin_page_en_cours','fin_page_non_publies','fin_page_publies','nb_par_page'));
                return view('admin.module.module', compact('devise','infos','niveau','date_creation','categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies', 'cfp', 'mod_hors_ligne'));
            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $infos = DB::select('select * from moduleformation');
            $categorie = formation::all();
        }

        // return view('admin.module.module', compact('devise','categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies','infos'));
        return view('admin.module.module', compact('devise','categorie','niveau','date_creation','mod_en_cours', 'mod_non_publies', 'mod_publies','infos'));
    }

    // pagination non utiliser
    // public function index($id = null, $page = null){
    //     $module_model = new module();
    //     $fonct = new FonctionGenerique();
    //     $infos =null;
    //     $categorie=null;
    //     $id_user = Auth::user()->id;

    //     $nb_par_page = 3;
    //     if($page == null){
    //         $page = 1.0;
    //     }
    //     if (Gate::allows('isCFP')) {
    //         $cfp_id  = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$id_user])->cfp_id;
    //         $cfp = $fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);

    //         $nb_module_mod_en_cours = DB::select('select count(module_id) as nb_module from moduleformation as mf where NOT EXISTS (
    //             select * from v_cours_programme as vcp WHERE mf.module_id = vcp.module_id) and cfp_id = ?',[$cfp_id])[0]->nb_module;

    //         $nb_module_mod_non_publies = DB::select('select count(module_id) as nb_module from moduleformation as mf where EXISTS (
    //             select * from v_cours_programme as vcp where mf.module_id = vcp.module_id) and status = 1 and cfp_id = ?',[$cfp_id])[0]->nb_module;
    //         $nb_module_mod_publies = DB::select('select count(module_id) as nb_module from moduleformation where status = 2 and cfp_id = ?',[$cfp_id])[0]->nb_module;
    //         $fin_page_en_cours = ceil($nb_module_mod_en_cours/$nb_par_page);
    //         $fin_page_non_publies = ceil($nb_module_mod_non_publies/$nb_par_page);
    //         $fin_page_publies = ceil($nb_module_mod_publies/$nb_par_page);
    //         $debut_mod_publies = 0;
    //         $debut_mod_non_publies = 0;
    //         $debut_mod_en_cours = 0;
    //         if($page == 1){

    //             $offset = 0;
    //             $debut_mod_en_cours = 1;
    //             $debut_mod_non_publies = 1;
    //             $debut_mod_publies = 1;
    //             if($nb_par_page > $nb_module_mod_en_cours){
    //                 $fin_page_en_cours = $nb_module_mod_en_cours;
    //             }else{
    //                 $fin_page_en_cours = $nb_par_page;
    //             }
    //             if($nb_par_page > $nb_module_mod_non_publies){
    //                 $fin_page_non_publies = $nb_module_mod_non_publies;
    //             }else{
    //                 $fin_page_non_publies = $nb_par_page;
    //             }
    //             if($nb_par_page > $nb_module_mod_publies){
    //                 $fin_page_publies = $nb_module_mod_publies;
    //             }else{
    //                 $fin_page_publies = $nb_par_page;
    //             }

    //         }
    //         elseif($page == $fin_page_en_cours){

    //             $offset = ($page - 1) * $nb_par_page;
    //             $debut_mod_en_cours = (($page - 1) * $nb_par_page) + 1;
    //             $fin_page_en_cours =  $nb_module_mod_en_cours;
    //         }
    //         elseif($page == $fin_page_non_publies){

    //             $offset = ($page - 1) * $nb_par_page;
    //             $debut_mod_non_publies = (($page - 1) * $nb_par_page) + 1;
    //             $fin_page_non_publies =  $nb_module_mod_non_publies;
    //         }
    //         elseif($page == $fin_page_publies){
    //             $offset = ($page - 1) * $nb_par_page;
    //             $debut_mod_publies = (($page - 1) * $nb_par_page) + 1;
    //             $fin_page_publies =  $nb_module_mod_publies;
    //             dd( $fin_page_publies );
    //         }
    //         else{

    //             $offset = ($page - 1) * $nb_par_page;
    //             $debut_mod_en_cours = (($page - 1) * $nb_par_page) + 1;
    //             $debut_mod_non_publies = (($page - 1) * $nb_par_page) + 1;
    //             $debut_mod_publies = (($page - 1) * $nb_par_page) + 1;
    //             $fin_page_en_cours =  $page * $nb_par_page;
    //             $fin_page_non_publies =  $page * $nb_par_page;
    //             $fin_page_publies =  $page * $nb_par_page;
    //         }

    //         $infos = DB::select('select * from moduleformation where cfp_id = ?', [$cfp_id]);
    //         $categorie = formation::all();
    //         $mod_en_cours = DB::select('select * from moduleformation as mf where NOT EXISTS (
    //             select * from v_cours_programme as vcp WHERE mf.module_id = vcp.module_id) and cfp_id = ? order by mf.nom_module desc limit ? offset ?',[$cfp_id,$nb_par_page,$offset]);
    //         $mod_non_publies = DB::select('select * from moduleformation as mf where EXISTS (
    //             select * from v_cours_programme as vcp where mf.module_id = vcp.module_id) and status = 1 and cfp_id = ? order by nom_module desc limit ? offset ?',[$cfp_id,$nb_par_page,$offset]);
    //         $mod_publies = DB::select('select * from moduleformation where status = 2 and cfp_id = ? order by nom_module desc limit ? offset ?',[$cfp_id,$nb_par_page,$offset]);

    //         if (count($infos) <= 0) {
    //             return view('admin.module.guide');
    //         } else {
    //             return view('admin.module.module', compact('infos', 'categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies', 'cfp','page','nb_module_mod_en_cours','nb_module_mod_non_publies','nb_module_mod_publies','debut_mod_publies','debut_mod_non_publies','debut_mod_en_cours','fin_page_en_cours','fin_page_non_publies','fin_page_publies','nb_par_page'));
    //         }
    //     }
    //     if (Gate::allows('isSuperAdmin')) {
    //         $infos = DB::select('select * from moduleformation');
    //         $categorie = formation::all();
    //     }

    //     return view('admin.module.module', compact('categorie', 'mod_en_cours', 'mod_non_publies', 'mod_publies','infos'));
    // }

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
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $fonct = new FonctionGenerique();
        $domaine = $fonct->findAll("domaines");
        $liste = formation::orderBy('nom_formation')->get();
        $niveau = Niveau::all();
        return view('admin.module.nouveauModule', compact('domaine', 'liste', 'niveau','devise'));
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
            DB::insert('insert into modules(reference,nom_module,formation_id,prix,prix_groupe,duree,duree_jour,prerequis,objectif,description,modalite_formation,materiel_necessaire,niveau_id,cible,bon_a_savoir,prestation,status,min,max,cfp_id)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,?,?,?)', [$request->reference, $request->nom_module, $request->categorie, $request->prix,$request->prix_groupe, $request->heure, $request->jour, $request->prerequis, $request->objectif, $request->description, $request->modalite, $request->materiel, $request->niveau, $request->cible, $request->bon_a_savoir, $request->prestation, $request->min_pers, $request->max_pers, $cfp_id]);
            return redirect()->route('liste_module');
        }
    }


    public function show($id)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

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
        return response()->json($module_en_cours);
    }

    public function modifier_mod(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

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

        return view('admin.module.modif_module', compact('devise','module_en_modif', 'niveau'));
    }

    public function modifier_mod_prog(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id = $request->id;
        if (Gate::allows('isCFP')) {
            $id_user = Auth::user()->id;
            $cfp_id = $this->fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$id_user])->cfp_id;
            // $cfp_id = cfp::where('user_id', $id_user)->value('id');

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
        } else {

            $niveau = Niveau::all();
            $module_en_modif = DB::select('select * from moduleformation where module_id = ?', [$id]);
        }

        return view('admin.module.modif_module_prog', compact('devise','module_en_modif', 'niveau'));
    }

    public function modifier_mod_publies(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

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

        return view('admin.module.modif_module_publies', compact('devise','module_en_modif', 'niveau'));
    }

    public function update(Request $request)
    {

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
            return back()->withErrors($validator);
        } else {
            $id = $request->id;
            //modifier les donnée
            DB::update('update modules set reference=?, nom_module=?, prix=?, prix_groupe=?, duree=?, duree_jour=?, prerequis=?, objectif=?, modalite_formation=?, description=?, materiel_necessaire=?, bon_a_savoir=?, cible=?, prestation=?, min=?, max=? where id=?', [$request->reference, $request->nom_module, $request->prix, $request->prix_groupe, $request->heure, $request->jour, $request->prerequis, $request->objectif, $request->modalite, $request->description, $request->materiel, $request->bon_a_savoir, $request->cible, $request->prestation, $request->min_pers, $request->max_pers, $id]);
            return redirect()->route('liste_module');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
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
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $reference = $request->reference;
        if ($reference == '') {
            $module = module::orderBy('Reference')->with('formation')->get();
        } else {
            $module = module::where('reference', $reference)->get();
        }
        $categorie = formation::orderBy('nom_formation')->get();
        return view('admin.module.module', compact('devise','module', 'categorie'));
    }
    public function recherchecategorie(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $ctg = $request->categorie;

        if ($ctg == '') {
            $formation = formation::all();
        } else {
            $categorie = formation::where('nom_formation', $ctg)->get();
        }
        $formation_id = formation::where('nom_formation', $ctg)->value('id');
        $module = module::where('formation_id', $formation_id)->get();
        return view('admin.module.module', compact('devise','categorie', 'module'));
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
            $prog = DB::insert('insert into competence_a_evaluers(titre_competence,objectif,module_id) values(?,?,?)',[$competence['titre_competence'][$i],$competence['notes'][$i],$id]);
        }
        $changer_status = DB::update('update modules set status = ? where id = ?',[$statut,$id]);
        return back();
    }

    public function affichageParModule($id){
        $id = request('id');
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

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
            return view('admin.module.ajout_programme',compact('devise','infos','cours','programmes','nb_avis','liste_avis','categorie','id'));
        }
        else return redirect()->route('liste_module');
    }

    public function get_thematique(Request $req){
        $formtion_id = $req->formation_id;
        $thematique = DB::select('select * from formations where domaine_id = ?', [$formtion_id]);
        return response()->json($thematique);
    }

    public function ajout_new_competence(Request $request)
    {
        $id = $request->id;
        $competence = $request->all();
        for($i = 0; $i < count($competence['titre_competence']); $i++){
            $comp = DB::insert('insert into competence_a_evaluers(titre_competence,objectif,module_id) values(?,?,?)',[$competence['titre_competence'][$i],$competence['notes'][$i],$id]);
        }
        return back();
    }

    public function modif_competence(Request $request)
    {
        $id = $request->id;
        $donnees = $request->all();
        $fonct = new FonctionGenerique();

        $competence = $fonct->findWhere('competence_a_evaluers', ['module_id'], [$id]);
        for ($i = 0; $i < count($competence); $i++) {
            $id_comp = $donnees['id_notes_' . $id . '_' . $competence[$i]->id];
            $val_comp = $donnees['titre_competence_' . $id . '_' . $competence[$i]->id];
            $val_note = $donnees['notes_' . $id . '_' . $competence[$i]->id];
            if ($donnees['titre_competence_' . $id . '_' . $competence[$i]->id] != null) {
                $cour = DB::update('update competence_a_evaluers set titre_competence=?, objectif=?  where module_id = ? and id = ?', [$val_comp, $val_note, $id_comp, $competence[$i]->id]);
            } else {
                return back()->with('error', "l'une de ces informations est invalide");
            }
        }
        return back();
    }
    public function destroy_competence(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from competence_a_evaluers where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function edit_name_module(Request $request){
        $id = $request->id;
        $nom = $request->nom_module;
        DB::update('update modules set nom_module = ? where id = ?',[$nom, $id]);
        return back();
    }
    public function edit_description(Request $request){
        $id = $request->id;
        $description = $request->description;
        DB::update('update modules set description = ? where id = ?',[$description, $id]);
        return back();
    }
    public function edit_detail(Request $request){
        $id = $request->id;
        $jour = $request->jour;
        $heure = $request->heure;
        $modalite = $request->modalite;
        $niveau = $request->niveau;
        $reference = $request->reference;
        $prix = $request->prix;
        $prix_groupe = $request->prix_groupe;
        DB::update('update modules set duree_jour = ?, duree = ?, modalite_formation = ?, reference = ?, prix = ?, prix_groupe = ?, niveau_id = ?  where id = ?',[$jour,$heure,$modalite,$reference,$prix,$prix_groupe,$niveau, $id]);
        return back();
    }
    public function edit_objectif(Request $request){
        $id = $request->id;
        $objectif = $request->objectif;
        DB::update('update modules set objectif = ? where id = ?',[$objectif, $id]);
        return back();
    }
    public function edit_public_cible(Request $request){
        $id = $request->id;
        $cible = $request->public_cible;
        DB::update('update modules set cible = ? where id = ?',[$cible, $id]);
        return back();
    }
    public function edit_prerequis(Request $request){
        $id = $request->id;
        $prerequis = $request->prerequis;
        DB::update('update modules set prerequis = ? where id = ?',[$prerequis, $id]);
        return back();
    }
    public function edit_equipement(Request $request){
        $id = $request->id;
        $equipement = $request->equipement;
        DB::update('update modules set materiel_necessaire = ? where id = ?',[$equipement, $id]);
        return back();
    }
    public function edit_bon_a_savoir(Request $request){
        $id = $request->id;
        $bon_a_savoir = $request->bon_a_savoir;
        DB::update('update modules set bon_a_savoir = ? where id = ?',[$bon_a_savoir, $id]);
        return back();
    }
    public function edit_prestation(Request $request){
        $id = $request->id;
        $prestation = $request->prestation;
        DB::update('update modules set prestation = ? where id = ?',[$prestation, $id]);
        return back();
    }

    public function mettre_en_ligne(Request $request){
        $id = $request->Id;
        $etat = 1;
        DB::update('update modules set etat_id = ? where id = ?',[$etat, $id]);
        return response()->json(['success' =>'ok']);
    }

    public function mettre_hors_ligne(Request $request){
        $id = $request->Id;
        $etat = 2;
        DB::update('update modules set etat_id = ? where id = ?',[$etat, $id]);
        return response()->json(['success' =>'ok']);
    }

}

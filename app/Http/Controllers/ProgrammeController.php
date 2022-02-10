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
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        $fonction = new FonctionGenerique();
        $programme = new programme();
        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id',$id_user)->value('id');
            $programmes = DB::select('select * from cfpcours where cfp_id = ?', [$cfp_id]);

            if(count($programmes) <= 0){
                return view('admin.programme.guide');
            }else{
                return view('admin.programme.programme',compact('programmes'));
            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $programmes = $programme->findAllProgramme();
        }
        return view('admin.programme.programme',compact('programmes'));
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
        return back()->with('success' , 'Création  de nouveau programme terminé');
    }

    public function store(Request $request)
    {
        $id = $request->id_module;
        $donnees = $request->all();

        for($i = 0; $i < count($donnees['titre_prog']); $i++){
            if ($donnees['titre_prog'][$i] != null) {
                $prog = DB::insert('insert into programmes(titre,module_id) values(?,?)',[$donnees['titre_prog'][$i],$id]);
                $id_prog = DB::select('select id from programmes order by id desc limit 1')[0]->id;
                for($j = 0; $j < count($donnees['cours_'.$i]); $j++){
                    if ($donnees['cours_'.$i][$j] != null) {
                        $cours = DB::insert('insert into cours(titre_cours,programme_id) values(?,?)',[$donnees['cours_'.$i][$j],$id_prog]);
                    }
                }
            }

        }

        return redirect()->route('liste_module');
    }

    public function update_pgc(Request $request)
    {
        $id = $request->id_module;
        $values_prog = DB::select('select titre,id from programmes where module_id = ?',[$id]);
        $id_prog = $values_prog[0]->id;
        $values_cours = DB::select('select titre_cours,id from cours where programme_id = ?',[$id_prog]);
        $donnees = $request->all();


        //         IF EXISTS(select * from test where id=30122)
        //    update test set name='john' where id=3012
        // ELSE
        //    insert into test(name) values('john');

        //    update test set name='john' where id=3012
        // IF @@ROWCOUNT=0
        //    insert into test(name) values('john');
        for($i = 0; $i < count($donnees['titre_prog']); $i++){
            $prog = DB::update('update programmes set titre=? where module_id = ?',[$donnees['titre_prog'][$i],$id]);
            if ($prog == 1) {
                $prog_inst = DB::insert('insert into programmes(titre,module_id) values(?)',[$donnees['titre_prog'][$i],$id]);
            }
        }
            // for($j = 0; $j < count($donnees['cours']); $j++){
            //     if ($donnees['cours'][$i] != null) {
            //         $cour = DB::update('update cours set titre_cours=? where programme_id = ?',[$donnees['cours'][$j],$id_prog]);
            //     }
            // }


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

    public function info_data(Request $req){
        $data = array();
        $programme = new programme();
        $modules = new module();

        $data['info'] = $programme->findWhereOne('id_programme','=',$req->id);
        $data['option']= $modules->selectDataHTML([$data['info']->formation_id]);
        return response()->json($data);

    }

    public function update(Request $request, $id)
    {
        $programme = new programme();

        $programme->validation_form($request);
        $programme->edit($id,$request->input());
        return response()->json(['success' => 'modification des programe est terminé']);
    }

    public function destroy($id,Request $req)
    {

        $programme = new programme();
        $programmes = $programme->findAllProgramme();
        $data=$programme->supression($id);

        return back();
    }


    public function news()
    {
        $module = new module();
        $fonction = new FonctionGenerique();
        $module = $module->findAll();
        $formation =$fonction->findAll("formations");

        return view('admin.programme.nouveauProgramme',compact('module','formation'));
    }

    public function ajout_programme($id){
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
            return view('admin.module.modif_programme',compact('infos','cours','programmes','nb_avis','liste_avis','categorie','id'));
        }
        else return redirect()->route('liste_module');
    }

    public function suppre_programme(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from cours where programme_id = ?',[$id]);
        DB::delete('delete from programmes where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

}

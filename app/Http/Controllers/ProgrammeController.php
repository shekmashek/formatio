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
        $this->fonct = new FonctionGenerique();
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

        for ($i = 0; $i < count($donnees['titre_prog']); $i++) {
            if ($donnees['titre_prog'][$i] != null) {
                $prog = DB::insert('insert into programmes(titre,module_id) values(?,?)', [$donnees['titre_prog'][$i], $id]);
                $id_prog = DB::select('select id from programmes order by id desc limit 1')[0]->id;
                for ($j = 0; $j < count($donnees['cours_' . $i]); $j++) {

                    if ($donnees['cours_' . $i][$j] != null) {
                        $cours = DB::insert('insert into cours(titre_cours,programme_id) values(?,?)', [$donnees['cours_' . $i][$j], $id_prog]);
                    }
                }
            }
        }
        return back()->with('success', 'Programme ajouté avec succès, vous pouvez voir votre module dans la section CONFIGURER COMPETENCE pour entrer vos competences.');
        // return redirect()->route('liste_module');
    }

    public function update_pgc(Request $request)
    {
        $id = $request->id_prog;
        $donnees = $request->all();

        $fonct = new FonctionGenerique();

        if ($request->titre_prog != null) {
            $prog = DB::update('update programmes set titre=? where id = ?', [$request->titre_prog, $id]);
            $cours = $fonct->findWhere('cours', ['programme_id'], [$id]);

            for ($i = 0; $i < count($cours); $i++) {
                $id_cour = $donnees['id_cours_' . $id . '_' . $cours[$i]->id];
                $val_cour = $donnees['cours_' . $id . '_' . $cours[$i]->id];

                if ($donnees['cours_' . $id . '_' . $cours[$i]->id] != null) {
                    $cour = DB::update('update cours set titre_cours=? where programme_id = ? and id = ?', [$val_cour, $id, $id_cour]);
                } else {
                    return back()->with('error', "l'une de ses informations est invalid");
                }
            }

        }
        if (isset($donnees["cours_new"])) {
            if ($donnees["cours_new"] != null) {
                for ($j=0; $j < count($donnees["cours_new"]); $j++) {
                    DB::insert('insert into cours(titre_cours,programme_id) values(?,?)', [$donnees['cours_new'][$j], $id]);
                }
            }

        }
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $cours_prog = DB::select('select titre,titre_cours from v_cours_programme where programme_id = ?', [$id]);
        return response()->json($cours_prog);
    }

    public function load_cours_programme(Request $request)
    {
        $id = $request->Id;
        $cours_prog = DB::select('select cours_id,programme_id,titre,titre_cours from v_cours_programme where programme_id = ?', [$id]);
        return response()->json(['cours'=>$cours_prog]);
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

    public function ajout_programme($id)
    {
        $id = request('id');
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $test =  DB::select('select exists(select * from moduleformation where module_id = ' . $id . ') as moduleExiste');
        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            // $infos = DB::select('select * from moduleformation where formation_id = ?',[$id]);
            $infos = DB::select('select * from moduleformation where module_id = ?', [$id]);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from moduleformation mf left join avis a on mf.module_id = a.module_id where mf.module_id = ? group by mf.module_id', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
            $liste_avis = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis where module_id = ? limit 10', [$id]);
            $liste_avis_count = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis where module_id = ?', [$id]);
            $statistiques = DB::select('select * from v_statistique_avis where module_id = ?',[$id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id where md.cfp_id = ?',[$infos[0]->cfp_id]);
            $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
            // dd($nb);
            $competences = DB::select('select * from competence_a_evaluers where module_id = ?', [$id]);
            // $liste_avis = DB::select('select * from v_liste_avis where module_id = ? limit 10', [$id]);
            $niveau = DB::select('select * from niveaux');
            // dd($infos[0]->niveau,$niveau);
            // $statistiques = DB::select('select * from v_statistique_avis where formation_id = ? order by nombre desc',[$id]);
            return view('admin.module.modif_programme', compact('devise','infos','liste_avis','liste_avis_count','statistiques','avis_etoile', 'cours', 'programmes', 'nb', 'liste_avis', 'categorie', 'id', 'competences','niveau'));
        } else return redirect()->route('liste_module');
    }

    public function suppre_programme(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from cours where programme_id = ?', [$id]);
        DB::delete('delete from programmes where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
}

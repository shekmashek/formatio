<?php

namespace App\Http\Controllers;

use App\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CoursControlleur extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        $id_cours = $request->id_cours;
        $cours = "";
        if ($id_cours != NULL) {
            $cours = DB::select('select titre_cours from cours where id = ?', [$id_cours])[0]->titre_cours;
        }
        $id_programme = $request->id_prog;
        return view('admin.cours.ajout_cours', compact('id_programme', 'cours', 'id_cours'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'titre_cours' => ["required"]
        //     ],
        //     [
        //         'titre_cours.required' => 'Veuillez remplir le champ'
        //     ]
        // );
        // //enregistrer les formations dans la bdd
        // $id_programme = $request->programme_id;
        // $cours = new Cours();
        // $cours->titre_cours = $request->titre_cours;
        // $cours->programme_id = $request->programme_id;
        // $cours->save();
        // $datas = DB::select('select * from v_cours_programme where programme_id = ?', [$id_programme]);
        // return view('admin.cours.liste_cours', compact('datas', 'id_programme'));
        $request->validate(
            [
                'cours' => ["required"]
            ],
            [
                'cours.required' => 'Veuillez remplir le champ'
            ]
        );

        $id = $request->id_prog;
        $donnees = $request->all();

        for($i = 0; $i < count($donnees['cours']); $i++){
            if ($donnees['cours'][$i] != null) {
                $cours = DB::insert('insert into cours(titre_cours,programme_id) values(?,?)',[$donnees['cours'][$i],$id]);
            }
        }
        return back();
    }

    public function show($id)
    {
    }

    public function edit(Request $request)
    {
        $id = $request->id_cours;
        $titre = Cours::findOrFail($id);
        return response()->json($titre);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'titre_cours' => ["required"]
            ],
            [
                'titre_cours.required' => 'Veuillez remplir le champ'
            ]
        );
        $id_cours = $request->id_cours;
        $titre_cours = $request->titre_cours;
        DB::update('update cours set titre_cours = ? where id = ?', [$titre_cours, $id_cours]);
        return back();
    }

    public function destroy(Request $request)
    {
        $id_cours = $request->id_cours;
        $id_programme = $request->id_programme;
        DB::delete('delete from cours where id = ?', [$id_cours]);
        return redirect()->route('liste_cours', ['id_prog' => $id_programme]);
    }

    public function liste_cours(Request $request)
    {
        $id_programme = $request->id_prog;
        $datas = DB::select('select * from v_cours_programme where programme_id = ?', [$id_programme]);
        return view('admin.cours.liste_cours', compact('datas', 'id_programme'));
    }

    public function suppre_cours(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from cours where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
}

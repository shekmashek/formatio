<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appel_offre;

use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AppelOffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
    }

    public function nouveau()
    {
        if (Gate::allows('isReferent')) {
            $domaines = $this->fonct->findAll("domaines");
            return view('admin.appel_offre.nouveau_appel_offre',compact('domaines'));
        }
    }
    public function index()
    {
        if (Gate::allows('isReferent')) {
            $domaines = $this->fonct->findAll("domaines");
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, false]);
            $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, true]);
            return view('admin.appel_offre.appel_offre_etp', compact('appel_offre_non_publier', 'appel_offre_publier','domaines'));
        }
        if (Gate::allows('isCFP')) {
            $domaines = $this->fonct->findAll("domaines");
            $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [false]);
            $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [true]);
            return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier','domaines'));
        }
    }

    public function publier($id){
        DB::update('update appel_offres set publier=true where id=?',[$id]);
        return back();
    }

    public function recherche_reference(Request $req)
    {
        $reference = $req->reference_search;
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);

            if ($reference != null) {
                $appel_offre_non_publier =  DB::select("select * from v_appel_offre where UPPER(nom_formation) LIKE UPPER('%" . $reference . "%') and entreprise_id=? and publier=false", [$resp_connecter->entreprise_id]);
                $appel_offre_publier =  DB::select("select * from v_appel_offre where UPPER(nom_formation) LIKE UPPER('%" . $reference . "%') and entreprise_id=? and publier=true", [$resp_connecter->entreprise_id]);
            } else {
                $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, false]);
                $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, true]);
            }
            return view('admin.appel_offre.appel_offre_etp', compact('appel_offre_non_publier', 'appel_offre_publier'));
        }

        if (Gate::allows('isCFP')) {
            $domaines = $this->fonct->findAll("domaines");
            if ($reference != null) {
                $appel_offre_publier =  DB::select("select * from v_appel_offre where UPPER(nom_formation) LIKE UPPER('%" . $reference . "%') and  publier=true");
            } else {
                $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [true]);
            }
            return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier','domaines'));
        }
    }

    public function recherche_thematique_formation(Request $req){
        $domaines = $this->fonct->findAll("domaines");

        if($req->thematique!=null){
            $appel_offre_publier =  DB::select("select * from v_appel_offre where formation_id=?",[$req->thematique]);
        } else {
            $appel_offre_publier =  DB::select("select * from v_appel_offre");
        }
        return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier','domaines'));
    }

    public function recherche_intervale_date_appel_offre(Request $req){
        $domaines = $this->fonct->findAll("domaines");
        if($req->dte_debut!=null && $req->dte_fin!=null){
          $appel_offre_publier =  DB::select("select * from v_appel_offre where date_fin>=? and date_fin<=?",[$req->dte_debut,$req->dte_fin]);
        } else {
            $appel_offre_publier =  DB::select("select * from v_appel_offre");
        }
        return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier','domaines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('tdr')->getName());

        $appel_offre = new Appel_offre();
        // $fonct = new FonctionGenerique();
        $appel_offre->validation($request);
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $appel_offre->tdr_url = "teste name tdr pour entreprise teste.pdf";
            $appel_offre->reference_soumission = $request->reference_soumission;
            $appel_offre->description_court = $request->desc_court;
            $appel_offre->date_fin = $request->dte;
            $appel_offre->hr_fin = $request->hr;
            $appel_offre->description = $request->desc_detailer;
            $appel_offre->formation_id = $request->thematique;
            $appel_offre->entreprise_id = $resp_connecter->entreprise_id;
            $appel_offre->publier = false;
            $appel_offre->save();
            // return back()->with('success', 'terminer!');
            return redirect()->route('appel_offre');
        } else {
            return back()->with('error', "vous êtes pas autorisé!  :-)");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isReferent')) {
            Appel_offre::where('id', $id)->update([
                'reference_soumission' => $request->reference_soumission,
                'description_court' => $request->desc_court,
                'description' => $request->desc_detailer,
                'date_fin' => $request->dte,
                'hr_fin' => $request->hr,
                'formation_id' => $request->thematique
            ]);
            return redirect()->route('appel_offre.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
            return view('admin.appel_offre.nouveau_appel_offre');
        }
    }
    public function index()
    {
        if (Gate::allows('isReferent')) {
            $resp_connecter = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
            $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, false]);
            $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, true]);
            return view('admin.appel_offre.appel_offre_etp', compact('appel_offre_non_publier', 'appel_offre_publier'));
        }
        if (Gate::allows('isCFP')) {
            $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [false]);
            $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [true]);
            return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier'));
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
                $appel_offre_non_publier =  DB::select("select * from v_appel_offre where UPPER(prestation_demande) LIKE UPPER('%" . $reference . "%') and entreprise_id=? and publier=false", [$resp_connecter->entreprise_id]);
                $appel_offre_publier =  DB::select("select * from v_appel_offre where UPPER(prestation_demande) LIKE UPPER('%" . $reference . "%') and entreprise_id=? and publier=true", [$resp_connecter->entreprise_id]);
            } else {
                $appel_offre_non_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, false]);
                $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["entreprise_id", "publier"], [$resp_connecter->entreprise_id, true]);
            }
            return view('admin.appel_offre.appel_offre_etp', compact('appel_offre_non_publier', 'appel_offre_publier'));
        }

        if (Gate::allows('isCFP')) {
            if ($reference != null) {
                $appel_offre_publier =  DB::select("select * from v_appel_offre where UPPER(prestation_demande) LIKE UPPER('%" . $reference . "%') and  publier=true");
            } else {
                $appel_offre_publier = $this->fonct->findWhere("v_appel_offre", ["publier"], [true]);
            }
            return view('admin.appel_offre.appel_offre_cfp', compact('appel_offre_publier'));
        }

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
            $appel_offre->dossier_fournir = $request->dossier_fournir;
            $appel_offre->date_fin = $request->dte;
            $appel_offre->hr_fin = $request->hr;
            $appel_offre->prestation_demande = $request->prestation;
            $appel_offre->contexte_prestation = $request->contexte;
            $appel_offre->information_generale = $request->information_generale;
            $appel_offre->exigence_soumission = $request->exigence_soumission;
            $appel_offre->entreprise_id = $resp_connecter->entreprise_id;
            $appel_offre->publier = false;
            $appel_offre->save();
            return back()->with('success', 'terminer!');
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
                'dossier_fournir' => $request->dossier_fournir,
                'prestation_demande' => $request->prestation,
                'date_fin' => $request->dte,
                'hr_fin' => $request->hr,
                'prestation_demande' => $request->prestation,
                'contexte_prestation' => $request->contexte,
                'information_generale' => $request->information_generale,
                'exigence_soumission' => $request->exigence_soumission,
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

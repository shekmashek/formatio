<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\responsable;
use App\branche;
use App\DepartementEntreprise;
use App\Stagiaire;
use App\service;
use App\Domaine;
use App\Module;
class RecherchemultiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_etp = responsable::where('user_id',Auth::id())->value('entreprise_id');
        $branches=branche::where('entreprise_id',$id_etp)->get();
        $stagiaires=stagiaire::where('entreprise_id',$id_etp)->get();
        $departement=DepartementEntreprise::where('entreprise_id',$id_etp)->get();
        $service = db::select('select * from v_departement_service_entreprise  where entreprise_id = ?',[$id_etp]);
        $dom_mod=db::select('select * from v_groupe_projet_entreprise_module where entreprise_id = ?',[$id_etp]);
        
        // $module=Module::all();
        // $liste_serv = db::select('select * from v_departement_service_entreprise  where entreprise_id = ? ',[$id_etp]);
        return view('projet_session.recherche_admin',compact('branches','stagiaires','departement','service','dom_mod'));
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
        $matricule = $request->matricule;
        $nom_pers = $request->nom_pers;
        $prenom_pers = $request->prenom_pers;
        $age = $request->age_pers;
        $fonction = $request->nom_fonction;
        $departement = $request->nom_departement;
        $service = $request->nom_service;
        $domaine = $request->nom_domaine;
        $thematique = $request->nom_thematique;
        $cfp = $request->nom_cfp;
        $date_jour = $request->rech_date;
        $date_mois = $request->rech_mois;
        $date_annee = $request->rech_annee;
        //recuperer les input not null
        $inputs_null = array_filter(request()->all(), function ($val) {
            return !is_null($val);
        });
        $keys = array_keys(array_filter(request()->all(), function ($val) {
            return !is_null($val);
          }));
        // dd($inputs_null);
        dd($keys);
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
        //
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

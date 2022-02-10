<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\getImageModel;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = new getImageModel();
        $rqt = DB::select('select * from cfps where user_id = ?', [Auth::id()]);
        $nom_cfp = $rqt[0]->nom;
        $get_nom_cfp = $document->get_folder($nom_cfp);
        $get_sub_folder =  $document->get_sub_folder($nom_cfp);
        $nb_sub_folder = count($get_sub_folder);
        return view('document.gestion_document',compact('get_nom_cfp','get_sub_folder','nb_sub_folder'));
        // return $document->get_folder($nom_cfp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $document->store_document($nom_cfp,'test','test','test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = new getImageModel();
        $rqt = DB::select('select * from cfps where user_id = ?', [Auth::id()]);
        $nom_cfp = $rqt[0]->nom;
        $document->create_folder($nom_cfp);
        $document->create_sub_folder($nom_cfp,$request->nom_sous_dossier);
        return redirect()->route('gestion_documentaire');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = new getImageModel();
        $rqt = DB::select('select * from cfps where user_id = ?', [Auth::id()]);
        $nom_cfp = $rqt[0]->nom;
        $get_nom_cfp = $document->get_folder($nom_cfp);
        $get_sub_folder =  $document->get_sub_folder($nom_cfp);
        $nb_sub_folder = count($get_sub_folder);
        $listes = new getImageModel();
        $res = $listes->file_list($nom_cfp,$id);
        dd($res);
        $nb_res = count($res);
        return view('document.liste_par_dossier',compact('id','get_nom_cfp','get_sub_folder','nb_sub_folder','res','nb_res'));
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
    //importation de fichier
    public function importation_fichier(Request $request){
        //récupérer le deuxième paramètre de l'url :: sub_folder
        $sub_folder = $request->sous_dossier;
        $rqt = DB::select('select * from cfps where user_id = ?', [Auth::id()]);
        $nom_cfp = $rqt[0]->nom;

        $document = new getImageModel();
        $document->store_document($nom_cfp,$sub_folder,$request->file('documents')->getClientOriginalName(),$request->file('documents')->getContent());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\getImageModel;
use App\Models\FonctionGenerique;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        $document = new getImageModel();
        $rqt = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::id()]);
        // $rqt = DB::select('select * from cfps where user_id = ?', [Auth::id()]);
        $nom_cfp = $rqt->nom_cfp;
        // $document->create_folder($nom_cfp);
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
        $rqt = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::id()]);
        $nom_cfp = $rqt->nom_cfp;
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
        $fonct = new FonctionGenerique();
        $rqt =  $fonct->findWhereMulitOne('v_responsable_cfp',['user_id'],[Auth::user()->id]);
        $nom_cfp = $rqt->nom_cfp;
        $get_nom_cfp = $document->get_folder($nom_cfp);
        $get_sub_folder =  $document->get_sub_folder($nom_cfp);
        $nb_sub_folder = count($get_sub_folder);
        $listes = new getImageModel();
        $res = $listes->file_list($nom_cfp,$id);
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
       if($request->documents == null){
            return redirect()->back()->with('error','Veuillez choisir un fichier à importer');
       }
       else{
            $sub_folder = $request->sous_dossier;

            $fonct = new FonctionGenerique();
            $rqt =  $fonct->findWhereMulitOne('v_responsable_cfp',['user_id'],[Auth::user()->id]);
            $nom_cfp = $rqt->nom_cfp;

            $document = new getImageModel();
            $document->store_document($nom_cfp,$sub_folder,$request->file('documents')->getClientOriginalName(),$request->file('documents')->getContent());
            return redirect()->back();
       }
        //récupérer le deuxième paramètre de l'url :: sub_folder

    }
    //telecharger fichier
    public function download_file(){
        $id = request()->id;
        $namefile = request()->filename;
        $extension = request()->extension;
        $document = new getImageModel();
        $rqt = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::id()]);
        $nom_cfp = $rqt->nom_cfp;
        $get_nom_cfp = $document->get_folder($nom_cfp);
        $get_sub_folder =  $document->get_sub_folder($nom_cfp);
        $nb_sub_folder = count($get_sub_folder);
        $listes = new getImageModel();
        return $listes->download_file($nom_cfp,$id,$namefile,$extension);
    }
    public function delete_folder(Request $request){
        $rqt = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::id()]);
        $nom_cfp = $rqt->nom_cfp;
        $docs = new getImageModel();
        $docs->delete_folder($nom_cfp,$request->id);
        return back();
    }
}

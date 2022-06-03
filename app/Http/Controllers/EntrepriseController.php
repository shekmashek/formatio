<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\entreprise;
use App\DepartementEntreprise;
use App\User;
use App\cfp;
use App\v_demmande_cfp_etp;
use App\Secteur;
use App\Mail\entrepriseMail;
use App\Models\getImageModel;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
use Image;

class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        // $fonct = new FonctionGenerique();
        // $referent_id = Auth::id();
        // $entreprise_id = Responsable::where('user_id',$referent_id)->value('entreprise_id');

        // $demmande = $fonct->findWhere("v_demmande_etp_pour_cfp",["demmandeur_etp_id"],[$entreprise_id]) ;
        // $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp",["inviter_etp_id"],[$entreprise_id]) ;
        // $cfps= Cfp::all();

        // return view('collaboration.entreprises',compact('cfps','demmande','invitation','entreprise_id'));
    }



    public function create($id = null)
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        $entp = new entreprise();
        if (Gate::allows('isCFP')) {
            // $cfp_id =  cfp::where('user_id', $user_id)->value('id');
            $cfp_id =  $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$user_id])->cfp_id;
            $cfps = $fonct->findWhereMulitOne("cfps",["id"],[$cfp_id]);
            $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $refuse_demmande_etp = $fonct->findWhere("v_refuse_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            // dd($refuse_demmande_etp);
            $invitation_etp = $fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]);
           $entreprise = $entp->getEntreprise($etp2, $etp1);
            // $entreprise =DB::select('select logo_etp,nom_etp,entreprise_id,photos_resp,nom_resp,prenom_resp ,SUBSTRING(prenom_resp, 1, 1) AS pr, SUBSTRING(nom_resp, 1, 1) AS nm from v_demmande_cfp_etp where cfp_id=?',[$cfp_id]);
            // dd($entreprise);
            //  $entreprisess=DB::select('select * from  v_demmande_cfp_etp where cfp_id= ?',[$cfp_id]);
            //  $entreprises=DB::select('select * from  v_demmande_cfp_etp where cfp_id= ?',[$cfp_id]);
            // $entreprises=entreprise::query()->findOrFail($cfp_id);
            // $entreprises=entreprise::findOrFail($entp);

            return view('cfp.profile_entreprise', compact('entreprise', 'refuse_demmande_etp', 'invitation_etp'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise = entreprise::orderBy('nom_etp')->with('Secteur')->get()->unique('nom_etp');
            if ($id) $datas = entreprise::orderBy('nom_etp')->take($id)->get();
            else  $datas = entreprise::orderBy("nom_etp")->get();
            // return view('cfp.profile_entreprise', compact('datas', 'entreprise'));
            return view('admin.entreprise.entreprise', compact('datas', 'entreprise'));
        }
    }
    public function information_entreprise(Request $request)
    {
        $user_id = Auth::id();
        $id = $request->Id;

        $fonct = new FonctionGenerique();
        $cfp_id =  $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$user_id])->cfp_id;
      //  $entreprises=DB::select('select * from  v_demmande_cfp_etp where entreprise_id= ?',[$id]);

        $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$id]);
        $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$id]);
        $entreprises=$fonct->concatTwoList($etp1,$etp2);

      return response()->json($entreprises);


    }


    /*  public function create($id = null)
    {
        if (Gate::allows('isCFP')) {
            $user_id = Auth::id();
            $fonct = new FonctionGenerique();
            $cfp_id =  cfp::where('user_id', $user_id)->value('id');
            $entp = new entreprise();

            $etp1 = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
            $entreprise = $entp->getEntreprise($etp2,$etp1);

            // dd($entreprise);

            if ($id){
                $datas1 = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id","entreprise_id"],[$cfp_id,$id]);
                $datas2 = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id","entreprise_id"],[$cfp_id,$id]);
                $datas = $entp->getEntreprise($datas2,$datas1);
            } else {
                $datas = $entp->getEntreprise($etp2,$etp1);
            }
            // return view('admin.entreprise.entreprise',compact('datas','entreprise'));
            if(count($entreprise  )<=0){
                return view('cfp.guide');
              }
            else{
            return view('cfp.profile_entreprise', compact('datas', 'entreprise'));

            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise =entreprise::orderBy('nom_etp')->with('Secteur')->get()->unique('nom_etp');
            if ($id) $datas = entreprise::orderBy('nom_etp')->take($id)->get();
            else  $datas = entreprise::orderBy("nom_etp")->get();
            // return view('cfp.profile_entreprise', compact('datas', 'entreprise'));
            return view('admin.entreprise.entreprise',compact('datas','entreprise'));
        }
    }
*/
    public function listeProjet(Request $request)
    {
        $id_etp = $request->entreprise_id;
        $datas = DB::select('select * from v_projetentreprise where entreprise_id = ' . $id_etp);
        return view('admin.projet.projet_entreprise', compact('datas'));
    }
    public function return_view()
    {
        $secteur = Secteur::all();
        return view('admin.entreprise.nouvelleEntreprise', compact('secteur'));
    }



    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'nom' => ["required"],
                'adresse' =>  ["required"],
                "image" => ["required"],
                "nif" => ["required"],
                "stat" => ["required"],
                "rcs" => ["required"],
                "cif" => ["required"],
                "phone" => ["required"],
            ],
            [
                'nom.required' => 'Veuillez remplir le champ',
                'adresse.required' => 'Veuillez remplir le champ',
                'image.required' => 'Veuillez choisir une photo',
                'nif.required' => 'Veuillez remplir le champ',
                'stat.required' => 'Veuillez remplir le champ',
                'rcs.required' => 'Veuillez remplir le champ',
                'cif.required' => 'Veuillez remplir le champ',
                'phone.required' => 'Veuillez remplir le champ',
            ]
        );

        $entreprise = new entreprise();
        $entreprise->nom_etp = $request->nom;
        $entreprise->email_etp = $request->mail;
        $entreprise->adresse = $request->adresse;
        $entreprise->telephone_etp = $request->phone;
        $entreprise->nif = $request->nif;
        $entreprise->stat = $request->stat;
        $entreprise->rcs = $request->rcs;
        $entreprise->cif = $request->cif;
        $entreprise->secteur_id = $request->secteur;
        $entreprise->site_etp = $request->site;
        $date = date('d-m-Y');
        $nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->phone . '' . $date . '.' . $request->image->extension());


        //stocker logo dans google drive
        $dossier = 'entreprise';
        $stock_etp = new getImageModel();
        $stock_etp->store_image($dossier, $nom_image, $request->file('image')->getContent());

        $entreprise->logo = $nom_image;
        $entreprise->save();
        //envoyer un mail de notification à tous les utilisateurs admin
        $emails = User::where('role_id', '1')->get();
        foreach ($emails as $email) {
            Mail::to($email)->send(new EntrepriseMail());
        }
        return redirect()->route('liste_entreprise');
    }

    public function show($id)
    {
        $datas = entreprise::where('id', $id)->get();
        $entreprise = entreprise::orderBy('nom_etp')->get()->unique('nom_etp');
        return view('admin.entreprise.entreprise', compact('datas', 'entreprise'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $etp = entreprise::with('Secteur')->where('id', $id)->get();
        return response()->json($etp);
    }

    public function update(Request $request)
    {
        $id = $request->id_value;

        //modifier les données
        $nom = $request->nom_etp;
        $adresse = $request->adresse;
        $telephone = $request->phone;
        $mail = $request->mail;
        $NIF = $request->nif;
        $STAT = $request->stat;
        $CIF = $request->cif;
        $RCS = $request->rcs;
        $site = $request->site;
        entreprise::where('id', $id)
            ->update([
                'nom_etp' => $nom,
                'adresse' => $adresse,
                'nif' => $NIF,
                'stat' => $STAT,
                'rcs' => $RCS,
                'cif' => $CIF,
                'email_etp' => $mail,
                'site_etp' => $site,
                'telephone_etp' => $telephone
            ]);
        return redirect()->route('liste_entreprise');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        //  $del = entreprise::where('id', $id)->delete();
        DB::delete('delete from entreprises where id = ?', [$id]);
        return back();
    }

    public function profile_entreprise($id)
    {

        $entreprise = entreprise::with('Secteur')->findOrFail($id);
        $departement = DB::select('select * from departement_entreprises where entreprise_id = ?', [$id]);
        if (Gate::allows('isReferent')) {
        return view('admin.entreprise.profile_entreprise', compact('entreprise', 'departement'));

        }
        else{
            return view('admin.entreprise.profile_entreprises', compact('entreprise', 'departement'));
        }
    }

    public function getImage($path)
    {
        $dossier = 'entreprise';
        $etp = new getImageModel();
        return $etp->get_image($path, $dossier);
    }

    public function affiche_dep(Request $req)
    {
        $fonct = new FonctionGenerique();
        $datas1 = $fonct->findWhere("v_departement", ["entreprise_id"], [$req->id]);
        return response()->json($datas1);
    }
    //modification profil entreprise
    public function modification_email_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_email', compact('etp'));
    }
    public function enregistrer_email_entreprise(Request $request,$id){
        if($request->email == null){
            return redirect()->back()->with('error_email', 'Entrez l\'e-mail de votre entreprise avant de cliquer sur enregistrer');
        }
        else{
        DB::update('update entreprises set email_etp = ? where id = ?', [$request->email,$id]);
        return redirect()->route('aff_parametre_referent',[$id]);
        }
    }
    public function modification_nif_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_nif', compact('etp'));
    }
    public function enregistrer_nif_entreprise(Request $request,$id){
        if($request->nif == null){
            return redirect()->back()->with('erreur_nif', 'Entrez le NIF de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set nif = ? where id = ?', [$request->nif,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
    public function modification_telephone_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_telephone', compact('etp'));
    }

    public function modification_secteur_entreprise($id){
        $fonct = new FonctionGenerique();
        // $secteur = $fonct->findWhereMulitOne("secteurs",["id"],[$id]);
        $secteur = DB::select('select * from secteurs');
        return view('admin.entreprise.modification_profil.edit_secteur', compact('secteur','id'));
    }

    public function get_secteur(Request $req){
        $formtion_id = $req->formation_id;
        $thematique = DB::select('select * from formations where domaine_id = ?', [$formtion_id]);
        return response()->json($thematique);
    }

    public function enregistrer_telephone_entreprise(Request $request,$id){
        if($request->telephone == null){
            return redirect()->back()->with('erreur_telephone', 'Entrez le numéro téléphone de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set telephone_etp = ? where id = ?', [$request->telephone,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }

    public function enregistrer_secteur_entreprise(Request $request,$id){
        // dd($request->secteur);
        if($request->secteur == null){
            return redirect()->back()->with('erreur_secteur', 'choisissez votre secteur avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set secteur_id = ? where id = ?', [$request->secteur,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }

    public function modification_stat_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_stat', compact('etp'));
    }
    public function enregistrer_stat_entreprise(Request $request,$id){
        if($request->stat == null){
            return redirect()->back()->with('erreur_stat', 'Entrez le stat de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set stat = ? where id = ?', [$request->stat,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
    public function modification_rcs_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_rcs', compact('etp'));
    }
    public function enregistrer_rcs_entreprise(Request $request,$id){
        if($request->rcs == null){
            return redirect()->back()->with('erreur_rcs', 'Entrez le rcs de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set rcs = ? where id = ?', [$request->rcs,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }



    public function modification_assujetti_entreprise($id){
        $fonct = new FonctionGenerique();
        $assujetti = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.modification_assujetti_entreprise', compact('assujetti'));
    }

    public function enregistrer_assujetti_entreprise(Request $request,$id){
        $id_assujeti = $request->assujetti;
        if($id_assujeti == null){
            return back()->withErrors("erreur_assujetti", "Choississez vos type d\'impôt de votre entreprise avant de cliquer sur enregistrer");
           }
           else{
            DB::update('update entreprises set assujetti_id = ? where id = ?', [$request->assujetti,$id]);
            // ('insert into values (?, ?)' entreprises set assujeti_id = ? where id = ?', [$request->assujetti,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }


    public function modification_cif_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_cif', compact('etp'));
    }
    public function enregistrer_cif_entreprise(Request $request,$id){
        if($request->cif == null){
            return redirect()->back()->with('erreur_cif', 'Entrez le cif de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set cif = ? where id = ?', [$request->cif,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
    public function modification_adresse_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_adresse', compact('etp'));
    }
    public function enregistrer_adresse_entreprise(Request $request,$id){
        if($request->rue == null || $request->quartier == null || $request->code_postal == null || $request->ville == null || $request->region == null) {
            return back()->with('erreur_adresse','Entrez votre adresse complète avant de cliquer sur enregistrer');
        }
        else{
            DB::update('update entreprises set  adresse_rue = ?,adresse_quartier = ?,adresse_code_postal = ?,adresse_ville = ?,adresse_region = ?
               where id = ?', [$request->rue,$request->quartier,$request->code_postal,$request->ville,$request->region,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
        }
    }
    public function modification_site_etp_entreprise($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_site_etp', compact('etp'));
    }
    public function enregistrer_site_etp_entreprise(Request $request,$id){
        if($request->site_etp == null){
            return redirect()->back()->with('erreur_site_etp', 'Entrez le site web de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set site_etp = ? where id = ?', [$request->site_etp,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
    public function modification_nom_etp($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_nom_etp', compact('etp'));
    }
    public function enregistrer_nom_etp(Request $request,$id){
        if($request->nom_etp == null){
            return redirect()->back()->with('erreur_nom entreprise', 'Entrez le site web de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set nom_etp = ? where id = ?', [$request->nom_etp,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
    public function modification_logo($id){
        $fonct = new FonctionGenerique();
        $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$id]);
        return view('admin.entreprise.modification_profil.edit_logo', compact('etp'));
    }
    public function enregistrer_logo(Request $request,$id){
        $input = $request->image;
        if ($image = $request->file('image')) {
            if($image->getSize() > 1692728 or $image->getSize() == false){
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 1.7 MB');
            }
            else{
            $destinationPath = 'images/entreprises';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                     //imager  resize
                     $image_name = $profileImage ;
                     $destinationPath = public_path('images/entreprises');
                     $resize_image = Image::make($image->getRealPath());
                     $resize_image->resize(256, 128, function($constraint){
                         $constraint->aspectRatio();
                     })->save($destinationPath . '/' .  $image_name);
            // $image->move($destinationPath, $profileImage);
            $input = "$profileImage";
            }
        }
        if($input== null){
            return redirect()->back()->with('erreur_logo', 'Entrez le logo de votre entreprise avant de cliquer sur enregistrer');
           }
           else{
            DB::update('update entreprises set logo  = ? where id = ?', [$input,$id]);
            return redirect()->route('aff_parametre_referent',[$id]);
           }
    }
}

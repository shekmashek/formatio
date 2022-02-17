<?php

namespace App\Http\Controllers;

use App\competenceFormateur;
use App\experienceFormateur;
use Illuminate\Http\Request;
use App\formateur;
use App\responsable;
use App\User;
use App\cfp;
use App\Models\getImageModel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\FonctionGenerique;

class ProfController extends Controller
{

    /*
    $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp",["cfp_id"],[$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);
            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            return view('collaboration.collaboration_cfp', compact('formateur','demmande_formateur','invitation_formateur'));
        }
    */
  /*  public function index($id = null)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp",["cfp_id"],[$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);
             if(count($formateur )<=0){
                return view('admin.formateur.guide');
              }
            else{
                return view('admin.formateur.formateur', compact('formateur'));
                }
        } else {
            $formateur1 = $fonct->findAll("v_demmande_formateur_cfp");
            $formateur2 = $fonct->findAll("v_demmande_cfp_formateur");
            $formateur = $forma->getFormateur($formateur1, $formateur2);
            return view('admin.formateur.formateur', compact('formateur'));
        }
    } */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id = null)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();


        if (Gate::allows('isCFP')) {

            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp",["cfp_id"],[$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);

            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            return view('admin.formateur.formateur', compact('formateur','demmande_formateur','invitation_formateur'));

             if(count($formateur )<=0){
                return view('admin.formateur.guide');
              }
            else{
                return view('admin.formateur.formateur', compact('formateur'));
                }
        } else {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp",["cfp_id"],[$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);

            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            return view('admin.formateur.formateur', compact('formateur','demmande_formateur','invitation_formateur'));
        }
    }

    public function create()
    {
    }
    public function affiche()
    {
        $fonct = new FonctionGenerique();
        $formateur = formateur::all();
        $id = Auth::id();
        $entreprise_id = responsable::where('user_id', $id)->value('entreprise_id');

        $demmande = $fonct->findWhere("v_demmande_collaboration_formateur_etp", ["etp_id"], [$entreprise_id]);
        $invitation = $fonct->findWhere("v_invitation_collaboration_formateur_etp", ["etp_id"], [$entreprise_id]);

        return view('collaboration.formateurs', compact('formateur', 'entreprise_id', 'invitation', 'demmande'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $frm = new formateur();
        $frm->nom_formateur = $request->nom;
        $frm->prenom_formateur = $request->prenom;
        $frm->mail_formateur = $request->mail;
        $frm->numero_formateur = $request->phone;
        $frm->genre = $request->sexe;
        $frm->date_naissance = $request->date_naissance;
        $frm->adresse = $request->adresse;
        $frm->CIN = $request->cin;
        $frm->specialite = $request->specialite;
        $frm->niveau = $request->niveau;

        $date = date('d-m-Y');
        $nom_image = str_replace(' ', '_', $request->nom . '' . $request->phone . '' . $date . '.png');
        $str = 'images/formateurs';

        //stocker logo dans google drive
        $dossier = 'formateur';
        $stock_formateur = new getImageModel();
        $stock_formateur->store_image($dossier,$nom_image,$request->file('image')->getContent());
        // $request->image->move(public_path($str), $nom_image);

        $frm->photos = $nom_image;

        $user = new User();
        $user->name = $request->nom . " " . $request->prenom;
        $user->email = $request->mail;

        $user->cin = $request->cin;
        $user->telephone = $request->phone;

        $ch1 = '0000';
        // $ch2 = substr($request->phone, 8, 2);
        $user->password = Hash::make($ch1);
        $user->role_id = '4';
        $user->save();

        //get user id
        $user_id = User::where('email', $request->mail)->value('id');
        $frm->user_id = $user_id;
        $frm->save();

        $idmail_formateur = formateur::where('mail_formateur', $request->mail)->value('id');

        $input = $request->all();
        for ($i = 0; $i < count($input['domaine']); $i++) {
            $competence = new competenceFormateur();
            $competence->competence = $input['competences'][$i];
            $competence->domaine = $input['domaine'][$i];
            $competence->formateur_id = $idmail_formateur;
            $competence->save();
        }

        for ($i = 0; $i < count($input['entreprise']); $i++) {
            $experience = new experienceFormateur();
            $experience->nom_entreprise = $input['entreprise'][$i];
            $experience->poste_occuper = $input['poste'][$i];
            $experience->debut_travail = $input['date_debut'][$i];
            $experience->fin_travail = $input['date_fin'][$i];
            $experience->taches = $input['taches'][$i];
            $experience->formateur_id = $idmail_formateur;
            $experience->save();
        }
        // return redirect()->route('utilisateur_formateur');
        return back()->with('success', 'success terminer! pour travail avec le nouveaux formateur,vous devrez collaborer');
    }


    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $formateur = formateur::where('id', $id)->get();
        return response()->json($formateur);
    }
    public function editer_photos($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_photos', compact('formateur'));
    }
      public function editer_nom($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_nom', compact('formateur'));
    }
    public function editer_genre($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_genre', compact('formateur'));
    }
    public function editer_naissance($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.editer_naissance', compact('formateur'));
    }
    public function editer_mail($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_mail', compact('formateur'));
    }
    public function editer_phone($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_phone', compact('formateur'));
    }
    public function editer_cin($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_cin', compact('formateur'));
    }
    public function editer_adresse($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_adresse', compact('formateur'));
    }
    public function editer_etp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_etp', compact('formateur'));
    }
    public function editer_niveau($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edit_niveau', compact('formateur'));
    }
    public function editer_pwd($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = formateur::findOrFail($id);
        return view('admin.formateur.edite_pwd', compact('formateur'));
    }

    public function show_formateur(Request $req)
    {
        $id = $req->id;

        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();


        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateur = $forma->getFormateur($formateur1, $formateur2);
        return response()->json($formateur);
    }

    public function update(Request $request)
    {
        $id = $request->id_get;
        $maj = formateur::where('id', $id)->update([
            'nom_formateur' => $request->nom_formateur,
            'prenom_formateur' => $request->prenom_formateur,
            'mail_formateur' => $request->email_formateur,
            'numero_formateur' => $request->phone_formateur,
            'adresse' => $request->adresse_formateur,
            'cin' => $request->cin_formateur,
            'specialite' => $request->specialite_formateur,
            'niveau' => $request->niveau_formateur
        ]);
        return back();
    }

    public function destroy(Request $request)
    {
        $user_id = Auth::user()->id;
        $id_formateur = $request->id_get;

        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            // dd("delete from demmande_cfp_formateur where demmandeur_cfp_id = ".$cfp_id." and inviter_formateur_id=".$id_formateur);
                DB::delete('delete from demmande_cfp_formateur where demmandeur_cfp_id = ? and inviter_formateur_id=?', [$cfp_id, $id_formateur]);
        }

        if (Gate::allows('isSuperAdmin','isAdmin')) {
            DB::beginTransaction();
            try {
                DB::delete('delete from formateurs where id = ?', [$id_formateur]);
                DB::delete('delete from users where id = ?', [$user_id]);
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }
        return back();
    }

    public function desactivation_formateur(Request $req){
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $id_formateur = $req->id_get;
            // DB::update('update demmande_formateur_cfp set activiter = 0 where demmandeur_formateur_id = ? and inviter_cfp_id=?', [$id_formateur, $cfp_id]);
            DB::update('update demmande_cfp_formateur set activiter = 0 where demmandeur_cfp_id = ? and inviter_formateur_id=?', [$cfp_id, $id_formateur]);

        return back();
    }

    public function cvFormateur(Request $request)
    {
        $id = $request->id_formateur;
        $formateur = formateur::where('id', $id)->get();
        $competence = competenceFormateur::where('formateur_id', $id)->get();
        $experience = experienceFormateur::where('formateur_id', $id)->get();
        return view('admin.formateur.profil', compact('formateur', 'competence', 'experience'));
    }
    public function profile_formateur( $id = null )
    {
        $formateur = formateur::findOrFail($id);

        return view('admin.formateur.profile_formateur', compact('formateur'));
    }

    //modification  profil
    public function set_profile_formateur()
    {
        $user = Auth::user()->id;

        $formateur = formateur::where('user_id', $user)->get();
        return view('admin.formateur.profile_formateurs', compact('formateur'));
    }


    public function modif($id, Request $request)
    {

        $id = $request->id;
        $formateur = formateur::FindOrFail($request->id);
        return view('admin.formateur.modification_profil_formateur', compact('formateur'));
    }
    public function misajourFormateur(Request $request,$id)
    {

        // $fonct = new FonctionGenerique();

        // $resp_etp = $fonct->findWhereMulitOne("formateurs",["user_id"],[ Auth::user()->id]);
       // dd( $resp_etp );
        $nom = $request->nom;

        $phone =  $request->phone;
        $mail = $request->mail;
        $cin = $request->cin;
        $datenais = $request->dateNais;
        $input = $request->image;
        $splt = $request->specialite;
        $nv = $request->niveau;
        if ($image = $request->file('image')) {
            $destinationPath = 'images/formateurs';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input= "$profileImage";
        }
        if ($input !=null){
        formateur::where('id',  $id)
            ->update([
                'nom_formateur' => $nom,
                'prenom_formateur' => $request->prenom,
                'numero_formateur' => $phone,
                'mail_formateur' => $mail,
                'cin' => $cin,
                'genre' =>  $request->genre,
                'date_naissance' => $datenais,
                'adresse' => $request->adresse,
                'specialite' => $splt,
                'niveau' => $nv,
                'photos' => $input,
            ]);
        }else{
            formateur::where('id',  $id)
            ->update([
                'nom_formateur' => $nom,
                'prenom_formateur' => $request->prenom,
                'numero_formateur' => $phone,
                'mail_formateur' => $mail,
                'cin' => $cin,
                'genre' =>$request->genre,
                'date_naissance' => $datenais,
                'adresse' => $request->adresse,
                'specialite' => $splt,
                'niveau' => $nv,

            ]);
        }
        $password = $request->password;
        $hashedPwd = Hash::make($password);
        $user = User::where('id', Auth::user()->id)->update([
            'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        ]);
        return redirect()->route('profile_formateur', $id);
    }



    public function affichageFormateur($id)
    {
        $user = Auth::user()->id;
        $formateur = formateur::where('user_id', $user)->get();

        return view('admin.formateur.profile_formateurs', compact('formateur'));
    }
      //fonction récupération photos depuis google drive
    public function getImage($path){
        $dossier = 'formateur';
        $etp = new getImageModel();
        return $etp->get_image($path,$dossier);
    }
}
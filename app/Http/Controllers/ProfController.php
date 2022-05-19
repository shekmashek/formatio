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
use Illuminate\Support\Facades\URL;
use Image;
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
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }
    public function index($id = null)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();
        if (Gate::allows('isCFP')) {

            // $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $cfp_id = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$user_id])->cfp_id;

            // $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
            // $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            // $formateur = $forma->getFormateur($formateur1, $formateur2);
            $formateur = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            // dd($formateur);
            // $formateurs=formateur::findorFail($cfp_id);

            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);

            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);

            return view('admin.formateur.formateur', compact('formateur', 'demmande_formateur', 'invitation_formateur'));

            if (count($formateur) <= 0) {
                return view('admin.formateur.guide');
            } else {
                return view('admin.formateur.formateur', compact('formateur'));
            }
        } else {
            // $cfp_id = cfp::where('user_id', $user_id)->value('id');
            // $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
            // $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            // $formateur = $forma->getFormateur($formateur1, $formateur2);

            // $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            // $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            // return view('admin.formateur.formateur', compact('formateur', 'demmande_formateur', 'invitation_formateur'));
        }
    }
    public function information_formateur(Request $request)
    {
        $fonct = new FonctionGenerique();
        $id = $request->Id;
        // $user_id = Auth::user()->id;
        // dd($user_id);
        // $cfp_id = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$user_id])->cfp_id;

        $formateur = DB::select("select * from v_demmande_cfp_formateur where formateur_id = ?", [$id]);

        return response()->json($formateur);
    }


    //filter formateurs name
    public function filtreProfName(Request $request)
    {
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', [$user_id])->value('id');

        $formateur = DB::table('v_demmande_cfp_formateur')
        ->where('cfp_id', '=', $cfp_id)
        ->where('nom_formateur', 'like', '%'. $request->get('nameFormateur') .'%')
        ->get();

        // dd(json_encode($formateur));
        return json_encode($formateur);
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
        $fonct = new FonctionGenerique();
        /**On doit verifier le dernier abonnement de l'of pour pouvoir limité le formateur à ajouter */
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::id()])->cfp_id;
        $nb_formateur = $this->fonct->findWhere("demmande_cfp_formateur",["demmandeur_cfp_id"],[$cfp_id]);
        $abonnement_cfp =  DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1',[$cfp_id]);

        if($abonnement_cfp[0]->nb_formateur == count($nb_formateur))  return back()->with('error', "Vous avez atteint le nombre maximum de formateur, veuillez upgrader votre compte pour ajouter plus de formateur");
        else{
            $image = $request->file('image');
            if($image != null){

                if($image->getSize() > 1692728 or $image->getSize() == false){
                    return redirect()->back()->with('erreur_photo', 'La taille maximale de la photo doit être de 1.7 MB');
                }
                else{
                    if($request->sexe == "homme") $genre = 2;
                    if($request->sexe == "femme") $genre = 1;
                    if($request->sexe == "null") $genre = null;

                    $frm = new formateur();
                    $frm->nom_formateur = $request->nom;
                    $frm->prenom_formateur = $request->prenom;
                    $frm->mail_formateur = $request->mail;
                    $frm->numero_formateur = $request->phone;
                    $frm->genre_id = $genre;
                    $frm->date_naissance = $request->date_naissance;
                    $frm->adresse = $request->adresse;
                    $frm->CIN = $request->cin;
                    $frm->specialite = $request->specialite;
                    $frm->niveau = $request->niveau;

                    $date = date('d-m-Y');
                    $nom_image = str_replace(' ', '_', $request->nom . '' . $request->phone . '' . $date . '.png');
                    $str = 'images/formateurs';
                    $url_photo = URL::to('/')."/images/formateurs/".$nom_image;

                    //imager  resize

                    $image_name = $nom_image;

                    $destinationPath = public_path('images/formateurs');

                    $resize_image = Image::make($image->getRealPath());

                    $resize_image->resize(228, 128, function($constraint){
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' .  $image_name);
                    // $request->image->move(public_path($str), $nom_image);

                    $frm->photos = $nom_image;
                    // $frm->url_photo = $url_photo;

                    $user = new User();
                    $user->name = $request->nom . " " . $request->prenom;
                    $user->email = $request->mail;

                    $user->cin = $request->cin;
                    $user->telephone = $request->phone;

                    $ch1 = '0000';
                    // $ch2 = substr($request->phone, 8, 2);
                    $user->password = Hash::make($ch1);
                    $user->save();

                    $user_id = $fonct->findWhereMulitOne("users", ["email"], [$request->mail])->id;
                    DB::beginTransaction();
                    try {
                        $fonct->insert_role_user($user_id, "4",true); // formateur
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }

                    //get user id
                    $frm->user_id = $user_id;
                    $frm->save();

                    // $idmail_formateur = formateur::where('mail_formateur', $request->mail)->value('id');
                    $idmail_formateur = $fonct->findWhereMulitOne("formateurs", ["mail_formateur"], [$request->mail])->id;

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
                    if (Gate::allows('isCFP')) {

                        DB::insert("insert into demmande_cfp_formateur(demmandeur_cfp_id,inviter_formateur_id,activiter,created_at,updated_at) values(?,?,true,NOW(),NOW())", [$cfp_id, $idmail_formateur]);
                    }
                //   $request->image->move(public_path('images/formateurs'), $nom_image);  //save image cfp

                    // return redirect()->route('utilisateur_formateur');
                    return back()->with('success', 'Formateur ajouté avec succès!');
                }
            }
        }

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
    public function editer_photos($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur =DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_photos', compact('formateur'));
    }
    public function editer_nom($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_nom', compact('formateur'));
    }
    public function editer_genre($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_genre', compact('formateur'));
    }
    public function editer_naissance($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.editer_naissance', compact('formateur'));
    }
    public function editer_mail($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_mail', compact('formateur'));
    }
    public function editer_phone($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_phone', compact('formateur'));
    }
    public function editer_cin($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_cin', compact('formateur'));
    }
    public function editer_adresse($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_adresse', compact('formateur'));
    }
    public function editer_etp($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_etp', compact('formateur'));
    }
    public function editer_niveau($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
        return view('admin.formateur.edit_niveau', compact('formateur'));
    }
    public function editer_competence($id, Request $request)
    {
        // $user_id =  $users = Auth::user()->id;
        // $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = competenceFormateur::findOrFail($id);
        //dd($formateur);
        return view('admin.formateur.edit_comp', compact('formateur'));
    }
    public function editer_domaine($id, Request $request)
    {
        // $user_id =  $users = Auth::user()->id;
        // $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = competenceFormateur::findOrFail($id);
        //dd($formateur);
        return view('admin.formateur.edit_domaine', compact('formateur'));
    }
    public function editer_poste($id, Request $request)
    {
        // $user_id =  $users = Auth::user()->id;
        // $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = experienceFormateur::findOrFail($id);
        //dd($formateur);
        return view('admin.formateur.edit_poste', compact('formateur'));
    }
    public function editer_nom_etp($id, Request $request)
    {
        // $user_id =  $users = Auth::user()->id;
        // $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = experienceFormateur::findOrFail($id);
        //dd($formateur);
        return view('admin.formateur.edit_nom_etp', compact('formateur'));
    }
    public function editer_fonction($id, Request $request)
    {
        // $user_id =  $users = Auth::user()->id;
        // $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = experienceFormateur::findOrFail($id);
        //dd($formateur);
        return view('admin.formateur.edit_fonct', compact('formateur'));
    }

    public function editer_pwd($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $formateur_connecte = formateur::where('user_id', $user_id)->exists();
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where id = ?',[$id])[0];
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

    public function update_mdp_formateur($id,Request $request){
        $users =  db::select('select * from users where id = ?', [Auth::id()]);
        $pwd = $users[0]->password;
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->get('ancien_password'), $pwd)) {
            DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
                   return redirect()->route('profile_formateur', $id);

        } else {
            return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
        }
    }
    public function update_email_formateur($id,Request $request){
        DB::update('update users set email = ? where id = ?', [$request->mail, Auth::id()]);
        DB::update('update formateurs set mail_formateur = ? where user_id = ?', [$request->mail, Auth::id()]);
        return redirect()->route('profile_formateur', $id);

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

        if (Gate::allows('isSuperAdmin', 'isAdmin')) {
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

    public function desactivation_formateur(Request $req)
    {
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
        if ($formateur[0]->genre_id == 1) $genre = "Femme";
        if ($formateur[0]->genre_id == 2) $genre = "Homme";
        if ($formateur[0]->genre_id == null) $genre = " ";
        $competence = competenceFormateur::where('formateur_id', $id)->get();
        $experience = experienceFormateur::where('formateur_id', $id)->get();
        return view('admin.formateur.profil', compact('formateur', 'competence', 'experience','genre'));
    }

    public function cvProf(Request $request,$id)
    {

        $id = formateur::where('user_id', $id)->value('id');
        $formateur = formateur::where('id', $id)->get();
        $competence = competenceFormateur::where('formateur_id', $id)->get();
        $experience = experienceFormateur::where('formateur_id', $id)->get();
        return view('admin.formateur.CV', compact('formateur', 'competence', 'experience'));
    }
    public function profile_formateur($id = null)
    {
        // $user_id =  $users = Auth::user()->id;
         if (Gate::allows('isFormateur')){
            $id = formateur::where('user_id', Auth::user()->id)->value('id');
            $competence = competenceFormateur::where('formateur_id', $id)->get();
            $experience = experienceFormateur::where('formateur_id', $id)->get();
            $formateur = formateur::findOrFail($id);
            if($formateur->genre_id == 1) $genre = "Femme";
            if($formateur->genre_id == 2) $genre = "Homme";
            if($formateur->genre_id == null) $genre = " ";
            return view('admin.formateur.profile_formateur', compact('formateur','genre','competence','experience'));
         }
         else{
            $formateur = formateur::findOrFail($id);
            $initial_formateur = DB::select('select SUBSTRING(nom_formateur, 1, 1) AS nm,  SUBSTRING(prenom_formateur, 1, 1) AS pr from formateurs where id =  ?', [$id ]);

            $competence = competenceFormateur::where('formateur_id', $id)->get();
            $experience = experienceFormateur::where('formateur_id', $id)->get();
            if($formateur->genre_id == 1) $genre = "Femme";
            if($formateur->genre_id == 2) $genre = "Homme";
            if($formateur->genre_id == null) $genre = " ";
            return view('profil_public.formateur', compact('initial_formateur','formateur','genre','competence','experience'));

         }


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
    public function update_experience(Request $request, $id)

    {
        experienceFormateur::where('id',$id)
        ->update([
            'nom_entreprise'=>$request->nom_etp,
            'poste_occuper'=>$request->poste,
            'taches'=>$request->tache
        ]);
        return redirect()->route('profile_formateur', $id);

    }
    public function update_domaine(Request $request, $id)
    {

        competenceFormateur::where('id',  $id)
                ->update([
                    'competence'=>$request->competence,
                    'domaine'=>$request->domaine]);
        return redirect()->route('profile_formateur', $id);
    }

    public function misajourFormateur(Request $request, $id)
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
            if($image->getSize() > 1692728 or $image->getSize() == false){
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 1.7 MB');
            }
            else{
            $destinationPath = 'images/formateurs';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
             //imager  resize

             $image_name = $profileImage ;

             $destinationPath = public_path('images/formateurs');

             $resize_image = Image::make($image->getRealPath());

             $resize_image->resize(228,128, function($constraint){
                 $constraint->aspectRatio();
             })->save($destinationPath . '/' .  $image_name);
            $input = "$profileImage";
        }
    }
        if ($input != null) {


            formateur::where('id',  $id)
                ->update([
                    'nom_formateur' => $nom,
                    'prenom_formateur' => $request->prenom,
                    'numero_formateur' => $phone,
                    'mail_formateur' => $mail,
                    'cin' => $cin,
                    'genre_id' =>  $request->genre,
                    'date_naissance' => $datenais,
                    'adresse' => $request->adresse,
                    'specialite' => $splt,
                    'niveau' => $nv,
                    'photos' => $input,
                ]);
            }
         else {
            formateur::where('id',  $id)
                ->update([
                    'nom_formateur' => $nom,
                    'prenom_formateur' => $request->prenom,
                    'numero_formateur' => $phone,
                    'mail_formateur' => $mail,
                    'cin' => $cin,
                    'genre_id' => $request->genre,
                    'date_naissance' => $datenais,
                    'adresse' => $request->adresse,
                    'specialite' => $splt,
                    'niveau' => $nv,

                ]);
        }
        // $password = $request->password;
        // $hashedPwd = Hash::make($password);
        // $user = User::where('id', Auth::user()->id)->update([
        //     'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        // ]);
        return redirect()->route('profile_formateur', $id);
    }



    public function affichageFormateur($id)
    {
        $user = Auth::user()->id;
        $formateur = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end genre from formateurs where user_id = ?',[$user]);

        return view('admin.formateur.profile_formateurs', compact('formateur'));
    }
    //fonction récupération photos depuis google drive
    public function getImage($path)
    {
        $dossier = 'formateur';
        $etp = new getImageModel();
        return $etp->get_image($path, $dossier);
    }
}

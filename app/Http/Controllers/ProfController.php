<?php

namespace App\Http\Controllers;

use App\competenceFormateur;
use App\experienceFormateur;
use Illuminate\Http\Request;
use App\formateur;
use App\responsable;
use App\User;
use App\cfp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class ProfController extends Controller
{

    public function index($id = null)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();


        if (Gate::allows('isCFP')) {

            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
            
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
        $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom . '' . $date . '.png');
        $str = 'images/formateurs';
        $request->image->move(public_path($str), $nom_image);

        $frm->photos = $nom_image;

        $user = new User();
        $user->name = $request->nom . " " . $request->prenom;
        $user->email = $request->mail;
        $ch1 = $request->nom;
        $ch2 = substr($request->phone, 8, 2);
        $user->password = Hash::make($ch1 . $ch2);
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
            DB::beginTransaction();
            try {
                DB::delete('delete from demmande_formateur_cfp where demmandeur_formateur_id = ? and inviter_cfp_id=?', [$id_formateur, $cfp_id]);
                DB::delete('delete from demmande_cfp_formateur where demmandeur_cfp_id = ? and inviter_formateur_id=?', [$cfp_id, $id_formateur]);
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }

        if (Gate::allows('isSuperAdmin','isAdmin')) {
            DB::beginTransaction();
            try {
                DB::delete('delete from formateurs where id = ?', [$id_formateur]);
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
            DB::update('update demmande_formateur_cfp set activiter = 0 where demmandeur_formateur_id = ? and inviter_cfp_id=?', [$id_formateur, $cfp_id]);
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
    public function profile_formateur($id)
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
    public function misajourFormateur(Request $request, $id)
    {

        $nom = $request->nom;
        $prenom = $request->prenom;
        $phone =  $request->phone;
        $mail = $request->mail;
        $cin = $request->cin;
        $genre = $request->genre;
        $datenais = $request->dateNais;
        $adr = $request->adresse;
        $splt = $request->specialite;
        $nv = $request->niveau;

        formateur::where('id', $id)
            ->update([
                'nom_formateur' => $nom,
                'prenom_formateur' => $prenom,
                'numero_formateur' => $phone,
                'mail_formateur' => $mail,
                'cin' => $cin,
                'genre' => $genre,
                'date_naissance' => $datenais,
                'adresse' => $adr,
                'specialite' => $splt,
                'niveau' => $nv,
            ]);

        $password = $request->password;
        $hashedPwd = Hash::make($password);
        $user = User::where('id', Auth::user()->id)->update([
            'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        ]);
        return redirect()->route('affichageFormateur', $id);
    }



    public function affichageFormateur($id)
    {
        $user = Auth::user()->id;
        $formateur = formateur::where('user_id', $user)->get();

        return view('admin.formateur.profile_formateurs', compact('formateur'));
    }
}

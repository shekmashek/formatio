<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\responsable;
use App\Mail\entrepriseMail;
use Illuminate\Support\Facades\Auth;
use App\cfp;
use App\ResponsableCfpModel;
use App\Models\FonctionGenerique;
use App\Models\getImageModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\projet;
use Image;

class CfpController extends Controller
{
    public function __construct()
    {
        $this->fonct  = new FonctionGenerique();

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user_id = Auth::id();

        $fonct = new FonctionGenerique();

        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');

        $refuse_demmande_cfp = $fonct->findWhere("v_refuse_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
        $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]);
        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
        $cfp = $fonct->concatTwoList($etp1Collaborer, $etp2Collaborer);
        $abonnement_etp = DB::select('select v_tep.nom_type,v_tep.type_abonnements_etp_id from v_type_abonnement_etp v_tep JOIN entreprises as etp on v_tep.entreprise_id = etp.id where v_tep.entreprise_id = ? and etp.statut_compte_id = ? or etp.statut_compte_id = ?',[$entreprise_id,1,3]);
        // dd($invitation);

        //$cfp=DB::select('select logo_cfp,nom,cfp_id,photos_resp_cfp,nom_resp_cfp,prenom_resp_cfp ,SUBSTRING(prenom_resp_cfp, 1, 1) AS pr, SUBSTRING(nom_resp_cfp, 1, 1) AS nm from v_demmande_etp_cfp where entreprise_id=?',[$entreprise_id]);
        return view('cfp.cfp', compact('cfp', 'refuse_demmande_cfp', 'invitation','abonnement_etp'));
    }


    public function affInfoOf(Request $request)
    {
        $id = $request->Id;
        $fonct = new FonctionGenerique();
        $cfp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$id]);
        $cfp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$id]);
        $ccfp = $fonct->concatTwoList($cfp1, $cfp2);
      //  $ccfp = DB::select('select * from v_demmande_cfp_etp where entreprise_id = ?', [$entreprise_id]);
        return response()->json($ccfp);
    }

    public function img_cfp($logo_cfp)
    {
        $get_img = new getImageModel();
        $dossier = 'entreprise';
        return $get_img->get_image($logo_cfp, $dossier);
    }
    //modification du profil
    public function edit_logo($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_photo', compact('cfp'));
    }
    public function edit_nom($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_nom', compact('cfp'));
    }
    public function edit_adresse($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_adresse', compact('cfp'));
    }

    public function edit_assujetti_cfp($id, Request $request)
    {
        $cfp_assujetti = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        // dd($cfp_assujetti);
        return view('cfp.modification_profil.modification_assujetti_cfp', compact('cfp_assujetti'));
    }

    public function enregistrer_assujetti_cfp(Request $request, $id)
    {
        $id_assujeti = $request->assujetti;
        // dd($id_assujeti);
        if ($id_assujeti == null) {
            return back()->withErrors("erreur_assujetti", "Choississez vos type d'assujetti à la TVA de votre entreprise avant de cliquer sur enregistrer");
        } else {
            DB::update('update entreprises set assujetti_id = ? where id = ?', [$request->assujetti, $id]);
            // ('insert into values (?, ?)' entreprises set assujeti_id = ? where id = ?', [$request->assujetti,$id]);
            return redirect()->route('profil_of', [$id]);
        }
    }

    public function edit_email($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_email', compact('cfp'));
    }
    public function edit_telephone($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_email', compact('cfp'));
    }
    public function edit_slogan($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_slogan', compact('cfp'));
    }
    public function edit_site($id, Request $request)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        return view('cfp.modification_profil.edit_site', compact('cfp', 'id'));
    }
    public function edit_mail($id, Request $request)
    {
        $url_previous = str_replace(url('/'), '', url()->previous());
        if($url_previous == "/affichage_parametre_cfp") {
            $test = "cfp";
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        }
        elseif($url_previous == "/profil_du_responsable") {
            $test = "referent";
            $ref = $this->fonct->findWhereMulitOne("responsables_cfp",["id"],[$id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$ref]);
        }




        return view('cfp.modification_profil.edit_mail', compact('cfp', 'id'));
    }
    public function edit_phone($id, Request $request)
    {
        $url_previous = str_replace(url('/'), '', url()->previous());
        if($url_previous == "/affichage_parametre_cfp") {
            $test = "cfp";
         $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        }
        if($url_previous == "/profil_du_responsable") {
            $test = "referent";
            $ref = $this->fonct->findWhereMulitOne("responsables_cfp",["id"],[$id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$ref]);
        }

        return view('cfp.modification_profil.edit_phone', compact('cfp', 'id','test'));
    }

    public function edit_horaire($id)
    {
        $cfp = $this->fonct->findWhere(" v_horaire_cfp", ["cfp_id"], [$id]);
        return view('cfp.modification_profil.edit_horaire', compact('cfp', 'id'));
    }

    public function edit_nif($id, Request $request){
        $nif = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.modification_nif',compact('nif'));
    }


    public function edit_stat($id, Request $request){
        $stat = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.modification_stat',compact('stat'));
    }

    public function edit_rcs($id, Request $request){
        $rcs = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.modification_rcs',compact('rcs'));
    }

    public function edit_cif($id, Request $request){
        $cif = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.modification_cif',compact('cif'));
    }

    public function modifier_logo($id, Request $request)
    {
        $image = $request->file('image');
        if($image != null){
            if($image->getSize() > 1692728 or $image->getSize() == false){
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 1.7 MB');
            }
            else{

                    $cfp = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
                    $image_ancien = $cfp->logo;
                    //supprimer l'ancienne image
                    File::delete(public_path("images/CFP/".$image_ancien));
                    //enregiistrer la nouvelle photo
                    $nom_image = str_replace(' ', '_', $request->nom . '.' . $request->image->extension());
                    $destinationPath = 'images/CFP';
                    //imager  resize

                $image_name = $nom_image;

                $destinationPath = public_path('images/CFP');

                $resize_image = Image::make($image->getRealPath());

                $resize_image->resize(256, 128, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' .  $image_name);
                    // $image->move($destinationPath, $nom_image);
                    //onn modifie ainsi l'url
                    $url_logo = URL::to('/')."/images/CFP/".$nom_image;

                    DB::update('update entreprises set logo = ?,url_logo = ? where id = ?', [$nom_image,$url_logo,$id]);
                                return redirect()->route('profil_of', [$id]);


                 }
            }
            else{
                return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
            }
    }
    // public function modifier_nom($id,Request $request){
    //    if($request->nom == null){
    //     return redirect()->back()->with('error_nom', 'Entrez le nom de votre organisme avant de cliquer sur enregistrer');
    //    }
    //    else{
    //     DB::update('update cfps set nom = ?, slogan = ? where id = ?', [$request->nom,$request->slogan,$id]);
    //                 return redirect()->route('profil_of', [$id]);

    //    }

    // }
    // public function c($id,Request $request){
    //     if($request->mail == null){
    //      return redirect()->back()->with('error_email', 'Entrez email de votre organisme avant de cliquer sur enregistrer');
    //     }
    // }
    public function modifier_nom($id, Request $request)
    {
        if ($request->nom == null) {
            return redirect()->back()->with('error_nom', 'Entrez le nom de votre organisme avant de cliquer sur enregistrer');
        } else {
            DB::update('update entreprises set nom_etp = ?, slogan = ? where id = ?', [$request->nom,$request->slogan, $id]);
            return redirect()->route('profil_of', [$id]);
        }
    }
    public function modifier_mail($id, Request $request)
    {

        if ($request->mail == null) {
            return redirect()->back()->with('error_email', 'Entrez email de votre organisme avant de cliquer sur enregistrer');
        } else {
            //si le responsable connecté est le responsable principal, c-a-d a comme priorité 1, alors son email est le même que l'email de l'OF
            $priorite = $this->fonct->findWhereMulitOne("employers",["user_id"],[Auth::user()->id]);
            if($priorite->prioriter == 1){
                DB::update('update entreprises set email_etp = ? where id = ?', [$request->mail, $id]);
                DB::update('update users set email = ? where id = ?',[$request->mail,Auth::user()->id]);
                DB::update('update employers set email_emp = ? where user_id = ?',[$request->mail,Auth::user()->id]);
            }
            else  DB::update('update employers set email_emp = ? where user_id = ?',[$request->mail,Auth::user()->id]);
        }
        if(isset($request->resp)) return redirect()->route('profil_du_responsable');
        else    return redirect()->route('profil_of', [$id]);
    }
    public function modifier_phone($id, Request $request)
    {

        if ($request->phone == null) {
            return back()->with('error_phone', 'Entrez téléphone de votre organisme avant de cliquer sur enregistrer');
        } else {
            $resp_id = $this->fonct->findWhere("employers",["entreprise_id"],[$id]);
            for ($i=0; $i < count($resp_id); $i++) {
                DB::update('update employers set telephone_emp = ? where id = ? and prioriter = 1', [$request->phone, $resp_id[$i]->id]);
            }
            DB::update('update entreprises set telephone_etp = ? where id = ?', [$request->phone, $id]);
            DB::update('update users set telephone = ? where id = ?', [$request->phone, Auth::user()->id]);
            if($request->modification == "cfp")     return redirect()->route('profil_of', [$id]);
            else return redirect()->route('profil_du_responsable');

        }
    }
    public function modifier_adresse($id, Request $request)
    {

        DB::update('update entreprises set adresse_rue = ?, adresse_quartier = ?, adresse_code_postal = ?, adresse_ville = ?, adresse_region = ? where id = ?', [$request->lot, $request->quartier, $request->code_postal, $request->ville, $request->region, $id]);
        return redirect()->route('profil_of', [$id]);
    }
    // public function modifier_slogan($id, Request $request)
    // {
    //     if ($request->slogan == null) {
    //         return redirect()->back()->with('error_slogan', 'Entrez le slogan de votre organisme avant de cliquer sur enregistrer');
    //     } else {
    //         DB::update('update cfps set slogan = ? where id = ?', [$request->slogan, $id]);
    //         return redirect()->route('profil_of', [$id]);
    //     }
    // }
    public function modifier_site($id, Request $request)
    {
        if ($request->site == null) {
            return redirect()->back()->with('error_site', 'Entrez le site de votre organisme avant de cliquer sur enregistrer');
        } else {
            DB::update('update cfps set site_web = ? where id = ?', [$request->site, $id]);
            return redirect()->route('profil_of', [$id]);
        }
    }
    //ajout horaire d'ouverture
    public function ajout_horaire(Request $request, $id)
    {
        $input = $request->all();
        for ($i = 0; $i < count($input['jour']); $i++) {
            DB::insert('insert into horaires (jours, h_entree,h_sortie,cfp_id) values (?, ?,?,?)', [$input['jour'][$i], $input['ouverture'][$i], $input['fermeture'][$i], $id]);
        }
        return redirect()->route('profil_of', [$id]);
    }
    //modifier l'horaire
    public function modification_horaire(Request $request, $id)
    {
        DB::delete('delete from horaires where cfp_id = ?', [$id]);
        $input = $request->all();
        for ($i = 0; $i < count($input['jour']); $i++) {
            DB::insert('insert into horaires (jours, h_entree,h_sortie,cfp_id) values (?, ?,?,?)', [$input['jour'][$i], $input['ouverture'][$i], $input['fermeture'][$i], $id]);
        }
        return redirect()->route('profil_of', [$id]);
    }

    public function modifier_nif($id,Request $request){
        DB::update('update entreprises set nif = ? where id = ?', [$request->nif, $id]);
                    return redirect()->route('profil_of', [$id]);

    }


    public function modifier_stat($id, Request $request){
        DB::update('update entreprises set stat = ? where id = ?', [$request->stat, $id]);
                    return redirect()->route('profil_of', [$id]);

    }

    public function modifier_rcs($id, Request $request){
        DB::update('update entreprises set rcs = ? where id = ?', [$request->rcs, $id]);
                    return redirect()->route('profil_of', [$id]);

    }

    public function modifier_cif($id, Request $request){
        DB::update('update cfps set cif = ? where id = ?', [$request->cif, $id]);
                    return redirect()->route('profil_of', [$id]);

    }

    public function lien_facebook($id)
    {
        $lien = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        return view('cfp.modification_profil.edit_facebook', compact('id', 'lien'));
    }
    public function lien_twitter($id)
    {
        $lien = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        return view('cfp.modification_profil.edit_twitter', compact('id', 'lien'));
    }
    public function lien_instagram($id)
    {
        $lien = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        return view('cfp.modification_profil.edit_instagram', compact('id', 'lien'));
    }
    public function lien_linkedin($id)
    {
        $lien = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        return view('cfp.modification_profil.edit_linkedin', compact('id', 'lien'));
    }
    //ajout lien facebook
    public function ajout_facebook(Request $request, $id)
    {
        $fb = $request->facebook;
        $test = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        if ($fb != null) {
            if ($test == null) {
                DB::insert('insert into reseaux_sociaux (lien_facebook,cfp_id) values (?,?)', [$fb, $id]);
                return redirect()->route('profil_of', [$id]);
            } else {
                DB::update('update reseaux_sociaux set lien_facebook = ? where cfp_id = ?', [$fb, $id]);
                return redirect()->route('profil_of', [$id]);
            }
        } else {
            return redirect()->back()->with('erreur_reseau', 'Ajouter votre lien facebook avant de cliquer sur Enregistrer');
        }
    }
    //ajout lien twitter
    public function ajout_twitter(Request $request, $id)
    {
        $twitter = $request->twitter;
        $test = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        if ($twitter != null) {
            if ($test == null) {
                DB::insert('insert into reseaux_sociaux ( lien_twitter,cfp_id) values (?, ?)', [$twitter, $id]);
                return redirect()->route('profil_of', [$id]);
            } else {
                DB::update('update reseaux_sociaux set lien_twitter= ? where cfp_id = ?', [$twitter, $id]);
                return redirect()->route('profil_of', [$id]);
            }
        } else {
            return redirect()->back()->with('erreur_reseau', 'Ajouter votre lien twitter avant de cliquer sur Enregistrer');
        }
    }
    //ajout lien instagram
    public function ajout_instagram(Request $request, $id)
    {
        $instagram = $request->instagram;
        $test = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        if ($instagram != null) {
            if ($test == null) {
                DB::insert('insert into reseaux_sociaux (lien_instagram,cfp_id) values (?, ?) ', [$instagram, $id]);
                return redirect()->route('profil_of', [$id]);
            } else {
                DB::update('update reseaux_sociaux set lien_instagram= ? where cfp_id = ?', [$instagram, $id]);
                return redirect()->route('profil_of', [$id]);
            }
        } else {
            return redirect()->back()->with('erreur_reseau', 'Ajouter votre lien instagram avant de cliquer sur Enregistrer');
        }
    }
    //ajout lien linkedin
    public function ajout_linkedin(Request $request, $id)
    {
        $linkedin = $request->linkedin;
        $test = DB::select('select * from reseaux_sociaux where cfp_id = ?', [$id]);
        if ($linkedin != null) {
            if ($test == null) {
                DB::insert('insert into reseaux_sociaux (lien_linkedin,cfp_id) values (?, ?) where cfp_id = ?', [$linkedin, $id]);
                return redirect()->route('profil_of', [$id]);
            } else {
                DB::update('update reseaux_sociaux set lien_linkedin =? where cfp_id = ?', [$linkedin, $id]);
                return redirect()->route('profil_of', [$id]);
            }
        } else {
            return redirect()->back()->with('erreur_reseau', 'Ajouter votre lien likedinn avant de cliquer sur Enregistrer');
        }
    }
}

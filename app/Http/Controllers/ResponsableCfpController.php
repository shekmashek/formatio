<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\cfp;
use App\responsable_cfp;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
use App\ResponsableCfpModel;
use App\responsable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Image;

class ResponsableCfpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }


    public function affReferent($id = null)
    {
        $fonct = new FonctionGenerique();

        if (Gate::allows('isCFP')) {
            if ($id!=null) {
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["id"],[$id]);
            }
            else{
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id]);
                $cfps = $fonct->findWhereMulitOne("cfps",["id"],[$refs->cfp_id]);
                $modules_counts = $fonct->findWhere("modules",["cfp_id"],[$refs->cfp_id]);
                $projets_counts = $fonct->findWhere("projets",["cfp_id"],[$refs->cfp_id]);
                $factures_counts = $fonct->findWhere("factures",["cfp_id"],[$refs->cfp_id]);
                $formateurs_counts = $fonct->findWhere("demmande_cfp_formateur",["demmandeur_cfp_id","activiter"],[$refs->cfp_id,1]);
                $entreprises_counts = $fonct->findWhere("demmande_cfp_etp",["demmandeur_cfp_id","activiter"],[$refs->cfp_id,1]);
                $projetInter_counts = $fonct->findWhere("projets",["cfp_id","type_formation_id"],[$refs->cfp_id,2]);
                $projetIntra_counts = $fonct->findWhere("projets",["cfp_id","type_formation_id"],[$refs->cfp_id,1]);
                $sessions_counts = DB::select('select grp.id from groupes as grp join projets as prj on grp.projet_id = prj.id where prj.cfp_id = ?',[$refs->cfp_id]);
                $horaire = $fonct->findWhere("v_horaire_cfp",["cfp_id"],[$refs->cfp_id]);
                $reseaux_sociaux = $fonct->findWhere("reseaux_sociaux",["cfp_id"],[$refs->cfp_id]);
            }
            return view('cfp.responsable_cfp.profile', compact('refs','cfps','horaire','reseaux_sociaux','modules_counts','projets_counts','sessions_counts','factures_counts','projetInter_counts','projetIntra_counts','formateurs_counts','entreprises_counts'));

        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') ) {
            $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["id"],[$id]);
            return view('cfp.responsable_cfp.profile', compact('refs'));

        }

    }


    public function affParametre_cfp($id = null)
    {
        $fonct = new FonctionGenerique();

        if (Gate::allows('isCFP')) {
            if ($id != null) {
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["id"],[$id]);
                return view('cfp.responsable_cfp.affParametre_cfp', compact('refs'));
            }
            else{
                $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id]);
                $cfps = $fonct->findWhereMulitOne("cfps",["id"],[$refs->cfp_id]);
                $modules_counts = $fonct->findWhere("modules",["cfp_id"],[$refs->cfp_id]);
                $projets_counts = $fonct->findWhere("projets",["cfp_id"],[$refs->cfp_id]);
                $factures_counts = $fonct->findWhere("factures",["cfp_id"],[$refs->cfp_id]);
                $formateurs_counts = $fonct->findWhere("demmande_cfp_formateur",["demmandeur_cfp_id","activiter"],[$refs->cfp_id,1]);
                $entreprises_counts = $fonct->findWhere("demmande_cfp_etp",["demmandeur_cfp_id","activiter"],[$refs->cfp_id,1]);
                $projetInter_counts = $fonct->findWhere("projets",["cfp_id","type_formation_id"],[$refs->cfp_id,2]);
                $projetIntra_counts = $fonct->findWhere("projets",["cfp_id","type_formation_id"],[$refs->cfp_id,1]);
                $sessions_counts = DB::select('select grp.id from groupes as grp join projets as prj on grp.projet_id = prj.id where prj.cfp_id = ?',[$refs->cfp_id]);
                $horaire = $fonct->findWhere("v_horaire_cfp",["cfp_id"],[$refs->cfp_id]);
                $reseaux_sociaux = $fonct->findWhere("reseaux_sociaux",["cfp_id"],[$refs->cfp_id]);
                $tva = DB::select('select * from taxes where id = ?', [1]);
            }
            // dd($cfps);
            return view('cfp.responsable_cfp.affParametre_cfp', compact('refs','cfps','horaire','reseaux_sociaux','modules_counts','projets_counts','sessions_counts','factures_counts','projetInter_counts','projetIntra_counts','formateurs_counts','entreprises_counts','tva'));

        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') ) {

            $refs = $fonct->findWhereMulitOne("v_responsable_cfp",["id"],[$id]);
            $cfp_id=cfp::where('id',$id)->value('id');
            // dd($cfp_id);
            $abonnement = $fonct->findWhere("v_abonnement_facture",["cfp_id"],[$cfp_id]);

            // dd($cfp_id);
            // $responsables_cfp = $this->fonct->findWhere("v_responsable_cfp ", ["prioriter"], ["0"], ["cfp_id"], [$cfp_id]);
            $responsables=responsable_cfp::where('cfp_id',$cfp_id)->where('prioriter',0)->get();
            // dd($responsables);
            $horaire = $fonct->findWhere("v_horaire_cfp",["cfp_id"],[$refs->cfp_id]);
            $reseaux_sociaux = $fonct->findWhere("reseaux_sociaux",["cfp_id"],[$refs->cfp_id]);
            return view('cfp.responsable_cfp.profile_cfp', compact('refs','horaire','reseaux_sociaux','responsables','abonnement'));
        }

    }

    public function index()
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        if (Gate::allows('isCFP')) {
            $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
            // $responsable = DB::select("select * from responsables_cfp where cfp_id=? and id!=?", [$resp_cfp_connecter->cfp_id, $resp_cfp_connecter->id]);
            $responsable = DB::select('select SUBSTRING(nom_resp_cfp, 1, 1) AS nom,  SUBSTRING(prenom_resp_cfp, 1, 1) AS pr, id,nom_resp_cfp, prenom_resp_cfp, email_resp_cfp, telephone_resp_cfp, fonction_resp_cfp, adresse_lot, adresse_quartier, adresse_code_postal, adresse_ville, adresse_region, photos_resp_cfp, cfp_id, user_id, activiter, prioriter, url_photo from responsables_cfp where cfp_id=? and id=?', [$resp_cfp_connecter->cfp_id, $resp_cfp_connecter->id]);
            // dd($responsable);
            return view('cfp.responsable_cfp.nouveau_responsable', compact('resp_cfp_connecter', 'responsable'));
        }
    }

    public function create()
    {
        //
    }



    public function listeEquipeAdminCFP(Request $request) {
        $fonct = new FonctionGenerique();
        $user_id = Auth::id();
        if (Gate::allows('isCFP')){
            $resp_connecte = $fonct->findWhereMulitOne('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp_connecte->cfp_id;
            $cfp = DB::select('select SUBSTRING(nom_resp_cfp, 1, 1) AS nom,  SUBSTRING(prenom_resp_cfp, 1, 1) AS pr, id,nom_resp_cfp, prenom_resp_cfp, email_resp_cfp, telephone_resp_cfp, fonction_resp_cfp, adresse_lot, adresse_quartier, adresse_code_postal, adresse_ville, adresse_region, photos_resp_cfp, cfp_id, user_id, activiter, prioriter, url_photo from responsables_cfp where cfp_id = ?' , [$cfp_id]);
            $cfpPrincipale = DB::select('select * from responsables_cfp where prioriter = 1');
            // $cfpPrincipal = DB::select('select * from responsables_cfp where activiter = 0');
            return view('cfp.responsable_cfp.liste_equipe_admin_cfp', compact('cfp','resp_connecte','cfpPrincipale'));
        }
    }

    public function modifReferent(Request $request){
        // dd($request->all());
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [Auth::id()])->cfp_id;
        DB::update('update responsables_cfp set prioriter = 0 where cfp_id = ?',[$cfp_id]);
        DB::update('update responsables_cfp set prioriter = 1 where cfp_id = ? and id = ?', [$cfp_id,$request->id_resp]);
        return back();
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        $resp = new ResponsableCfpModel();
        $user = new User();

        $user_id = Auth::id();
        if (Gate::allows('isCFP')) {
            $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
            /**On doit verifier le dernier abonnement de l'of pour pouvoir limité l'utilisateur à ajouter */
            $nb_referent = $this->fonct->findWhere("responsables_cfp",["cfp_id"],[$resp_cfp_connecter->cfp_id]);
            $abonnement_cfp =  DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1',[$resp_cfp_connecter->cfp_id]);
            if($abonnement_cfp[0]->nb_utilisateur == count($nb_referent) &&  $abonnement_cfp[0]->illimite == 0)  return back()->with('error', "Vous avez atteint le nombre maximum d'utilisateur, veuillez upgrader votre compte pour ajouter plus d'utilisateurs");
            else{
                if ($resp_cfp_connecter->prioriter == 1) {
                    $resp->verify_form($request);

                    $verify_cin = $resp->verify_cin($request->cin);
                    $verify_email = $fonct->findWhere("users", ["email"], [$request->email]);
                    $verify_phone = $fonct->findWhere("users", ["telephone"], [$request->phone]);

                    // $doner["cin"] = $resp->concat_nb_cin($request->input());
                    $doner["cin"] = $request->cin;
                    $doner["nom"] = $request->nom;
                    $doner["prenom"] = $request->prenom;
                  //  $doner["sexe"] = $request->sexe;
                  //  $doner["dte"] = $request->dte;
                    $doner["email"] = $request->email;
                    $doner["phone"] = $request->phone;
                    $doner["fonction"] = $request->fonction;

                    if (count($verify_cin) > 0) {
                        return back()->with('error', 'cin existe déjà');
                    } else {
                        if (count($verify_email) > 0) {
                            return back()->with('error', 'mail existe déjà');
                        } else {
                            if (count($verify_phone) > 0) {
                                return back()->with('error', 'télephone existe déjà');
                            } else {
                                $user->name = $request->nom . " " . $request->prenom;
                                $user->email = $request->email;
                                $user->cin = $request->cin;
                                $user->telephone =  $request->phone;
                                $ch1 = "0000";
                                $user->password = Hash::make($ch1);
                             //   $user->role_id = '7';
                                $user->save();
                                $use_id_inserer = $fonct->findWhereMulitOne("users",["email"],[$request->email])->id;

                                DB::beginTransaction();
                                try {
                                    $fonct->insert_role_user($use_id_inserer,"7",true); // cfp
                                    DB::commit();
                                } catch (Exception $e) {
                                    DB::rollback();
                                    echo $e->getMessage();
                                }
                                if (Gate::allows('isCFP')) {
                                    $resp_cfp_connecter = $fonct->findWhereMulitOne('responsables_cfp', ["user_id"], [$user_id]);
                                    $result = $resp->insert_resp_CFP($doner, $resp_cfp_connecter->cfp_id, $user->id);
                                    return $result;
                                }
                                if (Gate::allows('isSuperAdmin')) {
                                    $result = $resp->insert_resp_CFP($doner, $request->cfp_id, $user->id);
                                    return $result;
                                }
                                if (Gate::allows('isAdmin')) {
                                    $result = $resp->insert_resp_CFP($doner, $request->cfp_id, $user->id);
                                   return $result;
                                }
                            }
                        }
                    }
                }
                else {
                    return back()->with('error', "seul le responsable principale a le droit d'ajouter un nouveau responsable");
                }
            }

        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $req)
    {
        $resp = new ResponsableCfpModel();
        $result = $resp->delete_resp_CFP($req->id);
        return $result;
    }
    //modification
    public function edit_photo ($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_photo', compact('responsable'));
    }
    public function edit_nom($id){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_nom', compact('responsable'));
    }
    public function edit_naissance($id){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_dtn', compact('responsable'));
    }
    public function edit_genre($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_genre', compact('responsable'));
    }
    public function edit_mdp($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_mdp', compact('responsable'));
    }
    public function edit_mail($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_email', compact('responsable'));
    }
    public function edit_phone($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_phone', compact('responsable'));
    }
    public function edit_cin($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_cin', compact('responsable'));
    }
    public function edit_adresse($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_adresse', compact('responsable'));
    }
    public function edit_fonction($id,Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
        return view('cfp.responsable_cfp.modification_profil.edit_fonction', compact('responsable'));
    }


    //update responsable cfp
    public function update_nom_responsable($id,Request $request){
        if($request->nom == null){
            return back()->with('error_nom','Entrez votre nom avant  de cliquer sur enregistrer');
        }
        elseif($request->prenom == null){
            return back()->with('error_prenom','Entrez votre prenom avant  de cliquer sur enregistrer');
        }
        else{
            DB::update('update users set name = ? where id = ?', [$request->nom.' '.$request->prenom, Auth::id()]);
            DB::update('update responsables_cfp set nom_resp_cfp = ?,prenom_resp_cfp = ? where user_id = ?', [$request->nom,$request->prenom, Auth::id()]);
            return redirect()->route('profil_du_responsable');
        }
    }
    public function update_dtn_responsable($id,Request $request){
         DB::update('update responsables_cfp set date_naissance_resp_cfp = ? where user_id = ?', [$request->date_naissance, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_genre_responsable($id,Request $request){

        if($request->genre == "Homme") $genre = 2;
        if($request->genre == "Femme") $genre = 1;

        DB::update('update responsables_cfp set sexe_resp_cfp = ? where user_id = ?', [$genre, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_mdp_responsable($id,Request $request){
        if($request->ancien_password == null){
            return back()->with('error_ancien_pwd','Entrez votre ancien mot de passe');
        }
        elseif($request->new_password == null){
            return back()->with('error_new_pwd','Entrez votre nouveau mot de passe avant de cliquer sur enregistrer');
        }
        else{
            $users =  db::select('select * from users where id = ?', [Auth::id()]);
            $pwd = $users[0]->password;
            $new_password = Hash::make($request->new_password);
            if (Hash::check($request->get('ancien_password'), $pwd)) {
                DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
                return redirect()->route('profil_du_responsable');
            } else {
                return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
            }
        }
    }
    public function update_email_responsable($id,Request $request){
        if($request->mail_resp == null){
            return back()->with('error_email','Entrez votre adresse e-mail avant de cliquer sur enregistrer');
        }
        else{
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id])->cfp_id;
            DB::update('update users set email = ? where id = ?', [$request->mail_resp, Auth::id()]);
            DB::update('update responsables_cfp set email_resp_cfp = ? where user_id = ?', [$request->mail_resp, Auth::id()]);
            DB::update('update cfps set email = ? where id = ?', [$request->mail_resp, $cfp_id]);
            return redirect()->route('profil_du_responsable');
        }
    }
    public function update_telephone_responsable($id,Request $request){
        if($request->phone == null){
            return back()->with('error_phone','Entrez votre numéro de téléphone avant de cliquer sur enregistrer');
        }
        else{
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[Auth::user()->id])->cfp_id;
            DB::update('update users set telephone = ? where id = ?', [$request->phone, Auth::id()]);
            DB::update('update responsables_cfp set telephone_resp_cfp = ? where user_id = ?', [$request->phone, Auth::id()]);
            DB::update('update cfps set telephone = ? where id = ?', [$request->phone, $cfp_id]);
            return redirect()->route('profil_du_responsable');
        }

    }
    public function update_cin_responsable($id,Request $request){
        if($request->cin == null){
            return back()->with('error_cin','Entrez votre CIN avant de cliquer sur enregistrer');
        }
        DB::update('update users set cin = ? where id = ?', [$request->cin, Auth::id()]);
        DB::update('update responsables_cfp set cin_resp_cfp = ? where user_id = ?', [$request->cin, Auth::id()]);
        return redirect()->route('profil_du_responsable');
    }
    public function update_adresse_responsable($id,Request $request){
        if($request->lot == null || $request->ville == null || $request->region == null || $request->quartier == null || $request->code_postal == null){
            return back()->with('error_adresse','Entrez votre adresse complète avant  de cliquer sur enregistrer');
        }
        else{
            DB::update('update responsables_cfp set adresse_lot = ?, adresse_quartier = ?, adresse_code_postal = ?, adresse_ville = ?, adresse_region = ? where user_id = ?', [$request->lot,$request->quartier,$request->code_postal,$request->ville,$request->region, Auth::id()]);
            return redirect()->route('profil_du_responsable');
        }

    }
    public function update_fonction_responsable($id,Request $request){
        if($request->error_fonction == null){
            return back()->with('error_fonction','Entrez votre fonction avant de cliquer sur enregistrer');
        }
        else{
            DB::update('update responsables_cfp set fonction_resp_cfp = ? where user_id = ?', [$request->fonction, Auth::id()]);
            return redirect()->route('profil_du_responsable');
        }

    }
    public function update_photo_responsable($id,Request $request){
        $image = $request->file('image');
        //tableau contenant les types d'extension d'images
        $extension_type = array('jpeg','jpg','png','gif','psd','ai','svg');
		 if($image != null){
            if($image->getSize() > 1692728 or $image->getSize() == false){
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 1.7 MB');
            }
            elseif(in_array($request->image->extension(),$extension_type)){

					$user_id =  $users = Auth::user()->id;
					$responsable = $this->fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
					$image_ancien = $responsable->photos_resp_cfp;
					//supprimer l'ancienne image
					File::delete(public_path("images/responsables/".$image_ancien));
					//enregiistrer la nouvelle photo

					$nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.' . $request->image->extension());
					$destinationPath = 'images/responsables';
                    //imager  resize
                   $image_name = $nom_image;

                 $destinationPath = public_path('images/responsables');

                 $resize_image = Image::make($image->getRealPath());

                $resize_image->resize(228, 128, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' .  $image_name);
					// $image->move($destinationPath, $nom_image);
					$url_photo = URL::to('/')."/images/responsables/".$nom_image;

					DB::update('update responsables_cfp set photos_resp_cfp = ?,url_photo = ? where user_id = ?', [$nom_image,$url_photo, Auth::id()]);
					return redirect()->route('profil_du_responsable');
			}
            else{
                return redirect()->back()->with('error_format', 'Le format de votre fichier n\'est pas acceptable,choisissez entre : .jpeg,.jpg,.png,.gif,.psd,.ai,.svg');
            }
		}
		else{
			return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
		}
    }
    public function desactiver_personne(Request $request){
        $id  = $request->Id;
        $activiter = 0;
        DB::update('update responsables_cfp set activiter = ? where id = ?', [$activiter, $id]);
        return response()->json(['success' => 'ok']);
    }

    public function activer_personne(Request $request){
        $id  = $request->Id;
        $activiter = 1;
        DB::update('update responsables_cfp set activiter = ? where id = ?', [$activiter, $id]);
        return response()->json(['success' => 'ok']);
    }
}
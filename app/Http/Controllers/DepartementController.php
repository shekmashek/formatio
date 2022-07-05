<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\entreprise;
use App\Departement;
use App\DepartementEntreprise;
use App\chefDepartement;
use App\chefDepartementEntreprise;
use App\responsable;
use App\Models\FonctionGenerique;
use App\Role;
use App\RoleUser;
use App\service;

use Illuminate\Support\Facades\Gate;

class DepartementController extends Controller
{

    public function __construct()
    {
        $this->liste_entreprise = entreprise::orderBy('nom_etp')->get();
        // $this->liste_departement =  Departement::all();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index()
    {
        $fonct = new FonctionGenerique();
        $liste_entreprise = $this->liste_entreprise;
        $entreprise_id = entreprise::orderBy('nom_etp')->get();
        $liste_departement = $fonct->findAll("departement_entreprises");
        return view('admin.entreprise.departement', compact('liste_entreprise', 'liste_departement'));
    }

    /* public function index()
    {
        $liste_entreprise = $this->liste_entreprise;
        $entreprise_id = entreprise::orderBy('nom_etp')->get();
        $liste_departement = $this->liste_departement;
        return view('admin.entreprise.departement', compact('liste_entreprise', 'liste_departement'));
    } */

    /*  public function liste()
    {
        $user_id = Auth::user()->id;
        $chef = ChefDepartement::where('user_id', $user_id)->get();

        return view('admin.chefDepartement.liste', compact('chef'));
    } */
    //ajout nouveau role
    public function role_manager(Request $request)
    {
        $id_chef = $request->id_chef;
        $user_id = chefDepartement::where('id', $id_chef)->value('user_id');
        $roles = $request->role_id;
        for ($i = 0; $i < count($roles); $i++) {
            DB::insert('insert into role_users (user_id, role_id) values (?, ?)', [$user_id, $roles[$i]]);
        }
        return back();
    }


    public function liste()
    {
        $fonct = new FonctionGenerique();
        $role = new RoleUser();

        //on va récupérer la liste des employes
        $user_id = Auth::user()->id;
        $etp_id = responsable::where('user_id', [$user_id])->value('entreprise_id');
        $referent = DB::select('select id,genre_id,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp,photos,matricule,nom_resp,prenom_resp,fonction_resp,email_resp,telephone_resp,cin_resp,entreprise_id,prioriter,user_id,url_photo, SUBSTRING(prenom_resp, 1, 1) AS pr, SUBSTRING(nom_resp, 1, 1) AS nm from responsables where entreprise_id = ? and prioriter=false', [$etp_id]);
        // $referent = DB::select(' where entreprise_id = ? and prioriter=false', [$etp_id]);
        // $chef = chefDepartement::where('entreprise_id', $etp_id)->get();
        $chef =  $fonct->findWhere('chef_departements',['entreprise_id'],[$etp_id]);
        $nom_chef = [];
        $prenom_chef = [];
        for ($i=0; $i < count($chef); $i++) {
            $nom_chef[$i] = substr($chef[$i]->nom_chef,0,1);
            $prenom_chef[$i] = substr($chef[$i]->prenom_chef,0,1);
        }

        $stagiaires = DB::select('select id,matricule,nom_stagiaire,prenom_stagiaire,photos,case when genre_stagiaire = 1 then "Femme" when genre_stagiaire = 2 then "Homme" end genre_stagiaire,titre,fonction_stagiaire,mail_stagiaire,telephone_stagiaire,entreprise_id,user_id,service_id,cin,url_photo, SUBSTRING(prenom_stagiaire, 1, 1) AS prenom, SUBSTRING(nom_stagiaire, 1, 1) AS nom from stagiaires where entreprise_id = ?', [$etp_id]);
        // $stagiaires = DB::select('select * from stagiaires where entreprise_id = ?', [$etp_id]);

        $user_role = DB::select('select * from v_user_role');
        $roles = $fonct->findAll("v_role_etp");

        // role actif
        $roles_actif_stg = $fonct->findWhere("v_role_user_etp_stg", ["entreprise_id"], [$etp_id]);
        $roles_actif_referent = $fonct->findWhere("v_role_user_etp_referent", ["entreprise_id"], [$etp_id]);
        $roles_actif_manager = $fonct->findWhere("v_role_user_etp_manager", ["entreprise_id"], [$etp_id]);

        // role not actif
        $roles_not_actif_stg = $role->getNotRoleUser("v_role_user_etp_stg", $stagiaires, $etp_id);
        $roles_not_actif_referent = $role->getNotRoleUser("v_role_user_etp_referent", $referent, $etp_id);
        $roles_not_actif_manager = $role->getNotRoleUser("v_role_user_etp_manager", $chef, $etp_id);

        return view('admin.chefDepartement.liste', compact('nom_chef','prenom_chef','roles_actif_stg', 'roles_not_actif_stg', 'roles_actif_referent', 'roles_not_actif_referent', 'roles_actif_manager', 'roles_not_actif_manager', 'chef', 'referent', 'stagiaires', 'user_role', 'roles'));
    }

    //newAfficheInfo
    public function newInfo($user_id){

        $funct = new FonctionGenerique();
        $emps = $funct->afficheInfoNewOne($user_id);

        return response()->json($emps);
    }

//start filtre
 // filtre Employes fonction
    public function filtreFonction(Request $request){
        $function = new FonctionGenerique();
        $emps = $function->filtreEmploye('fonction_stagiaire', $request->get('test'));

        return json_encode($emps);
    }

    // filtre employes name
    public function filtreName(Request $request){
        $function = new FonctionGenerique();
        $emps = $function->filtreEmploye('nom_stagiaire', $request->get('name'));

        return json_encode($emps);
    }

    // filtre employes matricule
    public function filtreMatricule(Request $request){
        $function = new FonctionGenerique();
        $emps = $function->filtreEmploye('matricule', $request->get('matricule'));

        return json_encode($emps);
    }

    // filtre employes role
    public function filtreRole(Request $request){
        $function = new FonctionGenerique();
        $emps = $function->filtreEmploye('role_name', $request->get('role_name'));

        return json_encode($emps);
    }


    //filtre referent fonction
    public function filtreReferent(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreReferent('fonction_resp', $request->get('fonctionReferent'));

        return json_encode($referents);
    }

    //filtre referent name
    public function filtreReferentName(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreReferent('nom_resp', $request->get('nameReferent'));

        return json_encode($referents);
    }

    //filtre referent matricule
    public function filtreReferentMatricule(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreReferent('matricule', $request->get('matriculeReferent'));

        return json_encode($referents);
    }

    //filtre referent role
    public function filtreReferentRole(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreReferent('role_name', $request->get('roleReferent'));

        return json_encode($referents);
    }

    //filtre chef fonction
    public function filtreChef(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreChef('fonction_chef', $request->get('fonctionChef'));

        return json_encode($referents);
    }

    //filtre chef name
    public function filtreChefName(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreChef('nom_chef', $request->get('nameChef'));

        return json_encode($referents);
    }

    //filtre chef matricule
    public function filtreChefMatricule(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreChef('chef_departements.id', $request->get('matriculeChef'));

        return json_encode($referents);
    }

    //filtre chef matricule
    public function filtreChefRole(Request $request){
        $function = new FonctionGenerique();
        $referents = $function->filtreChef('role_name', $request->get('roleChef'));

        return json_encode($referents);
    }
//end filtre

    /*   public function liste()
    {
        $fonct = new FonctionGenerique();
        $roles = $fonct->findWhereOr("roles",["role_name","role_name","role_name"],["referent","formateur","manager"]);

        //on va récupérer la liste des employes
        $user_id = Auth::user()->id;
        $etp_id = responsable::where('user_id',[$user_id])->value('entreprise_id');

        $referent = DB::select('select * from responsables where entreprise_id = ?', [$etp_id]);
        $chef = chefDepartement::where('entreprise_id', $etp_id)->get();
        $stagiaires = DB::select('select * from stagiaires where entreprise_id = ?', [$etp_id]);

        $user_role = DB::select('select * from v_user_role');
        $roles = DB::select('select * from roles');
        // dd($user_role);
        return view('admin.chefDepartement.liste', compact('chef','referent','stagiaires','user_role','roles'));
    }
*/
    public function create()
    {
        $fonct = new FonctionGenerique();

        if (Gate::allows('isSuperAdmin')) {
            $liste_entreprise = $this->liste_entreprise;
            $liste_departement = $fonct->findAll("departement_entreprises");
            return view('admin.chefDepartement.chef', compact('liste_entreprise', 'liste_departement'));
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', Auth()->user()->id)->value('entreprise_id');
            // $liste_departement = $fonct->findAll("departement_entreprises");
            $liste_departement = db::select('select * from departement_entreprises where entreprise_id = ?', [$entreprise_id]);

            return view('admin.chefDepartement.chef', compact('liste_departement'));
        }
    }

    /* public function create()
    {
        if (Gate::allows('isSuperAdmin')) {
            $liste_entreprise = $this->liste_entreprise;
            $liste_departement = $this->liste_departement;
            return view('admin.chefDepartement.chef', compact('liste_entreprise', 'liste_departement'));
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', Auth()->user()->id)->value('entreprise_id');
            $liste_departement = DepartementEntreprise::with('departement')->where('entreprise_id', $entreprise_id)->get();
            return view('admin.chefDepartement.chef', compact('liste_departement'));
        }
    } */



    public function affProfilChefDepart()
    {
        $fonct = new FonctionGenerique();
        // $idChef = chefDepartement::where('user_id', Auth::user()->id)->value('id');
        $id_chef = $fonct->findWhereMulitOne("chef_departements",["user_id"],[Auth::user()->id]);
        $departement = $fonct->findWhereMulitOne("v_chef_departement_entreprise",["chef_departements_id"],[$id_chef->id]);
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();

        if($id_chef->genre_id == 1) $genre = "Femme";
        if($id_chef->genre_id == 2) $genre = "Homme";
        if($id_chef->genre_id == null) $genre = '';
        return view('admin/chefDepartement/profilChefDepartement', compact('genre','id_chef', 'departement'));
    }
    //enregistrer departement
    public function store(Request $request)
    {
        $input = $request->all();
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;
        for ($i = 0; $i < count($input['departement']); $i++) {
            DB::insert('insert into departement_entreprises (entreprise_id, nom_departement) values (?, ?)', [$id_etp, $input['departement'][$i]]);
        }
        return back();
    }

    public function show()
    {
        $id = request()->id;
        $dep = DepartementEntreprise::with('departement')->where('entreprise_id', $id)->get();
        return response()->json($dep);
    }

    public function edit($id)
    {
        $rqt = DB::select('select * from chef_departements where id = ?', [$id]);
        $user_id = $rqt[0]->user_id;
        $role_id = DB::select('select * from v_user_role where user_id = ?', [$user_id]);
        $roles = DB::select('select * from roles');
        $var = chefDepartement::findOrFail($id);
        return view('admin.chefDepartement.update', compact('var', 'roles', 'role_id'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $vars = chefDepartement::findOrFail($id);

        $vars->update([
            'nom_chef' => $request->nom, 'prenom_chef' => $request->prenom, 'fonction_chef' => $request->fonction,
            'mail_chef' => $request->mail, 'telephone_chef' => $request->phone
        ]);
        $password = $request->password;
        $nom = $request->nom;
        $mail = $request->mail;
        $hashedPwd = Hash::make($password);
        $user = User::where('id', Auth::user()->id)->update([
            'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        ]);
        return redirect()->route('profil_manager', $id);
    }

    public function destroy($id)
    {
        //
    }
    //fonction qui montre les départements, services,branches de l'entreprise connecté
    public function show_departement(Request $request)
    {
        $fonct = new FonctionGenerique();
        $id_etp = $fonct->findWhereMulitOne("employers",["user_id"],[Auth::user()->id])->entreprise_id;

        $employes = $fonct->findWhere("employers",["entreprise_id","activiter"],[$id_etp,1]);

        $rqt = db::select('select * from v_chef_departement_entreprise where entreprise_id = ?', [$id_etp]);
        $nb = count($rqt);
        $service_departement = DB::select("select *  from v_chef_de_service_entreprise  where entreprise_id = ? ", [$id_etp]);
        $nb_serv = count($service_departement);
        $branches = DB::select('select * from branches where entreprise_id = ?', [$id_etp]);
        $manager = $fonct->findWhere("chef_departements",["entreprise_id"],[$id_etp]);
        $nb_branche = count($branches);
        return view('admin.departememnt.nouveau_departement', compact('manager','employes','rqt', 'nb', 'nb_serv', 'service_departement','branches', 'nb_branche'));
    }
    public function delete_dep($id)
    {
        $fonct = new FonctionGenerique();
        $verification = $fonct->findWhere("employers",["departement_entreprises_id"],[$id]);
        $verification_service = $fonct->findWhere("services",["departement_entreprise_id"],[$id]);
        if($verification != null){
            return back()->with('erreur','Vous ne pouvez pas supprimer, il y a des employés rattachés à ce département');
        }
        if($verification_service != null){
            return back()->with('erreur','Vous ne pouvez pas supprimer, il y a des services rattachés à ce département');
        }
        else{
            DB::delete('delete from departement_entreprises where id = ?', [$id]);
            return back();
        }

    }
    public function update_dep(Request $request)
    {
        DB::update('update departement_entreprises set nom_departement=? where id=?',[$request->departement,$request->id]);
        return back();
    }
    public function delete_service(Request $request)
    {
        $ids=$request->ids;
        if($ids == null) return back()->with('erreur','Veuillez sélectionnez le service que vous voulez supprimer');
        else{
            $id = service::whereIn('id',$ids)->get();
            $fonct = new FonctionGenerique();
            $verification = $fonct->findWhere("employers",["service_id"],[$id[0]->id]);
            if($verification != null){
                return back()->with('erreur','Vous ne pouvez pas supprimer, il y a des employés rattachés à ce service');
            }
            else{
                service::whereIn('id',$ids)->delete();
                return back();
            }
        }

    }
    public function update_services(Request $request)
    {
        $dep = $request->departement;
        if (Gate::allows('isReferent')) {
            $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
            DB::update('update services set nom_service = ? where id = ?', [$request->service,$request->id]);
        }
        if (Gate::allows('isStagiairePrincipale')) {
            $rqt = DB::select('select * from stagiaires where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
            $services = DB::select("select *  from v_departement_service_entreprise  where entreprise_id = ? and departement_entreprise_id = ?", [$id_etp,$dep]);
            $req_services  = $request->service;
            for($i =0 ; $i < count($req_services) ; $i++){
                DB::update('update services set nom_service = ? where id = ?', [$req_services[$services[$i]->service_id],$services[$i]->service_id]);
            }
        }
        if (Gate::allows('isManagerPrincipale')) {
            $rqt = DB::select('select * from chef_departements where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
            $services = DB::select("select *  from v_departement_service_entreprise  where entreprise_id = ? and departement_entreprise_id = ?", [$id_etp,$dep]);
            $req_services  = $request->service;
            for($i =0 ; $i < count($req_services) ; $i++){
                DB::update('update services set nom_service = ? where id = ?', [$req_services[$services[$i]->service_id],$services[$i]->service_id]);
            }
        }
        return back();
    }
    public function delete_branche($id)
    {
        $fonct = new FonctionGenerique();
        $verification = $fonct->findWhere("employers",["branche_id"],[$id]);
        if($verification != null){
            return back()->with('erreur','Vous ne pouvez pas supprimer, il y a des employés rattachés à cette branche');
        }
        else{
            DB::delete('delete from branches where id=?',[$id]);
            return back();
        }
    }
    public function update_branche(Request $request)
    {

        DB::update('update branches set nom_branche=? where id=?',[$request->branche,$request->id]);
        return back();
    }
    //fonction qui enregistre les services ratachés aux départements
    public function enregistrement_service(Request $request)
    {
        // $id_departement = $request->departement_id;
        $input = $request->all();
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;

        for ($i = 0; $i < count($input['service']); $i++) {
            DB::insert('insert into services (departement_entreprise_id, nom_service, entreprise_id) values (?, ?, ?)', [$input['departement_id'][$i], $input['service'][$i], $id_etp]);
        }
        return back();
    }
    //fonction quii enregistre les branches
    public function enregistrement_branche(Request $request)
    {
        $input = $request->all();
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;

        for ($i = 0; $i < count($input['nom_branche']); $i++) {
            DB::insert('insert into branches (entreprise_id, nom_branche) values (?, ?)', [$id_etp, $input['nom_branche'][$i]]);
        }
        return back();
    }
    //fonction qui modifie le nom de département
    // public function update_departement(Request $request)
    // {
    //     $id_dep = $request->Id;
    //     $nom_dep = $request->Nom;
    //     db::update('update departement_entreprises set nom_departement = ? where id = ?', [$nom_dep, $id_dep]);
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Données modifiées avec succès',

    //         ]
    //     );
    // }
    //fonction qui modifie le nom du service
    // public function update_service(Request $request)
    // {
    //     $id_serv = $request->Id;
    //     $nom_serv = $request->Nom;
    //     db::update('update services set nom_service = ? where id = ?', [$nom_serv, $id_serv]);
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Données modifiées avec succès',

    //         ]
    //     );
    // }
    //show departement select option
    public function liste_dep(Request $request)
    {
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;
        $nom_dep = DB::select('select * from departement_entreprises where entreprise_id = ?', [$id_etp]);
        return response()->json($nom_dep);
    }
    /**Ajout chef de departement */
    public function ajouter_manager(Request $request){
        $fonct = new FonctionGenerique();
        if($request->manager != "null"){
            $dep_id = $request->dep_id;
            DB::insert('insert into chef_dep_entreprises (departement_entreprise_id, chef_departement_id) values (?, ?)', [$dep_id, $request->manager]);
            $emp_info = $fonct->findWhereMulitOne("employers",["id"],[$request->manager]);

            DB::update('update role_users set activiter = 0 where user_id = ? and role_id != ?', [$emp_info->user_id,5]);
            DB::insert('insert into role_users (user_id,role_id,prioriter,activiter) values (?,?,?,?)', [$emp_info->user_id,5,0,1]);
            return back();
        }
        else{
            return back()->with('erreur_manager',"Choisissez un manager avant d'enregistrer");
        }
    }
    /**Ajout chef de service */
    public function ajouter_chef_de_service(Request $request){
        $fonct = new FonctionGenerique();
        if($request->chef_de_service != "null"){
            $emp_info = $fonct->findWhereMulitOne("employers",["id"],[$request->chef_de_service]);
            DB::insert('insert into chef_de_service_entreprises (service_id, chef_de_service_id) values (?, ?)', [ $request->service_id, $request->chef_de_service]);
            DB::update('update role_users set activiter = 0 where user_id = ? and role_id != 9', [$emp_info->user_id]);
            DB::insert('insert into role_users (user_id,role_id,prioriter,activiter) values (?,9,0,1)', [$emp_info->user_id]);
            return back();
        }
        else{
            return back()->with('erreur_manager',"Choisissez un chef de service avant d'enregistrer");
        }
    }
    /**Modifier chef de departement */
    public function modifier_manager(Request $request){
        $fonct = new FonctionGenerique();
        if($request->manager != "null"){
            $dep_id = $request->dep_id;
            /**modification  ancien manager*/
            DB::delete('delete from chef_dep_entreprises where departement_entreprise_id = ? and chef_departement_id = ?', [$dep_id,$request->ancien_chef]);
            DB::delete('delete from role_users where user_id = ? and role_id = ?', [$request->ancien_user_chef,5]);

            /**ajout  nouveau manager*/
            DB::insert('insert into chef_dep_entreprises (departement_entreprise_id, chef_departement_id) values (?, ?)', [$dep_id, $request->manager]);
            $emp_info = $fonct->findWhereMulitOne("employers",["id"],[$request->manager]);

            DB::update('update role_users set activiter = 0 where user_id = ? and role_id != ?', [$emp_info->user_id,5]);
            DB::insert('insert into role_users (user_id,role_id,prioriter,activiter) values (?,?,?,?)', [$emp_info->user_id,5,0,1]);
            return back();
        }
        else{
            return back()->with('erreur_manager',"Choisissez un manager avant d'enregistrer");
        }
    }
    /**Modifier chef de service */
    public function modifier_chef_de_service(Request $request){
        $fonct = new FonctionGenerique();
        if($request->chef_de_service != "null"){
            /**modification  ancien chef*/
            DB::delete('delete from chef_de_service_entreprises where service_id = ? and chef_de_service_id = ?', [$request->service_id,$request->ancien_chef]);
            DB::delete('delete from role_users where user_id = ? and role_id = ?', [$request->ancien_user_chef,9]);

            /**ajout  nouveau chef*/
            DB::insert('insert into chef_de_service_entreprises (service_id, chef_de_service_id) values (?, ?)', [$request->service_id, $request->chef_de_service]);
            $emp_info = $fonct->findWhereMulitOne("employers",["id"],[$request->chef_de_service]);

            DB::update('update role_users set activiter = 0 where user_id = ? and role_id != ?', [$emp_info->user_id,9]);
            DB::insert('insert into role_users (user_id,role_id,prioriter,activiter) values (?,?,?,?)', [$emp_info->user_id,9,0,1]);
            return back();
        }
        else{
            return back()->with('erreur_manager',"Choisissez un chef de service avant d'enregistrer");
        }
    }
}
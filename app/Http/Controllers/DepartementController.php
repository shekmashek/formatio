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
use App\RoleUser;

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

        $referent = DB::select('select * from responsables where entreprise_id = ? and prioriter=false', [$etp_id]);
        $chef = chefDepartement::where('entreprise_id', $etp_id)->get();
        $stagiaires = DB::select('select * from stagiaires where entreprise_id = ?', [$etp_id]);

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


        return view('admin.chefDepartement.liste', compact('roles_actif_stg', 'roles_not_actif_stg', 'roles_actif_referent', 'roles_not_actif_referent', 'roles_actif_manager', 'roles_not_actif_manager', 'chef', 'referent', 'stagiaires', 'user_role', 'roles'));
    }

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

        $idChef = chefDepartement::where('user_id', Auth::user()->id)->value('id');
        $depEtpId = chefDepartementEntreprise::where('chef_departement_id', $idChef)->value('departement_entreprise_id');
        $departement = DepartementEntreprise::with('departement', 'entreprise')->where('id', $depEtpId)->get();
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();

        if ($chef_connecte) {

            $vars = chefDepartement::with('entreprise')->where('user_id', $user_id)->get();
        } else {
            $idChef = request()->id_chef;
            $depEtpId = chefDepartementEntreprise::where('chef_departement_id', $idChef)->value('departement_entreprise_id');
            $departement = DepartementEntreprise::with('departement', 'entreprise')->where('id', $depEtpId)->get();
            $vars = chefDepartement::with('entreprise')->where('id', $idChef)->get();
        }

        return view('admin/chefDepartement/profilChefDepartement', compact('vars', 'departement'));
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
        return redirect()->route('affProfilChefDepartement', $id);
    }

    public function destroy($id)
    {
        //
    }
    //fonction qui montre les départements, services,branches de l'entreprise connecté
    public function show_departement(Request $request)
    {
        if (Gate::allows('isReferentPrincipale')) {
            $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
        }
        if (Gate::allows('isStagiairePrincipale')) {
            $rqt = DB::select('select * from stagiaires where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
        }
        if (Gate::allows('isManagerPrincipale')) {
            $rqt = DB::select('select * from chef_departements where user_id = ?', [Auth::user()->id]);
            $id_etp = $rqt[0]->entreprise_id;
        }

        $rqt = db::select('select * from departement_entreprises where entreprise_id = ?', [$id_etp]);
        $nb = count($rqt);
        $service_departement = DB::select("select * ,GROUP_CONCAT(nom_service) as nom_service from v_departement_service_entreprise  where entreprise_id = ? group by nom_departement", [$id_etp]);
        $nb_serv = count($service_departement);
        $branches = DB::select('select * from branches where entreprise_id = ?', [$id_etp]);
        $nb_branche = count($branches);
            return view('admin.departememnt.nouveau_departement', compact('rqt', 'nb', 'nb_serv', 'service_departement', 'branches', 'nb_branche'));
    }
    //fonction qui enregistre les services ratachés aux départements
    public function enregistrement_service(Request $request)
    {
        // $id_departement = $request->departement_id;
        $input = $request->all();
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;

        for ($i = 0; $i < count($input['service']); $i++) {
            DB::insert('insert into services (departement_entreprise_id, nom_service) values (?, ?)', [$input['departement_id'][$i], $input['service'][$i]]);
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
    public function update_departement(Request $request)
    {
        $id_dep = $request->Id;
        $nom_dep = $request->Nom;
        db::update('update departement_entreprises set nom_departement = ? where id = ?', [$nom_dep, $id_dep]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Données modifiées avec succès',

            ]
        );
    }
    //fonction qui modifie le nom du service
    public function update_service(Request $request)
    {
        $id_serv = $request->Id;
        $nom_serv = $request->Nom;
        db::update('update services set nom_service = ? where id = ?', [$nom_serv, $id_serv]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Données modifiées avec succès',

            ]
        );
    }
    //show departement select option
    public function liste_dep(Request $request)
    {
        $rqt = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;
        $nom_dep = DB::select('select * from departement_entreprises where entreprise_id = ?', [$id_etp]);
        return response()->json($nom_dep);
    }
}

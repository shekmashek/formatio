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

use Illuminate\Support\Facades\Gate;

class DepartementController extends Controller
{

    public function __construct()
    {
        $this->liste_entreprise = entreprise::orderBy('nom_etp')->get();
        // $this->liste_departement =  Departement::all();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index()
    {
        $liste_entreprise = $this->liste_entreprise;
        $entreprise_id = entreprise::orderBy('nom_etp')->get();
        $liste_departement = $this->liste_departement;
        return view('admin.entreprise.departement', compact('liste_entreprise', 'liste_departement'));
    }

  /*  public function liste()
    {
        $user_id = Auth::user()->id;
        $chef = ChefDepartement::where('user_id', $user_id)->get();

        return view('admin.chefDepartement.liste', compact('chef'));
    } */

    public function liste()
    {
        $user_id = Auth::user()->id;
        $etp_id = responsable::where('user_id',[$user_id])->value('entreprise_id');
        $chef = chefDepartement::where('entreprise_id', $etp_id)->get();


        return view('admin.chefDepartement.liste', compact('chef'));
    }
    public function create()
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
    }



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
        $rqt= DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
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
        $var = chefDepartement::findOrFail($id);
        return view('admin.chefDepartement.update', compact('var'));
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
    //fonction qui montre les départements et services de l'entreprise connecté
    public function show_departement(Request $request){
        $rqt= DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;
        $rqt = db::select('select * from departement_entreprises where entreprise_id = ?',[$id_etp]);
        $nb = count($rqt);
        $service_departement = DB::select("select * ,GROUP_CONCAT(nom_service) as nom_service from v_departement_service_entreprise  where entreprise_id = ? group by nom_departement", [$id_etp]);
        $nb_serv = count($service_departement);
        if($rqt != null){
            // $liste_departement = $rqt[3]->nom_departement;
            return view('admin.departememnt.nouveau_departement',compact('rqt','nb','nb_serv','service_departement'));
        }
        else{
            return view('admin.departememnt.nouveau_departement');
        }

    }
    //fonction qui enregistre les services ratachés aux départements
    public function enregistrement_service(Request $request){
        // $id_departement = $request->departement_id;
        $input = $request->all();
        $rqt= DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;

        for ($i = 0; $i < count($input['service']); $i++) {
            DB::insert('insert into services (departement_entreprise_id, nom_service) values (?, ?)', [ $input['departement_id'][$i], $input['service'][$i] ]);
        }
        return back();
    }
    //fonction qui modifie le nom de département
    public function update_departement(Request $request){
        $id_dep = $request->Id;
        $nom_dep = $request->Nom;
        db::update('update departement_entreprises set nom_departement = ? where id = ?',[$nom_dep,$id_dep]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Données modifiées avec succès',

            ]
        );
    }
    //fonction qui modifie le nom du service
    public function update_service(Request $request){
        $id_serv = $request->Id;
        $nom_serv = $request->Nom;
        db::update('update services set nom_service = ? where id = ?',[$nom_serv,$id_serv]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Données modifiées avec succès',

            ]
        );
    }
    //show departement select option
    public function liste_dep(Request $request){
        $rqt= DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $id_etp = $rqt[0]->entreprise_id;
        $nom_dep = DB::select('select * from departement_entreprises where entreprise_id = ?',[$id_etp]);
        return response()->json($nom_dep);
    }
}

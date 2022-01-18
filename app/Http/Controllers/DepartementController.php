<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        $this->liste_departement =  Departement::all();
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

    public function store(Request $request)
    {

        $input = $request->all();
        for ($i = 0; $i < count($input['departement']); $i++) {
            $depParEtp = new DepartementEntreprise();
            $depParEtp->departement_id = $input['departement'][$i];
            $depParEtp->entreprise_id = $request->etp_id;
            $depParEtp->save();
        }
        // return back();

        return redirect()->route('profile_entreprise', $request->etp_id);
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
}

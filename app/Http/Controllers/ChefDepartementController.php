<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chefDepartement;
use App\chefDepartementEntreprise;
use App\DepartementEntreprise;
use App\responsable;
use App\User;
use App\Models\getImageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class ChefDepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', Auth::user()->id)->value('entreprise_id');
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise_id = $request->liste_etp;
        }

        $chefDepart = new chefDepartement();

        $email = $chefDepart->checkEmail($request->mail);
        if ($email) {
            $email_error = "Cette addresse e-mail existe déjà.";
            return redirect()->back()->with('error', $email_error);
        } else {
            $chefDepart->nom_chef = $request->nom;
            $chefDepart->prenom_chef = $request->prenom;
            $chefDepart->genre_chef = $request->genre_chef;
            $chefDepart->fonction_chef = $request->fonction;
            $chefDepart->mail_chef = $request->mail;
            $chefDepart->telephone_chef = $request->phone;
            $chefDepart->entreprise_id = $entreprise_id;
            $user = new User();
            $user->name = $request->nom. " " . $request->prenom;
            $user->email = $request->mail;

            $user->cin = $request->cin;
            $user->telephone = $request->phone;

            $ch1 = '0000';
            // $ch2 = substr($request->phone, 8, 2);
            $user->password = Hash::make($ch1);
            $user->role_id = '5';
            $user->save();

            $date = date('d-m-Y');
            $user_id = User::where('email', $request->mail)->value('id');
            $nom_image = str_replace(' ', '_', $request->nom . '' .$request->phone.''. $date . '.' . $request->photos->extension());
            $str = 'images/chefDepartement';

            //stocker logo dans google drive
            $dossier = 'stagiaire';
            $stock_chef= new getImageModel();
            $stock_chef->store_image($dossier,$nom_image,$request->file('photos')->getContent());

            $chefDepart->photos = $nom_image;
            $chefDepart->user_id = $user_id;

            $chefDepart->save();
            $chefParEtp = new chefDepartementEntreprise();
            $chef_id = chefDepartement::where('mail_chef', $request->mail)->value('id');
            $idDep = $request->liste_dep;

            $idEtp = $request->liste_etp;
            $departement_entreprise_id = DepartementEntreprise::where(['departement_id' => $idDep], ['entreprise_id' => $idEtp])->value('id');

            $chefParEtp->departement_entreprise_id = $departement_entreprise_id;
            $chefParEtp->chef_departement_id = $chef_id;
            DB::insert("insert into chef_dep_entreprises(departement_entreprise_id,chef_departement_id) values(?,?)", [$departement_entreprise_id, $chef_id]);
        //      DB::insert("insert into chef_dep_entreprises(departement_entreprise_id,chef_departement_id,departement_id) values(?,?,?)", [$departement_entreprise_id, $chef_id, $request->liste_dep]);
            // $request->photos->move(public_path($str), $nom_image);
            return redirect()->route('liste_chefDepartement');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = request()->id;
        $depart = chefDepartement::where('id', $id)->get();
        return back();
    }

    public function update(Request $request, $id)
    {
        $depart = chefDepartement::findOrFail($id);
        $depart->update(['nom_chef' => $request->nom_chef, 'prenom_chef' => $request->prenom_chef, 'genre_chef' => $request->genre_chef, 'fonction_chef' => $request->fonction_chef, 'mail_chef' => $request->mail_chef, 'telephone_chef' => $request->telephone_chef]);
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $chef = chefDepartement::findOrFail($id);
        $user_id = chefDepartement::where('id', $id)->value('user_id');
        $del = chefDepartement::where('id', $id)->delete();
        $del_user = User::where('id', $user_id)->delete();
        $huhu = chefDepartementEntreprise::where('chef_departement_id',$id)->delete();
        File::delete("images/chefDepartement/".$chef->photos);

        return back();
    }
}

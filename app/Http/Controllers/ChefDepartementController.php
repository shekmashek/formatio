<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
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
use App\Models\FonctionGenerique;
class ChefDepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });

        $this->FonctionGenerique = new FonctionGenerique();
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
            $chefDepart->genre_id = $request->genre_chef;
            $chefDepart->fonction_chef = $request->fonction;
            $chefDepart->mail_chef = $request->mail;
            $chefDepart->telephone_chef = $request->phone;
            $chefDepart->entreprise_id = $entreprise_id;
            $chefDepart->cin_chef = $request->cin;
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
            $departement_entreprise_id = DepartementEntreprise::where(['id' => $idDep], ['entreprise_id' => $idEtp])->value('id');

            $chefParEtp->departement_entreprise_id = $departement_entreprise_id;
            $chefParEtp->chef_departement_id = $chef_id;
            DB::insert("insert into chef_dep_entreprises(departement_entreprise_id,chef_departement_id) values(?,?)", [$departement_entreprise_id, $chef_id]);
            DB::beginTransaction();
            try {
                $this->fonct->insert_role_user($user_id, "5",true); // Manager
                $this->fonct->insert_role_user($user_id, "3",false); // Manager
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
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
    public function editer_photos($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_photos', compact('chef','genre'));
    }
    public function editer_nom($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_nom', compact('chef','genre'));
    }
    public function editer_genre($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_genre', compact('chef','genre'));
    }
    public function editer_phone($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_phone', compact('chef','genre'));
    }
    public function editer_cin($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_cin', compact('chef','genre'));
    }
    public function editer_matricule($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_matricule', compact('chef','genre'));
    }
    public function editer_pwd($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_pwd', compact('chef','genre'));
    }
    public function editer_mail($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_mail', compact('chef','genre'));
    }
    public function editer_fonction($id, Request $request)
    {
        $user_id =  $users = Auth::user()->id;
        $chef_connecte = chefDepartement::where('user_id', $user_id)->exists();
        $chef =DB::select('select *  from chef_departements where id = ?',[$id])[0];
        if($chef->genre_id == 1) $genre = "Femme";
        if($chef->genre_id == 2) $genre = "Homme";
        if($chef->genre_id == null) $genre = '';
        return view('admin.chefDepartement.edit_fonction', compact('chef','genre'));
    }
    public function update_mdp_manager(Request $request){
        $users =  db::select('select * from users where id = ?', [Auth::id()]);
        $pwd = $users[0]->password;
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->get('ancien_password'), $pwd)) {
            DB::update('update users set password = ? where id = ?', [$new_password, Auth::id()]);
                   return redirect()->route('affProfilChefDepartement');

        } else {
            return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
        }
    }
        public function update_email_manager(Request $request){
            DB::update('update users set email = ? where id = ?', [$request->mail_chef, Auth::id()]);
            DB::update('update chef_departements set mail_chef = ? where user_id = ?', [$request->mail_chef, Auth::id()]);
            return redirect()->route('affProfilChefDepartement');

        }
    public function update(Request $request, $id)
    {
        $depart = chefDepartement::findOrFail($id);
        $depart->update(['nom_chef' => $request->nom_chef, 'prenom_chef' => $request->prenom_chef, 'genre_chef' => $request->genre_chef, 'fonction_chef' => $request->fonction_chef, 'mail_chef' => $request->mail_chef, 'telephone_chef' => $request->telephone_chef]);
        return back();
    }
    //updtae profile manager
    public function update_chef(Request $request, $id)
    {
        if($request->genre == "Femme") $genre = 1;
        if($request->genre == "Homme") $genre = 2;

        chefDepartement::where('id',$id)
                    ->update(['nom_chef' => $request->nom_chef, 'prenom_chef' => $request->prenom_chef,'cin_chef' => $request->cin_chef, 'genre_id' => $genre, 'fonction_chef' => $request->fonction_chef, 'mail_chef' => $request->mail_chef, 'telephone_chef' => $request->telephone_chef,'matricule'=>$request->matricule_chef]);
     return redirect()->route('affProfilChefDepartement',$id);
    }
    public function update_photos_chef(Request $request)
    {
        $image = $request->file('image');
        $fonct = new FonctionGenerique();
        if($image != null){
            if($image->getSize() > 60000){
                return redirect()->back()->with('error_logo', 'La taille maximale doit être de 60Ko');
            }
            else{
                $user_id =  $users = Auth::user()->id;

                   $chef = $fonct->findWhereMulitOne("chef_departements",["user_id"],[$user_id]);
                    $image_ancien =$chef->photos;
                    //supprimer l'ancienne image
                    File::delete(public_path("images/chefDepartement/".$image_ancien));
                    //enregiistrer la nouvelle photo
                    $nom_image = str_replace(' ', '_', $request->nom . ' ' . $request->prenom . '.' . $request->image->extension());
                    $destinationPath = 'images/chefDepartement';
                    $image->move($destinationPath, $nom_image);
                    $url_photo = URL::to('/')."/images/chefDepartement/".$nom_image;
                    DB::update('update chef_departements set photos = ?,url_photo = ? where user_id = ?', [$nom_image,$url_photo, Auth::id()]);
                    return redirect()->route('affProfilChefDepartement');
            }
        }
        else{
            return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
        }

    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $chef = chefDepartement::findOrFail($id);
        $user_id = chefDepartement::where('id', $id)->value('user_id');
       DB::delete('delete from chef_departements where id = ?', [$id]);
       DB::delete('delete from user where id = ?', [$user_id]);
       DB::delete('delete from chef_dep_entreprises where id = ?', [$id]);

       // $del = chefDepartement::where('id', $id)->delete();
       // $del_user = User::where('id', $user_id)->delete();
     //   $huhu = chefDepartementEntreprise::where('chef_departement_id',$id)->delete();
        File::delete("images/chefDepartement/".$chef->photos);

        return back();
    }
}

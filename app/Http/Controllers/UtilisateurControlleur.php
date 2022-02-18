<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\User;
use App\entreprise;
use App\stagiaire;
use App\responsable;
use App\formateur;
use App\cfp;
use App\Models\getImageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UtilisateurControlleur extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id = null)
    {
        $liste =entreprise::orderBy('nom_etp')->get();
        if($id) $datas = responsable::orderBy('nom_resp')->with('entreprise')->take($id)->get();
        else  $datas = responsable::orderBy("nom_resp")->with('entreprise')->get();
        return view('admin.utilisateur.utilisateur',compact('datas','liste'));
    }

    public function create($id=null)
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        if($id) $datas = stagiaire::orderBy('nom_stagiaire')->with('entreprise')->take($id)->get();
        else  $datas = stagiaire::orderBy("nom_stagiaire")->with('entreprise')->get();
        return view('admin.utilisateur.utilisateur_stagiaire',compact('datas','liste'));
    }
    public function liste_formateur(){
        $datas = formateur::orderBy("nom_formateur")->get();
         if(count($datas)<=0){
                return view('admin.utilisateur.guide');

            }
            else{
        return view('admin.utilisateur.utilisateur_formateur',compact('datas'));

            }

    }

    public function store(Request $request)
    {
        //
    }

    public function admin()
    {
        $users = User::where('role_id', '1')->get();
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin/utilisateur/admin', compact('liste','users'));
    }
    public function new_admin(Request $request)
    {
        $user = new User();
        $user->name = $request->nom_new_user;
        $user->email = $request->email_new_user;
        $user->password = $request->password_new_user;

        $password = $user->password;
            $hashedPwd = Hash::make($password);
            $user->password = $hashedPwd;
            $user->role_id = $request->role_id;
        $user->save();
        return back();
    }

    public function cfp()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        $cfps = cfp::all();
        return view('admin.utilisateur.cfp', compact('liste', 'cfps'));
    }
    public function superAdmin()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        $supers = User::where('role_id', '6')->get();
        return view('admin/utilisateur/superAdmin', compact('liste','supers'));
    }

    public function delete_cfp($id)
    {
        $del = cfp::where('id', $id)->delete();
        return redirect('utilisateur_cfp');
    }
    public function new_cfp()
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin.utilisateur.new_cfp', compact('liste'));
    }
    public function profil_cfp($id = null)
    {
        // $liste_cfps = cfp::findOrFail($id)->get();
        
        $id = cfp::where('user_id', Auth::user()->id)->value('id');
         
        if (Gate::allows('isSuperAdmin')) {
        $liste_cfps = DB::select('select * from cfps where id = '.$id);

            return view('admin.utilisateur.profiles_cfp',compact('liste_cfps'));

        }
        else{
       
            $liste_cfps = DB::select('select * from cfps where id = '.$id);

            return view('admin.utilisateur.profil_cfp',compact('liste_cfps'));

        }
    }
    public function register_cfp(Request $request)
    {

        $new_cfp = new cfp();

        $new_cfp->nom = $request->get('nom');
        $new_cfp->adresse_lot = $request->get('adresse_lot');
        $new_cfp->adresse_ville = $request->get('adresse_ville');
        $new_cfp->adresse_region = $request->get('adresse_region');
        $new_cfp->email = $request->get('email');
        $new_cfp->telephone = $request->get('telephone');
        $new_cfp->domaine_de_formation = $request->get('domaine');
        $new_cfp->nif = $request->get('nif');
        $new_cfp->stat = $request->get('stat');
        $new_cfp->rcs = $request->get('rcs');
        $new_cfp->cif = $request->get('cif');
        $new_cfp->site_cfp = $request->get('site');

        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->email;
        $ch1 = $request->nom;
        $ch2 = substr($request->telephone,8,2);
        $user->password = Hash::make($ch1.$ch2);
        $user->role_id = '7';
        $user->save();
        //get user id
        $user_id = User::where('email',$request->email)->value('id');

        $date = date('d-m-Y');
        $nom_image = str_replace(' ', '_', $request->nom.''.$date.'.'.$request->logo->extension());

        $str = 'images/CFP';

        //stocker logo dans google drive

        $dossier = 'entreprise';
        $stock_cfp = new getImageModel();
        $stock_cfp->store_image($dossier,$nom_image,$request->file('logo')->getContent());
        // $request->logo->move(public_path($str), $nom_image);

        $new_cfp->logo = $nom_image;
        $new_cfp->user_id = $user_id;
        $new_cfp->save();

        $cfps = cfp::all();
        $liste = entreprise::orderBy('nom_etp')->get();
        return view('admin/utilisateur/cfp', compact('cfps', 'liste'));
    }
    public function update_pwd(Request $request,$id){
        $nom = $request->nom;
        $mail = $request->mail;
        $mdp = $request->password;
        $mdpHash = Hash::make($mdp);
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $nom,
                'email' => $mail,
                'password' => $mdpHash
            ]);
    return redirect()->route('profil_cfp',$id);

    }
    public function update_logo_cfp(Request $request, $id){
        $input = $request->file('image')->getClientOriginalName();
        $dossier = 'entreprise';
         $stock_stg = new getImageModel();
        $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());

        if ($image = $request->file('image')) {
            $dossier = 'entreprise';
            $stock_stg = new getImageModel();
             $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());
        }
             if ($input !=null){
           
                $update_cfp = cfp::where('id',$id)->update([
                    'nom' => $request->get('nom_cfp'),
                    'adresse_lot' => $request->adresse_lot,
                    'adresse_ville' => $request->get('adresse_ville'),
                    'adresse_region' => $request->get('adresse_region'),
                    'email' => $request->mail,
                    'telephone' => $request->phone,
                    'site_cfp' => $request->get('site_web'),
                    'domaine_de_formation' => $request->get('domaine_cfp'),
                    'nif' => $request->get('nif_cfp'),
                    'stat' => $request->get('stat_cfp'),
                    'rcs' => $request->get('rcs_cfp'),
                    'cif' => $request->get('cif_cfp'),
                    'logo'=>$input
                ]);
            }
            else{
                $update_cfp = cfp::where('id',$id)->update([
                    'nom' => $request->get('nom_cfp'),
                    'adresse_lot' => $request->adresse_lot,
                    'adresse_ville' => $request->get('adresse_ville'),
                    'adresse_region' => $request->get('adresse_region'),
                    'email' => $request->mail,
                    'telephone' => $request->phone,
                    'site_cfp' => $request->get('site_web'),
                    'domaine_de_formation' => $request->get('domaine_cfp'),
                    'nif' => $request->get('nif_cfp'),
                    'stat' => $request->get('stat_cfp'),
                    'rcs' => $request->get('rcs_cfp'),
                    'cif' => $request->get('cif_cfp'),
                   
                ]);
            }
        return redirect()->route('profil_cfp',$id);


    }
    public function update_cfp(Request $request, $id)
    {
        // $input = $request->image;

     
            // $destinationPath = 'images/CFP';
            // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
      
     
           
        $update_cfp = cfp::where('id',$id)->update([
            'nom' => $request->get('nom_cfp'),
            'adresse_lot' => $request->adresse_lot,
            'adresse_ville' => $request->get('adresse_ville'),
            'adresse_region' => $request->get('adresse_region'),
            'email' => $request->mail,
            'telephone' => $request->phone,
            'site_cfp' => $request->get('site_web'),
            'domaine_de_formation' => $request->get('domaine_cfp'),
            'nif' => $request->get('nif_cfp'),
            'stat' => $request->get('stat_cfp'),
            'rcs' => $request->get('rcs_cfp'),
            'cif' => $request->get('cif_cfp'),
        ]);
        return redirect()->route('profil_cfp',$id);
  
    }

    

    public function show($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = responsable::orderBy('nom_resp')->where('entreprise_id',$id)->get();
        return view('admin.utilisateur.utilisateur',compact('datas','liste'));
    }
    public function show_stagiaire($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = stagiaire::orderBy('nom_stagiaire')->where('entreprise_id',$id)->get();
        return view('admin.utilisateur.utilisateur_stagiaire',compact('datas','liste'));
    }


    public function edit(Request $request)
    {
        $id = $request->Id;
        $user= User::where('id',$id)->get();
        return response()->json($user);
    }
    public function edit_nomcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_nomcfp', compact('cfp'));
    }
    public function edit_logocfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_logocfp', compact('cfp'));
    }
    public function edit_adressecfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_adressecfp', compact('cfp'));
    }
    public function edit_pwdcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_pwdcfp', compact('cfp'));
    }
    public function edit_mailcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_mailcfp', compact('cfp'));
    }
    public function edit_phonecfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_phonecfp', compact('cfp'));
    }
    public function edit_domainecfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_domainecfp', compact('cfp'));
    }
    public function edit_sitecfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_sitecfp', compact('cfp'));
    }
    public function edit_nifcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_nifcfp', compact('cfp'));
    }
    public function edit_cifcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_cifcfp', compact('cfp'));
    }
    public function edit_statcfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_statcfp', compact('cfp'));
    }
    public function edit_rcscfp($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $cfp_connecte = cfp::where('user_id', $user_id)->exists();
        $cfp = cfp::findOrFail($id);
        return view('admin.utilisateur.edit_rcscfp', compact('cfp'));
    }
    
     //update password
     public function update_cfp_mdp(Request $request,$id){

        $users =  db::select('select * from users where id = ?',[Auth::id()]);
        $pwd = $users[0]->password;
        $new_password = Hash::make($request->new_password);
        if(Hash::check($request->get('ancien_password'), $pwd)){
             DB::update('update users set password = ? where id = ?', [$new_password,Auth::id()]);
             return redirect()->route('profil_cfp',$id);
        }
         else {
             return redirect()->back()->with('error', 'L\'ancien mot de passe est incorrect');
         }
     }
        //update e-mail
    public function update_email_cfp(Request $request){
        DB::update('update users set email = ? where id = ?', [$request->mail,Auth::id()]);
        DB::update('update cfps set email= ? where user_id = ?', [$request->mail,Auth::id()]);
    
        return redirect()->route('profil_cfp');
    }
    
    public function update(Request $request)
    {
        $id = $request->Id;
        //modifier les données
        $nom = $request->Nom;
        $mail = $request->Mail;
        User::where('id', $id)
                ->update(['name' =>$nom,
                            'email' => $mail
            ]);
        return redirect()->route('liste_utilisateur');
    }

    public function destroy(Request $request)
    {
        $id = $request->Id;
        $user = User::find($id);
        $user->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
  
}

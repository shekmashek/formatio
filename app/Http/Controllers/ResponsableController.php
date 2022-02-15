<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\ReferentMail;
use App\Models\getImageModel;
use PDF;
use App\responsable;
use App\entreprise;
use App\User;
use Illuminate\Support\Facades\File;
/* ====================== Exportation Excel ============= */
use App\Exports\ResponsableExport;
use Excel;

class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id = null)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];

        if ($id) $datas = responsable::orderBy('nom_resp')->with('User', 'entreprise')->take($id)->get();
        else  $datas =  responsable::orderBy("nom_resp")->with('User', 'entreprise')->get();

        return view('admin.responsable.responsable', compact('datas', 'liste', 'info_impression'));
    }

    public function create()
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        return view('admin.responsable.nouveauResponsable', compact('liste'));
    }

    public function store(Request $request)
    {
        // //condition de validation de formulaire
        // $request->validate(
        //     [
        //         'nom' => ["required"],
        //         'prenom' =>  ["required"],
        //         'fonction' => ["required"],
        //         'mail' => ["required"],
        //         'phone' => ["required"],
        //         'photos' => ["required"],
        //         'cin' => ["required"],
        //         'dte_resp' => ["required"],
        //         'lot' => ["required"],
        //         'code_postal' => ["required"],
        //         'ville' => ["required"],
        //         'region' => ["required"],
        //         'quartier' => ["required"],

        //     ],
        //     [
        //         'nom.required' => 'Veuillez remplir le champ',
        //         'prenom.required' => 'Veuillez remplir le champ',
        //         'fonction.required' =>  'Veuillez remplir le champ',
        //         'mail.required' =>  'Veuillez remplir le champ',
        //         'phone.required' => 'Veuillez remplir le champ',
        //         'photos.required' => 'Veuillez remplir le champ',
        //         'cin.required' => 'Veuillez remplir le champ',
        //         'lot.required' => 'Veuillez remplir le champ',
        //         'ville.required' => 'Veuillez remplir le champ',
        //         'code_postal.required' => 'Veuillez remplir le champ',
        //         'region.required' => 'Veuillez remplir le champ',
        //         'quartier.required' => 'Veuillez remplir le champ',
                 //   'dte_resp' => 'Veuillez remplir le champ',





        //         // 'naissance.required' => 'Veuillez remplir le champ'
        //     ]
        // );


        //enregistrer les projets dans la bdd
        $resp = new responsable();
        $resp->nom_resp = $request->nom;
        $resp->prenom_resp = $request->prenom;
        $resp->fonction_resp = $request->fonction;
        $resp->email_resp = $request->mail;
        $resp->cin_resp = $request->cin_resp;
        // $resp->date_naissance_resp = $request->naissance;
        $resp->telephone_resp = $request->phone;
        $resp->adresse_lot= $request->lot;
        $resp->adresse_region= $request->region;
        $resp->adresse_ville= $request->ville;
        $resp->adresse_quartier= $request->quartier;
        $resp->adresse_code_postal= $request->code_postal;
        $resp->sexe_resp= $request->sexe_resp;
        $resp->poste_resp= $request->poste;
        $resp->date_naissance_resp=$request->dte_resp;
        //insertion image
        $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom .  '' . $request->phone . '.' . $request->photos->extension());
        $str = 'images/responsables/';
        //stocker logo dans google drive
        $dossier = 'responsable';
        $stock_resp = new getImageModel();
        $stock_resp->store_image($dossier, $nom_image, $request->file('photos')->getContent());
        $request->photos->move(public_path($str), $nom_image);
        $resp->photos = $nom_image;
        //enregistrer les emails , name et mot de passe dans user
        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->mail;
        $ch1 = $request->nom;
        $ch2 = substr($request->phone, 8, 2);
        $user->password = Hash::make($ch1 . $ch2);
        $user->role_id = '2';
        $user->save();
       // DB::insert('insert into users (name,email,password,role_id) VALUES (?,?,?,?)',[$request->nom,$request->mail,0000,2]);
        //get user id
        $user_id = User::where('email', $request->mail)->value('id');
        $resp->user_id = $user_id;
        //etp_id
        $resp->entreprise_id = $request->liste_etp;
        $resp->activiter = TRUE;
        $resp->save();
        //envoyer un mail de notification à tous les utilisateurs admin
        $emails = User::where('role_id', '1')->get();
        foreach ($emails as $email) {
            Mail::to($email)->send(new ReferentMail());
        }

      //  $user_id=DB::select('select * from users where email = ?', [$request->mail]);
    //   $user_id = DB::table('users')->where('email', $request->mail)->value('email');
    //  $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom .  '' . $request->phone . '.' . $request->photos->extension());
    //     $str = 'images/responsables/';
    // $rqt =     DB::insert('insert into responsables (nom_resp,prenom_resp,sexe_resp,date_naissance_resp,cin_resp,email_resp,telephone_resp,fonction_resp,poste_resp,adresse_quartier,adresse_code_postal,adresse_lot,adresse_ville ,adresse_region,user_id,photos)
    //     values (?, ?,?,?,?,?,?,?,?,?,?,?,?)',
    //      [$request->nom,$request->prenom,$request->sexe_resp,$request->dte_resp,$request->cin_resp,$request->mail,$request->phone,$request->fonction,$request->poste,$request->quartier,$request->code_postal,$request->lot,$request->ville,$request->region,$user_id,$nom_image

    //  ]);
    //  dd($rqt);
        return redirect()->route('liste_responsable');
    }
    public function affReferent($id = null)
    {
        if (Gate::allows('isReferent')) {
            $id = responsable::where('user_id', Auth::user()->id)->value('id');
            $refs = responsable::findOrFail($id);
            return view('admin.responsable.profilResponsables', compact('refs'));
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') || Gate::allows('isCFP')) {
            $refs = responsable::findOrFail($id);
            return view('admin.responsable.profilResponsable', compact('refs'));
        }
    }

    public function show($id)
    {
        $liste = entreprise::orderBy("nom_etp")->get();
        $datas = responsable::orderBy('nom_resp')->where('entreprise_id', $id)->get();

        $info = entreprise::orderBy("nom_etp")->where('id', $id)->get();
        $info_impression = [
            'id' => $info[0]->id,
            'nom_entreprise' => $info[0]->nom_etp
        ];

        return view('admin.responsable.responsable', compact('datas', 'liste', 'info_impression'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $resp = responsable::where('id', $id)->with('entreprise')->get();
        return response()->json($resp);
    }
    //edit page pur chaque champs
    public function edit_nom($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_nom', compact('responsable'));
    }
    public function edit_naissance($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_naissance', compact('responsable'));
    }
    public function edit_genre($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_genre', compact('responsable'));
    }
    public function edit_mail($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_mail', compact('responsable'));

    }
    public function edit_phone($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_phone', compact('responsable'));
    }
    public function edit_cin($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_cin', compact('responsable'));
    }
    public function edit_adresse($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_adresse', compact('responsable'));
    }
    public function edit_fonction($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_fonction', compact('responsable'));
    }

    public function edit_entreprise($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_entreprise', compact('responsable'));
    }
    public function edit_niveau($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_niveau', compact('responsable'));
    }
    // public function edit_departement($id, Request $request){
    //     $liste_dep = Departement::all();
    //     $user_id =  $users = Auth::user()->id;
    //     $responsable_connecte = responsable::where('user_id', $user_id)->exists();
    //     $responsable = responsable::findOrFail($id);
    //     return view('admin.responsable.edit_departement', compact('responsable','liste_dep'));
    // }
    public function edit_branche($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_branche', compact('responsable'));
    }
    public function edit_photos($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_photos', compact('responsable'));
    }
    public function edit_pwd($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_pwd', compact('responsable'));
    }
    public function edit_poste($id, Request $request){
        $user_id =  $users = Auth::user()->id;
        $responsable_connecte = responsable::where('user_id', $user_id)->exists();
        $responsable = responsable::findOrFail($id);
        return view('admin.responsable.edit_poste', compact('responsable'));
    }

    public function update(Request $request)
    {
        if (Gate::allows('isReferent')) {
            $id = responsable::where('user_id', Auth::user()->id)->value('id');
            //modifier les données
            $nom = $request->nom;
            $prenom = $request->prenom;
            $date_naiss = $request->date_naissance;

            $cin = $request->cin;
            $genre = $request->genre;
            $code_postal = $request->code_postal;
            $ville = $request->ville;
            $region = $request->region;
            $quartier = $request->quartier;
            $lot = $request->lot;
            $mail = $request->mail;
           $poste=$request->poste;
            $fonction = $request->fonction;
            $phone =  $request->phone;
            $mdp = $request->password;
            $mdpHash = Hash::make($mdp);
            $input = $request->image;

         //stocker logo dans google drive
            //stocker logo dans google drive

            // $dossier = 'stagiaire';
            // $stock_stg = new getImageModel();
            //  $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());
            if ($image = $request->file('image')) {
                $destinationPath = 'images/responsables';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input= "$profileImage";
            }
            if ($input !=null){
            responsable::where('id', $id)
                ->update([
                    'nom_resp' => $nom,
                    'prenom_resp' => $prenom,
                    'fonction_resp' => $fonction,
                    'email_resp' => $mail,
                    'telephone_resp' => $phone,
                    'date_naissance_resp'=>$date_naiss,
                    'sexe_resp'=>$genre,
                    'cin_resp'=>$cin,
                    'adresse_lot'=>$lot,
                    'adresse_code_postal'=>$code_postal,
                    'adresse_quartier'=>$quartier,
                    'adresse_ville'=>$ville,
                    'adresse_region'=>$region,
                    'poste_resp'=>$poste,
                    'photos'=>$input
                ]);
            }
            else{
                responsable::where('id', $id)
                ->update([
                    'nom_resp' => $nom,
                    'prenom_resp' => $prenom,
                    'fonction_resp' => $fonction,
                    'email_resp' => $mail,
                    'telephone_resp' => $phone,
                    'date_naissance_resp'=>$date_naiss,
                    'sexe_resp'=>$genre,
                    'cin_resp'=>$cin,
                    'adresse_lot'=>$lot,
                    'adresse_code_postal'=>$code_postal,
                    'adresse_quartier'=>$quartier,
                    'adresse_ville'=>$ville,
                    'adresse_region'=>$region,
                    'poste_resp'=>$poste,

                ]);

            }
            User::where('id', Auth::user()->id)
                ->update([
                    'name' => $nom,
                    'email' => $mail,
                    'password' => $mdpHash
                ]);
                entreprise::where('id',$id)->update([
                    'nom_etp'=>$request->entreprise
                ]);
                // Departement::where('id',$id)->update([
                //     'nom_departement'=>$request->departement
                // ]);
                // entreprise::where('id',$id)->update([
                //     'nom_etp'=>$request->entreprise
                // ]);

            return redirect()->route('affResponsable');
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isReferent')) {
            $id = $request->Id;
            $user_id = responsable::where('id', $id)->value('user_id');
            //modifier les données
             // $dossier = 'stagiaire';
            // $stock_stg = new getImageModel();
            //  $stock_stg->store_image($dossier, $input, $request->file('image')->getContent());
            $input = $request->image;
            if ($image = $request->file('image')) {
                $destinationPath = 'images/stagiaires';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input= "$profileImage";
            }
            $nom = $request->Nom;
            $prenom = $request->Prenom;
            $mail = $request->Mail;
            $fonction = $request->Fonction;
            $phone =  $request->Phone;
            if ($input !=null){
            responsable::where('id', $id)
                ->update([
                    'nom_resp' => $nom,
                    'prenom_resp' => $prenom,
                    'fonction_resp' => $fonction,
                    'email_resp' => $mail,
                    'telephone_resp' => $phone,
                    'photos' => $input,
                    'adresse_lot'=>$request->lot,
                    'adresse_region'=>$request->region,
                    'adresse_ville'=>$request->ville,
                    'adresse_quartier'=>$request->quartier,
                    'adresse_code_postal'=>$request->code_postal
                ]);}
                else{
                    responsable::where('id', $id)
                    ->update([
                        'nom_resp' => $nom,
                        'prenom_resp' => $prenom,
                        'fonction_resp' => $fonction,
                        'email_resp' => $mail,
                        'telephone_resp' => $phone,
                        'adresse_lot'=>$request->lot,
                        'adresse_region'=>$request->region,
                        'adresse_ville'=>$request->ville,
                        'adresse_quartier'=>$request->quartier,
                        'adresse_code_postal'=>$request->code_postal
                    ]);
                }
            User::where('id', $user_id)
                ->update([
                    'name' => $nom,
                    'email' => $mail
                ]);
            return redirect()->route('liste_responsable');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $resp = Responsable::findOrFail($id);

        $sup = User::where('id', $resp->user_id)->delete();
        $del = Responsable::where('id', $id)->delete();
        File::delete("images/responsables/" . $resp->photos);

        return back();
    }

    /*
        ====================  Generate PDF Liste de Responsable par Entreprise
    */
    public function generatePDF($id = null)
    {
        $entreprise = new entreprise();
        $responsable = new responsable();

        $nom_entr = null;

        if ($id == null) {
            $entreprises = $entreprise->orderBy('nom_etp')->get();
            $responsables = $responsable->orderBy('nom_resp')->with('User', 'entreprise')->get();
            $info_impression = [
                'id' => null,
                'nom_entreprise' => 'Tout'
            ];
        } else {
            $entreprises = $entreprise->orderBy('nom_etp')->where('id', $id)->get();
            $responsables = $responsable->orderBy('nom_resp')->where('entreprise_id', $id)->get();

            $info_impression = [
                'id' => $entreprises[0]->id,
                'nom_entreprise' => $entreprises[0]->nom_etp
            ];

            $nom_entr = $entreprises[0]->nom_etp;
        }


        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);


        $pdf = PDF::loadView('admin.pdf.pdf_responsable', compact('entreprises', 'responsables', 'info_impression'));
        if ($nom_entr != null) {
            return $pdf->download('Liste(s) Responsable(s) de ' . $nom_entr . '.pdf');
        } else {
            return $pdf->download('Liste(s) Responsable(s).pdf');
        }


        // return view('admin.pdf.pdf_responsable', compact('entreprises', 'responsables', 'info_impression'));
    }

    public function export()
    {

        return Excel::download(new ResponsableExport, 'gestion des responsables.xlsx');
    }

    //editer profil responsable
    public function edit_profil()
    {
        $id = responsable::where('user_id', Auth::user()->id)->value('id');
        $ref = responsable::findOrFail($id);
        return view('admin.responsable.updateResponsable', compact('ref'));
    }
    //fonction récupération photos depuis google drive
    public function getImage($path)
    {
        $dossier = 'responsable';
        $etp = new getImageModel();
        return $etp->get_image($path, $dossier);
    }
}

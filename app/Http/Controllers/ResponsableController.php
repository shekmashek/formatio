<?php

namespace App\Http\Controllers;

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
        //condition de validation de formulaire
        $request->validate(
            [
                'nom' => ["required"],
                'prenom' =>  ["required"],
                'fonction' => ["required"],
                'mail' => ["required"],
                'phone' => ["required"],
                'photos' => ["required"],
                'cin' => ["required"],
                'naissance' => ["required"]
            ],
            [
                'nom.required' => 'Veuillez remplir le champ',
                'prenom.required' => 'Veuillez remplir le champ',
                'fonction.required' =>  'Veuillez remplir le champ',
                'mail.required' =>  'Veuillez remplir le champ',
                'phone.required' => 'Veuillez remplir le champ',
                'photos.required' => 'Veuillez remplir le champ',
                'cin.required' => 'Veuillez remplir le champ',
                'naissance.required' => 'Veuillez remplir le champ'
            ]
        );
        //enregistrer les projets dans la bdd
        $resp = new responsable();
        $resp->nom_resp = $request->nom;
        $resp->prenom_resp = $request->prenom;
        $resp->fonction_resp = $request->fonction;
        $resp->email_resp = $request->mail;
        $resp->cin_resp = $request->cin;
        $resp->date_naissance_resp = $request->naissance;
        $resp->telephone_resp = $request->phone;

        //insertion image
        $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom .  '' . $request->phone . '.' . $request->photos->extension());
        $str = 'images/responsables/';
        //stocker logo dans google drive

        $dossier = 'responsable';
        $stock_resp = new getImageModel();
        $stock_resp->store_image($dossier, $nom_image, $request->file('photos')->getContent());

        // $request->photos->move(public_path($str), $nom_image);
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
        return redirect()->route('liste_responsable');
    }


    public function affReferent($id = null)
    {
        if (Gate::allows('isReferent')) {
            $id = responsable::where('user_id', Auth::user()->id)->value('id');
            $ref = responsable::findOrFail($id);
            return view('admin.responsable.profilResponsable', compact('ref'));
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin') || Gate::allows('isCFP')) {

            $ref = responsable::findOrFail($id);
            return view('admin.responsable.profilResponsable', compact('ref'));
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

    public function update(Request $request)
    {
        if (Gate::allows('isReferent')) {
            $id = responsable::where('user_id', Auth::user()->id)->value('id');

            //modifier les données
            $nom = $request->nom;
            $prenom = $request->prenom;
            $mail = $request->mail;
            $fonction = $request->fonction;
            $phone =  $request->phone;
            $mdp = $request->password;
            $mdpHash = Hash::make($mdp);
            responsable::where('id', $id)
                ->update([
                    'nom_resp' => $nom,
                    'prenom_resp' => $prenom,
                    'fonction_resp' => $fonction,
                    'email_resp' => $mail,
                    'telephone_resp' => $phone,

                ]);
            User::where('id', Auth::user()->id)
                ->update([
                    'name' => $nom,
                    'email' => $mail,
                    'password' => $mdpHash
                ]);
            return redirect()->route('affResponsable');
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isReferent')) {
            $id = $request->Id;
            $user_id = responsable::where('id', $id)->value('user_id');
            //modifier les données
            $nom = $request->Nom;
            $prenom = $request->Prenom;
            $mail = $request->Mail;
            $fonction = $request->Fonction;
            $phone =  $request->Phone;
            responsable::where('id', $id)
                ->update([
                    'nom_resp' => $nom,
                    'prenom_resp' => $prenom,
                    'fonction_resp' => $fonction,
                    'email_resp' => $mail,
                    'telephone_resp' => $phone,

                ]);
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

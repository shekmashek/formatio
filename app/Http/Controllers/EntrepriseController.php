<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\entreprise;
use App\DepartementEntreprise;
use App\User;
use App\cfp;
use App\Secteur;
use App\Mail\entrepriseMail;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
class EntrepriseController extends Controller
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
        // $fonct = new FonctionGenerique();
        // $referent_id = Auth::id();
        // $entreprise_id = Responsable::where('user_id',$referent_id)->value('entreprise_id');

        // $demmande = $fonct->findWhere("v_demmande_etp_pour_cfp",["demmandeur_etp_id"],[$entreprise_id]) ;
        // $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp",["inviter_etp_id"],[$entreprise_id]) ;
        // $cfps= Cfp::all();

        // return view('collaboration.entreprises',compact('cfps','demmande','invitation','entreprise_id'));
    }



    public function create($id = null)
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();
        $entp = new entreprise();


        if (Gate::allows('isCFP')) {
            $cfp_id =  cfp::where('user_id', $user_id)->value('id');
            $etp1 = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);

                $refuse_demmande_etp = $fonct->findWhere("v_refuse_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
                $invitation_etp = $fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]);
                $entreprise = $entp->getEntreprise($etp2,$etp1);

            return view('cfp.profile_entreprise', compact('entreprise','refuse_demmande_etp','invitation_etp'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise =entreprise::orderBy('nom_etp')->with('Secteur')->get()->unique('nom_etp');
            if ($id) $datas = entreprise::orderBy('nom_etp')->take($id)->get();
            else  $datas = entreprise::orderBy("nom_etp")->get();



            // return view('cfp.profile_entreprise', compact('datas', 'entreprise'));
            return view('admin.entreprise.entreprise',compact('datas','entreprise'));
        }
    }


  /*  public function create($id = null)
    {
        if (Gate::allows('isCFP')) {
            $user_id = Auth::id();
            $fonct = new FonctionGenerique();
            $cfp_id =  cfp::where('user_id', $user_id)->value('id');
            $entp = new entreprise();

            $etp1 = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
            $entreprise = $entp->getEntreprise($etp2,$etp1);

            // dd($entreprise);

            if ($id){
                $datas1 = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id","entreprise_id"],[$cfp_id,$id]);
                $datas2 = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id","entreprise_id"],[$cfp_id,$id]);
                $datas = $entp->getEntreprise($datas2,$datas1);
            } else {
                $datas = $entp->getEntreprise($etp2,$etp1);
            }
            // return view('admin.entreprise.entreprise',compact('datas','entreprise'));
            if(count($entreprise  )<=0){
                return view('cfp.guide');
              }
            else{
            return view('cfp.profile_entreprise', compact('datas', 'entreprise'));

            }
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise =entreprise::orderBy('nom_etp')->with('Secteur')->get()->unique('nom_etp');
            if ($id) $datas = entreprise::orderBy('nom_etp')->take($id)->get();
            else  $datas = entreprise::orderBy("nom_etp")->get();
            // return view('cfp.profile_entreprise', compact('datas', 'entreprise'));
            return view('admin.entreprise.entreprise',compact('datas','entreprise'));
        }
    }
*/
    public function listeProjet(Request $request)
    {
        $id_etp = $request->entreprise_id;
        $datas = DB::select('select * from v_projetentreprise where entreprise_id = ' . $id_etp);
        return view('admin.projet.projet_entreprise', compact('datas'));
    }
    public function return_view()
    {
        $secteur = Secteur::all();
        return view('admin.entreprise.nouvelleEntreprise', compact('secteur'));
    }



    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'nom' => ["required"],
                'adresse' =>  ["required"],
                "image" => ["required"],
                "nif" => ["required"],
                "stat" => ["required"],
                "rcs" => ["required"],
                "cif" => ["required"],
                "phone" => ["required"],
            ],
            [
                'nom.required' => 'Veuillez remplir le champ',
                'adresse.required' => 'Veuillez remplir le champ',
                'image.required' => 'Veuillez choisir une photo',
                'nif.required' => 'Veuillez remplir le champ',
                'stat.required' => 'Veuillez remplir le champ',
                'rcs.required' => 'Veuillez remplir le champ',
                'cif.required' => 'Veuillez remplir le champ',
                'phone.required' => 'Veuillez remplir le champ',
            ]
        );

        $entreprise = new entreprise();
        $entreprise->nom_etp = $request->nom;
        $entreprise->email_etp = $request->mail;
        $entreprise->adresse = $request->adresse;
        $entreprise->telephone_etp = $request->phone;
        $entreprise->nif = $request->nif;
        $entreprise->stat = $request->stat;
        $entreprise->rcs = $request->rcs;
        $entreprise->cif = $request->cif;
        $entreprise->secteur_id = $request->secteur;
        $entreprise->site_etp = $request->site;
        $date = date('d-m-Y');
        $nom_image = str_replace(' ', '_', $request->nom.' '.$request->phone. '' . $date . '.' . $request->image->extension());

        $str = 'images/entreprises/';
        //stocker logo dans google drive
        Storage::cloud()->put($nom_image, $request->file('image')->getContent());

        $entreprise->logo = $nom_image;

        $entreprise->save();


        //envoyer un mail de notification à tous les utilisateurs admin
        $emails = User::where('role_id', '1')->get();
        foreach ($emails as $email) {
            Mail::to($email)->send(new EntrepriseMail());
        }
        return redirect()->route('liste_entreprise');
    }

    public function show($id)
    {
        $datas = entreprise::where('id', $id)->get();
        $entreprise = entreprise::orderBy('nom_etp')->get()->unique('nom_etp');
        return view('admin.entreprise.entreprise', compact('datas', 'entreprise'));
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $etp = entreprise::with('Secteur')->where('id', $id)->get();
        return response()->json($etp);
    }

    public function update(Request $request)
    {
        $id = $request->id_value;

        //modifier les données
        $nom = $request->nom_etp;
        $adresse = $request->adresse;
        $telephone = $request->phone;
        $mail = $request->mail;
        $NIF = $request->nif;
        $STAT = $request->stat;
        $CIF = $request->cif;
        $RCS = $request->rcs;
        $site = $request->site;
        entreprise::where('id', $id)
            ->update([
                'nom_etp' => $nom,
                'adresse' => $adresse,
                'nif' => $NIF,
                'stat' => $STAT,
                'rcs' => $RCS,
                'cif' => $CIF,
                'email_etp' => $mail,
                'site_etp' => $site,
                'telephone_etp' => $telephone
            ]);
        return redirect()->route('liste_entreprise');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $del = entreprise::where('id', $id)->delete();
        return back();
    }

    public function profile_entreprise($id)
    {

        $entreprise = entreprise::with('Secteur')->findOrFail($id);
        $departement = DepartementEntreprise::with('Departement')->where('entreprise_id', $id)->get();
        return view('admin.entreprise.profile_entreprise', compact('entreprise', 'departement'));
    }

    public function getImage($path){
        $logo_entreprise = entreprise::get('logo');
        $data_entreprise = db::select('select * from entreprises');

        $nb = count($data_entreprise);

        //recuperer les photos dans google drive
        $content = collect(Storage::cloud()->listContents());
        $file = $content
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($path, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($path, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!

        $rawData = Storage::cloud()->get($file['path']);
        return response($rawData)->header('Content-Type','image.png');
    }
}

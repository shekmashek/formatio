<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\projet;
use App\detail;
use App\stagiaire;
use App\module;
use App\formation;
use App\programme;
use App\groupe;
use App\Mail\convocationStagiaire;
use App\participant_groupe;
use PDF;

class ConvocationMail extends Controller
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
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function sendMail($detail, $groupe)
    {

        $projet_id = detail::where('id', $detail)->value('projet_id');
        $nom_projet = projet::where('id', $projet_id)->value('nom_projet');
        $moduleId = groupe::where('id', $groupe)->value('module_id');
        $nom_module = module::where('id', $moduleId)->get();

        $categories = formation::all();

        $datas_details = detail::where('id', $detail)->with('projet', 'groupe')->get();


        // $sessionId = Detail::where('id',$detail)->value('session_id');
        $datesHeureDetail = detail::where(['id' => $detail, 'groupe_id' => $groupe])->orderBy('date_detail')->get();

        $programmes = programme::all();

        $lieu = detail::where('id', $detail)->value('lieu');

        // $session_id = Detail::where('id',$detail)->value('session_id');
        $debut_session = groupe::where('id', $groupe)->value('date_debut');
        $fin_session = groupe::where('id', $groupe)->value('date_fin');

        $formation_id = module::where('id', $moduleId)->value('formation_id');
        $formation_nom = formation::where('id', $formation_id)->value('nom_formation');

        $stagiaireId = participant_groupe::where('groupe_id', $groupe)->get('stagiaire_id');
        $nb = participant_groupe::where('groupe_id', $groupe)->count();

        $emails = [];
        $nom_stg = [];
        $datas = [
            'subject' => ("Convocation à une formation de " . $formation_nom),
        ];

        for ($i = 0; $i < $nb; $i++) {
            $emails[$i] = stagiaire::where('id', $stagiaireId[$i]->stagiaire_id)->value('mail_stagiaire');
            $nom_stg[$i] = stagiaire::where('id', $stagiaireId[$i]->stagiaire_id)->value('nom_stagiaire');
            $prenom_stg[$i] = stagiaire::where('id', $stagiaireId[$i]->stagiaire_id)->value('prenom_stagiaire');
            $email_stg[$i] =stagiaire::where('id', $stagiaireId[$i]->stagiaire_id)->value('mail_stagiaire');
            $phone_stg[$i] = stagiaire::where('id', $stagiaireId[$i]->stagiaire_id)->value('telephone_stagiaire');
        }

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.pdf.pdf_convocation', compact('nom_module', 'datas_details', 'categories', 'programmes', 'datesHeureDetail'));
        $str = 'public/pdf/' . $nom_projet . '.pdf';
        Storage::put($str, $pdf->output());

        for ($i = 0; $i < $nb; $i++) {
            Mail::to($emails[$i])->send(new convocationStagiaire($nom_module, $nom_projet, $nom_stg[$i], $prenom_stg[$i], $formation_nom, $lieu, $debut_session, $fin_session, $email_stg[$i], $phone_stg[$i]));
        }


        return back()->with(['success' => 'Mail envoyé avec succès!']);
    }
    public function show($detail)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

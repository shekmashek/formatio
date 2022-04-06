<?php

namespace App\Http\Controllers;

use App\encaissement;
use App\Facture;
use App\projet;
use App\TypePayement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\cfp;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\FonctionGenerique;

class EncaissementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        $id_etp = $request->entreprise_id;
        $id_projet = $request->projet_id;
        $id_facture = encaissement::getIdFacture($id_projet);
        if (count($id_facture) > 0) {
            $datas = DB::select('select * from frais_annexes');
            $data = encaissement::getProjetEntreprise($id_etp, $id_projet);
            $infos = encaissement::getFactureEncaissement($id_projet, $id_facture[0]->id);
            return view('admin.encaissement.encaissement', compact('datas', 'data', 'id_facture', 'infos'));
        } else {
            $projet = projet::get()->unique('nom_projet');
            $data = projet::orderBy('nom_projet')->with('entreprise')->take($id_projet)->get();
            $message = "Vous devez facturer d'abord ce projet";
            $typePaye = new TypePayement();
            $fact = new Facture();
            $typePayement = $typePaye->findAll();
            $project = $fact->detailFacture($id_projet);
            return view('admin.facture.creation_facture', compact('project', 'typePayement', 'message'));
        }
    }

    public function encaissement(Request $request)
    {
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [Auth::user()->id]);
        $cfp_id = $resp->cfp_id;
        DB::beginTransaction();
        try {
            encaissement::validation($request);
            encaissement::insert($request, $cfp_id, $resp->id, $resp->nom_resp_cfp . " " . $resp->prenom_resp_cfp);
            DB::commit();
            return back()->with('encaissement_ok', 'Paiement réussi');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Paiements échoué');
        }
    }

    public function liste_encaissement(Request $request)
    {
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

        $numero_fact = $request->num_facture;
        $encaissement = DB::select('select * from v_encaissement where num_facture = ? and cfp_id=?', [$numero_fact, $cfp_id]);
        return view('admin.encaissement.liste_encaissement', compact('encaissement', 'numero_fact'));
    }

    public function generatePDF($numero_fact, Request $request)
    {
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [Auth::user()->id]);
        $cfp_id = $resp->cfp_id;


        // $numero_fact = $request->num_facture;
        $montant_totale = $fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $encaissement = DB::select('select * from v_encaissement where num_facture = ? and cfp_id=?', [$numero_fact, $cfp_id]);

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);


        $pdf = PDF::loadView('admin.pdf.pdf_liste_encaissement', compact('encaissement', 'montant_totale'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        return $pdf->download("liste d'encaissment de la facture numero " . $numero_fact . ".pdf");

        //    return view('admin.pdf.pdf_liste_encaissement', compact('encaissement','montant_totale'));
    }

    public function supprimer(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_encaissement = $request->encaissement_id;
            $numero_fact = encaissement::where('id', $id_encaissement)->value('num_facture');
            encaissement::supprimerAutres($id_encaissement);
            DB::delete('delete from encaissements where id = ?', [$id_encaissement]);
            DB::commit();
            return redirect()->route('listeEncaissement', [$numero_fact]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }


    public function modification(Request $request)
    {
        $id_encaissement = $request->encaissement_id;
        $encaissement = encaissement::where('id', $id_encaissement)->get(['payement', 'libelle', 'num_facture']);
        return response()->json([intval($encaissement[0]->payement), $encaissement[0]->libelle, $encaissement[0]->num_facture]);
    }



    public function modifier(Request $request)
    {
        DB::beginTransaction();
        try {
            encaissement::validation($request);
            $id_encaissement = $request->encaissement_id;
            $montant = $request->montant;
            $libelle = $request->libelle;
            $numero_fact = $request->num_facture;
            encaissement::modifierEncaissementNow($id_encaissement, $montant, $libelle);
            encaissement::modifierAutres($id_encaissement);
            DB::commit();
            return redirect()->route('listeEncaissement', [$numero_fact]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }



    public function frais_annexes(Request $request)
    {
        $id_projet = $request->id_projet;
        $frais = DB::select('select * from v_montant_frais_annexe where projet_id = ?', [$id_projet]);
        return response()->json($frais);
    }

    public function montant_reste_payer(Request $request)
    {
        $user_id = Auth::user()->id;
        // $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

        $numero_fact = $request->num_facture;
        $montant_restant = DB::select('select dernier_montant_ouvert from v_facture_actif where num_facture = ? and cfp_id=?', [$numero_fact, $cfp_id]);
        $montant_restant = number_format($montant_restant[0]->dernier_montant_ouvert, 2, ",", " ");
        return response()->json([$montant_restant, $numero_fact]);
    }
}

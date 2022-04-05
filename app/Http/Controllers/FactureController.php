<?php

namespace App\Http\Controllers;

use App\Facture;
use App\TypePayement;
use App\responsable;
use App\projet;
use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\cfp;
use Illuminate\Support\Facades\Auth;
use App\Collaboration;
use App\Models\getImageModel;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Http\Response;

class FactureController extends Controller
{

    public function __construct()
    {
        $this->fact = new Facture();
        $this->typePaye = new TypePayement();
        $this->fonct = new FonctionGenerique();
        $this->collaboration = new Collaboration();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function fullFacture(Request $request)
    {
        $user_id = Auth::user()->id;


        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $typePayement = $this->typePaye->findAll();
            $entreprise = $this->fonct->findAll("entreprises");
            $project = $this->fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id"], [$cfp_id]);
            $taxe = $this->fonct->findAll("taxes");
            $type_facture = $this->fonct->findAll("type_facture");
            $mode_payement = $this->fonct->findAll("mode_financements");
            $type_remise = $this->fonct->findAll("type_remise");
            return view('admin.facture.nouveau_facture', compact('type_remise', 'cfp', 'project', 'entreprise', 'typePayement', 'taxe', 'mode_payement', 'type_facture'));

            // return view('admin.facture.maquette_entrer_facture', compact('totale_invitation', 'project', 'entreprise', 'typePayement', 'message', 'taxe', 'mode_payement', 'type_facture'));
        }

        /*      if (Gate::allows(['isReferent'])) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id])->entreprise_id;
            $typePayement = $this->typePaye->findAll();
            $entreprise = $this->fonct->findAll("entreprises");
            $project = $this->fonct->findWhere("v_groupe_projet_entreprise", ["entreprise_id"], [$entreprise_id]);
            $taxe = $this->fonct->findAll("taxes");
            $type_facture = $this->fonct->findAll("type_facture");
            $mode_payement = $this->fonct->findAll("mode_financements");
            return view('admin.facture.nouveau_facture', compact('project', 'entreprise', 'typePayement', 'taxe', 'mode_payement', 'type_facture'));
        } */
    }

    public function listeFacture()
    {


        $user_id = Auth::user()->id;
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

        $mode_payement = DB::select('select * from mode_financements');

        /*
        $facture_actif = $this->fonct->findWherePagination("v_facture_actif", ["cfp_id"], [$cfp_id], "facture_id", 0, 10);
        $facture_inactif = $this->fonct->findWherePagination("v_facture_inactif", ["cfp_id"], [$cfp_id], "facture_id", 0, 10);
        $facture_payer = $this->fonct->findWherePagination("v_facture_actif", ["facture_encour", "cfp_id"], ["terminer", $cfp_id], "facture_id", 0, 10);
        $facture_encour = $this->fonct->findWherePagination("v_facture_actif", ["facture_encour", "cfp_id"], ["en_cour", $cfp_id], "facture_id", 0, 10);
*/
        // $facture_inactif = $this->fonct->findWherePagination("v_facture_inactif", ["cfp_id"], [$cfp_id], 0, 10);
        $facture_inactif = $this->fact->getListDataFacture("v_facture_inactif", ["cfp_id"], [$cfp_id], 0, 10);
        $facture_actif = $this->fact->getListDataFacture("v_facture_actif", ["cfp_id"], [$cfp_id], 0, 10);
        $facture_payer = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "cfp_id"], ["terminer", $cfp_id], 0, 10);
        $facture_encour = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "cfp_id"], ["en_cour", $cfp_id], 0, 10);

        // dd($facture_inactif);

        $facture_actif_guide = $this->fonct->findWhere("v_facture_actif", ["cfp_id"], [$cfp_id]);
        $facture_inactif_guide = $this->fonct->findWhere("v_facture_inactif", ["cfp_id"], [$cfp_id]);
        $test = count($facture_inactif_guide) + count($facture_actif_guide);

        $data = $this->fact->pagination($cfp_id);
        if ($test <= 0) {
            return view('admin.facture.guide');
        } else {
            return view('admin.facture.facture', compact('mode_payement', 'facture_actif', 'facture_inactif', 'facture_payer', 'facture_encour', 'data'));
        }
    }


    public function listeFacture_referent()
    {

        $user_id = Auth::user()->id;
        $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id])->entreprise_id;
        $facture_actif = $this->fonct->findWhere("v_facture_actif", ["entreprise_id"], [$entreprise_id]);
        $facture_payer = $this->fonct->findWhere("v_facture_actif", ["facture_encour", "entreprise_id"], ["terminer", $entreprise_id]);
        $facture_encour = $this->fonct->findWhere("v_facture_actif", ["facture_encour", "entreprise_id"], ["en_cour", $entreprise_id]);
        return view('admin.facture.facture_etp', compact('facture_actif', 'facture_payer', 'facture_encour'));
    }

    // ================== Rehcerche Par critère ==================

    public function search_par_date(Request $req)
    {
        $invoice_dte = $req->dte_debut;
        $due_dte = $req->dte_fin;
        $mode_payement = DB::select('select * from mode_financements');


        if ($invoice_dte != null || $due_dte != null) {
            if (Gate::allows('isCFP')) {
                $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
                $facture_actif =  $this->fact->search_intervale_dte_generique_cfp_actifPagination($invoice_dte, $due_dte, $cfp_id, 0, 10);
                $facture_inactif =  $this->fact->search_intervale_dte_generique_cfp_inactifPagination($invoice_dte, $due_dte, $cfp_id, 0, 10);
                $facture_payer =  $this->fact->search_intervale_dte_generique_cfp_payerPagination($invoice_dte, $due_dte, $cfp_id, 0, 10);
                $facture_encour = $this->fact->search_intervale_dte_generique_cfp_en_courPagination($invoice_dte, $due_dte, $cfp_id, 0, 10);
                $data = $this->fact->pagination($cfp_id);
                return view('admin.facture.facture', compact('data', 'mode_payement', 'facture_actif', 'facture_inactif', 'facture_payer', 'facture_encour'));
            }
        } else {
            return back();
        }
    }

    public function search_par_num_fact(Request $req)
    {
        $num_fact = $req->num_fact;
        $mode_payement = DB::select('select * from mode_financements');

        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $facture_actif =  $this->fact->search_num_fact_actif_cfp("v_facture_actif", $num_fact, "valider", $cfp_id);
            $facture_inactif =  $this->fact->search_num_fact_inactif_cfp($num_fact, $cfp_id);
            $facture_payer =  $this->fact->search_num_fact_actif_cfp("v_facture_actif", $num_fact, "terminer", $cfp_id);
            $facture_encour = $this->fact->search_num_fact_actif_cfp("v_facture_actif", $num_fact, "en_cour", $cfp_id);
            $data = $this->fact->pagination($cfp_id);
            return view('admin.facture.facture', compact('data', 'mode_payement', 'facture_actif', 'facture_inactif', 'facture_payer', 'facture_encour'));
        }
    }


    public function redirection_facture()
    {
        if (Gate::allows('isCFP')) {
            return $this->listeFacture();
        }
        if (Gate::allows('isReferent')) {
            return $this->listeFacture_referent();
        }
    }

    public function detail_facture($numero_fact)
    {
        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id","prioriter"], [Auth::user()->id,true])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture_avoir = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "AVOIR", $cfp_id]
            );
            $facture_acompte = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
            $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            if ($montant_totale->rest_payer > 0) {
                $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
            } else {
                $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
            }
        }

      /*  if (Gate::allows('isReferent')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture_avoir = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "AVOIR", $cfp_id]
            );
            $facture_acompte = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
            $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            if ($montant_totale->rest_payer > 0) {
                $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
            } else {
                $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
            }
        }
*/

        return view("admin.facture.detail_facture", compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function detail_facture_etp($cfp_id, $numero_fact)
    {
        if (Gate::allows('isReferent')) {
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $facture_avoir = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "AVOIR", $cfp_id]
            );
            $facture_acompte = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
            $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            if ($montant_totale->rest_payer > 0) {
                $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
            } else {
                $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
            }
        }

        return view("admin.facture.detail_facture", compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function generatePDF($numero_fact)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);

        $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $facture_avoir = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "AVOIR", $cfp_id]
        );

        $facture_acompte = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
        );

        $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

        if ($montant_totale->rest_payer > 0) {
            $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
        } else {
            $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
        }

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('facture de ' . $facture[0]->nom_etp . ' sur le project  ' . $facture[0]->nom_projet . '.pdf');
        //   return view('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function generatePDF_etp($cfp_id, $numero_fact)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);

        $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $facture_avoir = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "AVOIR", $cfp_id]
        );

        $facture_acompte = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
        );

        $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

        if ($montant_totale->rest_payer > 0) {
            $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
        } else {
            $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
        }

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('facture de ' . $facture[0]->nom_etp . ' sur le project  ' . $facture[0]->nom_projet . '.pdf');
        //   return view('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function valid_facture(Request $req)
    {

        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $this->fact->valider_facture_inactif($req->num_facture, $cfp_id);
        return redirect()->route('liste_facture', 2);
    }


    public function conactenation($groupe_id, $fact, $imput)
    {
        $contat_pathBC = '';
        $contat_pathFA = '';
        $contat_file = '';

        $type_fact = $this->fonct->findWhereMulitOne("type_facture", ["id"], [$imput["type_facture"]]);
        $prj_id = $this->fonct->findWhereMulitOne("groupes", ["id"], [$groupe_id[0]])->projet_id;
        $un_projet = $this->fonct->findWhereMulitOne("projets", ["id"], [$prj_id]);
        $un_cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$un_projet->cfp_id]);

        for ($i = 0; $i < count($groupe_id); $i++) {
            $groupe_araika = $this->fonct->findWhereMulitOne(
                "groupes",
                ["id"],
                [$groupe_id[$i]]
            );

            $contat_pathBC .= '' . $groupe_araika->nom_groupe . '_' . $groupe_id[$i] . '_' . $type_fact->reference . '_' . $imput["type_facture"];
            $contat_pathFA .= '' . $groupe_araika->nom_groupe . '_' . $groupe_id[$i] . '_' . $type_fact->reference . '_' . $imput["type_facture"];
            $contat_file .= '' . $groupe_araika->nom_groupe . '_' . $groupe_id[$i] . '_' . $type_fact->reference . '_' . $imput["type_facture"];
            if ($i + 1 < count($groupe_id)) {
                $contat_pathBC .= '_et_';
                $contat_pathFA .= '_et_';
                $contat_file .= '_et_';
            }
        }


        //creation sous dossier Facture/BonCommande/Nom_du_cfp et enregistrement du bc et devis
        $dossier = 'facture';
        $sous_dossier = 'bc';
        $dossier_cfp = $un_cfp->nom . $un_cfp->id;
        $projet_folder = $un_projet->nom_projet . $un_projet->id;
        $bc = new getImageModel();
        $sous_dossier2 = 'devis';


        $res = $this->fact->stockBcetFa('' . $imput->down_bc->extension(), '' . $imput->down_fa->extension(), $contat_file, $contat_pathBC, $contat_pathFA);

        /*
         //creation sous dossier Facture/BonCommande/Nom_du_cfp et enregistrement du bc et devis
        $dossier = 'facture';
        $sous_dossier = 'bc';
        $dossier_cfp = $un_cfp->nom . $un_cfp->id;
        $projet_folder = $un_projet->nom_projet . $un_projet->id;
        $bc = new getImageModel();
        //enregistrement du bc
        $bc->create_sub_directory($dossier, $sous_dossier, $dossier_cfp, $projet_folder, $contat_pathBC, $imput->file('down_bc')->getContent());
        //enregistrement du devis
        $sous_dossier2 = 'devis';
        $res = $this->fact->stockBcetFa('' . $imput->down_bc->extension(), '' . $imput->down_fa->extension(), $contat_file, $contat_pathBC, $contat_pathFA);
        $bc->create_sub_directory($dossier, $sous_dossier2, $dossier_cfp, $projet_folder, $contat_pathBC, $imput->file('down_fa')->getContent());

        */
        return $res;
    }

    public function create(Request $request)
    {
        //    dd($request->input());

        $remise = $this->fonct->findWhereMulitOne("type_remise", ["id"], [$request->type_remise_id]);

        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $tax = $this->fonct->findWhereOne("taxes", "id", "=", $request->tax_id);
        $para = ["groupe_id", "entreprise_id"];
        $path = "";
        $status = null;
        if ($request["session_id"] && $request["facture"]) {

            DB::beginTransaction();
            try {
                //         $path =  $this->conactenation($request["session_id"], $request["facture"], $request);

                for ($i = 0; $i < count($request["session_id"]); $i++) {
                    if ($request["facture"][$i] > 0) {
                        $val = [$request["session_id"][$i], $request->entreprise_id];
                        $result = $this->fonct->findWhereMulitOne("v_groupe_projet_entreprise", $para, $val);
                        $montant_remise = 0;

                        if ($request->remise > 0) {

                            if ($remise->reference == "AR") {
                                $montant_remise = $request->remise;
                            }
                            if ($remise->reference == "POURCENT") {
                                $montant_remise = ($request["facture"][$i] / $request->remise);
                            }
                        }


                        $tabData['facture'] = $request["facture"][$i];
                        $tabData['qte'] = $request["qte"][$i];

                        $tabDataDate['due_date'] = $request['due_date'];
                        $tabDataDate['invoice_date'] = $request['invoice_date'];

                        $tabDataTypeFinance['tax_id'] = $request['tax_id'];
                        $tabDataTypeFinance['id_mode_financement'] = $request['id_mode_financement'];
                        $tabDataTypeFinance['id_type_payement'] = $request['id_type_payement'];

                        $tabDataDesc['description'] = $request['description_facture'];
                        $tabDataDesc['other_message'] = $request['other_message'];
                        $status = $this->fact->verifyCreationFacture(
                            $cfp_id,
                            $result->projet_id,
                            $result->entreprise_id,
                            $result->groupe_entreprise_id,
                            $request,
                            $tabData,
                            $tax->pourcent,
                            $tabDataDate,
                            $tabDataTypeFinance,
                            $tabDataDesc,
                            $request['num_facture']
                        );
                    }
                }

                if ($request["frais_annexe_id"]) {
                    for ($i = 0; $i < count($request["frais_annexe_id"]); $i += 1) {
                        $id_frais = $request["frais_annexe_id"][$i];
                        $montant = $request["montant_frais_annexe"][$i];
                        $qte = $request["qte_annexe"][$i];
                        $desc = $request["description_annexe"][$i];

                        if ($montant > 0) {
                            $this->fact->insert_frais_annexe(
                                $cfp_id,
                                $request->projet_id,
                                $request->entreprise_id,
                                $request['num_facture'],
                                $qte,
                                $id_frais,
                                $montant,
                                $desc,
                                $tax->pourcent
                            );
                        }
                    }
                }

                //            $this->fact->SaveBCetFA($path, $request);
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }

            //return $status;
            return redirect()->route('liste_facture');
        } else {
            return back()->with("error_facture", "désoler,on ne peut creer une facture sans le montant totale! merci");
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Facture $facture)
    {
        //
    }


    public function edit($idProject, Request $req)
    {
        $status = $this->fact->verifyUpdateFacture($idProject, $req);
        return $status;
    }


    public function update(Request $request, Facture $facture)
    {
        //
    }


    public function destroy($num_facture)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $status = $this->fact->verifyDeleteFacture($num_facture, $cfp_id);
        return $status;
    }

    public function getFrais_annexe()
    {
        $data = $this->fonct->findAll("frais_annexes");
        return response()->json($data);
    }

    public function getGroupe_projet(Request $req)
    {
        $data = $this->fonct->findWhere("v_groupe_projet_entreprise_module", ["projet_id", "entreprise_id"], [$req->id, $req->entreprise_id]);

        return response()->json($data);
    }

    public function getTaxe(Request $req)
    {
        $data = $this->fonct->findWhereOne("taxes", "id", "=", $req->id);
        return response()->json($data);
    }
    public function projetFacturer(Request $req)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $data["entreprise"] = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$req->id]);
        $data["projet"] = $this->fonct->findWhere("v_groupe_projet_entreprise", ["entreprise_id", "cfp_id"], [$req->id, $cfp_id]);

        return response()->json($data);
    }

    public function verifyFacture(Request $req)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        return response()->json($this->fact->verifyExistsNumFacture($req->num_facture, $cfp_id));
    }
    public function verifyReferenceBC(Request $req)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        return response()->json($this->fact->verifyExistsReferenceBC($req->reference_bc, $cfp_id));
    }

    public function lecturePDF($path_file)
    {
        $this->fact->lectureFileProjet($path_file);
    }

    public function edit_facture($id)
    {
        return view('admin.facture.edit_facture');
    }
}

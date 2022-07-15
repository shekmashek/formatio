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
use App\GroupeFacture;
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

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);

            $project = $this->fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id"], [$cfp_id]);
            $taxe = $this->fonct->findAll("taxes");
            $type_facture = $this->fonct->findAll("type_facture");
            $mode_payement = $this->fonct->findAll("mode_financements");
            $type_remise = $this->fonct->findAll("type_remise");
            return view('admin.facture.nouveau_facture', compact('devise', 'type_remise', 'cfp', 'project', 'entreprise', 'taxe', 'mode_payement', 'type_facture'));
        }
    }

    public function listeFacture($nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $user_id = Auth::user()->id;
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        $mode_payement = DB::select('select * from mode_financements');
        $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
        $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

        $entreprise = $this->fonct->concatTwoList($etp1, $etp2);

        $nb_limit = 10;

        // public function getNbrePagination($nomTab, $col_para, $para = [], $opt = [], $val = [],$constraint)

        $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["cfp_id"], ["="], [$cfp_id], "AND");

        $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", ["cfp_id"], ["="], [$cfp_id], "AND");
        $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "cfp_id"], ["!=", "="], ["terminer", $cfp_id], "AND");
        $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "cfp_id"], ["=", "="], ["terminer", $cfp_id], "AND");

        $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);

        // dd($pagination_full);
        $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
        $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
        $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);


        if ($nb_pag_full != null && $nb_pag_inactif != null && $nb_pag_actif != null &&  $nbPagination_payer != null) {

            $full_facture = $this->fact->getListDataFacture("v_full_facture", ["cfp_id"], [$cfp_id], $nb_pag_full, $nb_limit, "invoice_date", "DESC");
            $facture_inactif = $this->fact->getListDataFacture("v_facture_inactif", ["cfp_id"], [$cfp_id], $nb_pag_inactif, $nb_limit, "invoice_date", "DESC");
            $facture_actif = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour!", "cfp_id"], ["terminer", $cfp_id], $nb_pag_actif, $nb_limit, "invoice_date", "DESC");
            $facture_payer = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "cfp_id"], ["terminer", $cfp_id], $nbPagination_payer, $nb_limit, "invoice_date", "DESC");
        } else {
            $full_facture = $this->fact->getListDataFacture("v_full_facture", ["cfp_id"], [$cfp_id], 0, $nb_limit, "invoice_date", "DESC");
            $facture_inactif = $this->fact->getListDataFacture("v_facture_inactif", ["cfp_id"], [$cfp_id], 0, $nb_limit, "invoice_date", "DESC");
            $facture_actif = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour!", "cfp_id"], ["terminer", $cfp_id], 0, $nb_limit, "invoice_date", "DESC");
            $facture_payer = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "cfp_id"], ["terminer", $cfp_id], 0, $nb_limit, "invoice_date", "DESC");
        }
        $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);
        $facture_actif_guide = $this->fonct->findWhere("v_facture_actif", ["cfp_id"], [$cfp_id]);
        $facture_inactif_guide = $this->fonct->findWhere("v_facture_inactif", ["cfp_id"], [$cfp_id]);
        $test = count($facture_inactif_guide) + count($facture_actif_guide);
        if ($test <= 0) {
            return view('admin.facture.guide');
        } else {
            return view('admin.facture.facture', compact('pour_list','encaissement', 'devise', 'entreprise', 'pagination_full', 'pagination_brouillon', 'pagination_actif', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_inactif', 'facture_payer'));
        }
    }


    public function listeFacture_referent($nb_pag_full = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null)
    {

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $user_id = Auth::user()->id;
        $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id])->entreprise_id;
        $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
        $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);

        $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);


        $nb_limit = 10;

        $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["activiter", "entreprise_id"], ["=", "="], [True, $entreprise_id], "AND");
        $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);

        $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "entreprise_id"], ["!=", "="], ["terminer", $entreprise_id], "AND");
        $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);

        $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "entreprise_id"], ["=", "="], ["terminer", $entreprise_id], "AND");
        $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);
        // public function findWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)

        if ($nb_pag_full != null && $nb_pag_actif != null &&  $nbPagination_payer != null) {

            $full_facture = $this->fact->getListDataFacture("v_full_facture", ["activiter", "entreprise_id"], [True, $entreprise_id], $nb_pag_full, $nb_limit, "invoice_date", "DESC");
            $facture_actif = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour!", "entreprise_id"], ["terminer", $entreprise_id], $nb_pag_actif, $nb_limit, "invoice_date", "DESC");
            $facture_payer = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "entreprise_id"], ["terminer", $entreprise_id], $nbPagination_payer, $nb_limit, "invoice_date", "DESC");
        } else {
            $full_facture = $this->fact->getListDataFacture("v_full_facture", ["activiter", "entreprise_id"], [True, $entreprise_id], 0, $nb_limit, "invoice_date", "DESC");
            $facture_actif = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour!", "entreprise_id"], ["terminer", $entreprise_id], 0, $nb_limit, "invoice_date", "DESC");
            $facture_payer = $this->fact->getListDataFacture("v_facture_actif", ["facture_encour", "entreprise_id"], ["terminer", $entreprise_id], 0, $nb_limit, "invoice_date", "DESC");
        }
        $encaissement = DB::select('select * from v_encaissement where entreprise_id=?', [$entreprise_id]);
        return view('admin.facture.facture_etp', compact('pour_list','encaissement', 'devise', 'cfp', 'full_facture', 'facture_actif', 'facture_payer', 'pagination_full', 'pagination_actif', 'pagination_payer'));
    }


    public function redirection_facture($nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null)
    {
        if (Gate::allows('isCFP')) {
            return $this->listeFacture($nb_pag_full, $nb_pag_inactif, $nb_pag_actif, $nbPagination_payer, $pour_list);
        }
        if (Gate::allows('isReferent') or Gate::allows('isReferentSimple')) {
            return $this->listeFacture_referent($nb_pag_full, $nb_pag_actif, $nbPagination_payer, $pour_list);
        }
    }

    // ================== Rehcerche Par critère ==================


    public function search_par_intervale_solde(Request $req, $nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null, $solde_debut_pag = null, $solde_fin_pag = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $solde_debut = $req->solde_debut;
        $solde_fin = $req->solde_fin;
        $mode_payement = DB::select('select * from mode_financements');

        $nb_limit = 10;
        if ($solde_debut_pag != null || $solde_fin_pag != null) {
            $solde_debut = $solde_debut_pag;
            $solde_fin = $solde_fin_pag;
        } else {
            $solde_debut = $req->solde_debut;
            $solde_fin = $req->solde_fin;
        }

        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["montant_total", "montant_total", "cfp_id"], [">=", "<=", "="], [$solde_debut, $solde_fin, $cfp_id], "AND");
            $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", ["montant_total", "montant_total", "cfp_id"], [">=", "<=", "="], [$solde_debut, $solde_fin, $cfp_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "montant_total", "montant_total", "cfp_id"], ["!=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $cfp_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "montant_total", "montant_total", "cfp_id"], ["=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $cfp_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["montant_total", "montant_total", "cfp_id"], [">=", "<=", "="], [$solde_debut, $solde_fin, $cfp_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_inactif = $this->fonct->findWhereTrieOrderBy("v_facture_inactif", ["montant_total", "montant_total", "cfp_id"], [">=", "<=", "="], [$solde_debut, $solde_fin, $cfp_id], ["invoice_date"], "DESC", $nb_pag_inactif, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "montant_total", "montant_total", "cfp_id"], ["!=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $cfp_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "montant_total", "montant_total", "cfp_id"], ["=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $cfp_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);

            return view(
                'admin.facture.facture',
                compact('pour_list', 'devise', 'entreprise', 'solde_debut', 'solde_fin', 'facture_payer', 'pagination_actif', 'pagination_brouillon', 'pagination_full', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_inactif', 'facture_payer')
            );
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;


            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["activiter", "montant_total", "montant_total", "entreprise_id"], ["=", ">=", "<=", "="], [True, $solde_debut, $solde_fin, $entreprise_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "montant_total", "montant_total", "entreprise_id"], ["!=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $entreprise_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "montant_total", "montant_total", "entreprise_id"], ["=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $entreprise_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["activiter", "montant_total", "montant_total", "entreprise_id"], ["=", ">=", "<=", "="], [True, $solde_debut, $solde_fin, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "montant_total", "montant_total", "entreprise_id"], ["!=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "montant_total", "montant_total", "entreprise_id"], ["=", ">=", "<=", "="], ["terminer", $solde_debut, $solde_fin, $entreprise_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
            $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
            $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);

            return view(
                'admin.facture.facture_etp',
                compact('pour_list', 'devise', 'cfp', 'solde_debut', 'solde_fin', 'pagination_full', 'pagination_actif', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_payer')
            );
        }
    }


    public function search_par_date(Request $req, $nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null, $invoice_dte_pag = null, $due_dte_pag = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $mode_payement = DB::select('select * from mode_financements');
        $invoice_dte = null;
        $due_dte = null;
        $nb_limit = 10;

        if ($invoice_dte_pag != null && $due_dte_pag != null) {
            $invoice_dte = $invoice_dte_pag;
            $due_dte = $due_dte_pag;
        } else {
            $invoice_dte = $req->dte_debut;
            $due_dte = $req->dte_fin;
        }

        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["invoice_date", "invoice_date", "cfp_id"], [">=", "<=", "="], [$invoice_dte, $due_dte, $cfp_id], "AND");
            $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", ["invoice_date", "invoice_date", "cfp_id"], [">=", "<=", "="], [$invoice_dte, $due_dte, $cfp_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "invoice_date", "invoice_date", "cfp_id"], ["!=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $cfp_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "invoice_date", "invoice_date", "cfp_id"], ["=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $cfp_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["invoice_date", "invoice_date", "cfp_id"], [">=", "<=", "="], [$invoice_dte, $due_dte, $cfp_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_inactif = $this->fonct->findWhereTrieOrderBy("v_facture_inactif", ["invoice_date", "invoice_date", "cfp_id"], [">=", "<=", "="], [$invoice_dte, $due_dte, $cfp_id], ["invoice_date"], "DESC", $nb_pag_inactif, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "invoice_date", "invoice_date", "cfp_id"], ["!=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $cfp_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "invoice_date", "invoice_date", "cfp_id"], ["=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $cfp_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);
            return view(
                'admin.facture.facture',
                compact('pour_list', 'devise', 'entreprise', 'invoice_dte', 'due_dte', 'pagination_full', 'pagination_brouillon', 'pagination_actif', 'pagination_payer', 'mode_payement', 'facture_actif', 'full_facture', 'facture_inactif', 'facture_payer')
            );
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
            $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
            $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
            $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["activiter", "invoice_date", "invoice_date", "entreprise_id"], ["=", ">=", "<=", "="], [True, $invoice_dte, $due_dte, $entreprise_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "invoice_date", "invoice_date", "entreprise_id"], ["!=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $entreprise_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "invoice_date", "invoice_date", "entreprise_id"], ["=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $entreprise_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["activiter", "invoice_date", "invoice_date", "entreprise_id"], ["=", ">=", "<=", "="], [True, $invoice_dte, $due_dte, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "invoice_date", "invoice_date", "entreprise_id"], ["!=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "invoice_date", "invoice_date", "entreprise_id"], ["=", ">=", "<=", "="], ["terminer", $invoice_dte, $due_dte, $entreprise_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            return view(
                'admin.facture.facture_etp',
                compact('pour_list', 'pagination_actif', 'pagination_payer', 'devise', 'cfp', 'invoice_dte', 'due_dte', 'pagination_full', 'mode_payement', 'full_facture', 'facture_actif', 'facture_payer')
            );
        }
    }



    public function search_par_entiter(Request $req, $nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null, $entiter_id_pag = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $mode_payement = DB::select('select * from mode_financements');
        $entiter_id = null;
        $nb_limit = 10;

        if ($entiter_id_pag != null) {
            $entiter_id = $entiter_id_pag;
        } else {
            $entiter_id = $req->entiter_id;
        }
        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["entreprise_id", "cfp_id"], ["=", "="], [$entiter_id, $cfp_id], "AND");
            $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", ["entreprise_id", "cfp_id"], ["=", "="], [$entiter_id, $cfp_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "entreprise_id", "cfp_id"], ["!=", "=", "="], ["terminer", $entiter_id, $cfp_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "entreprise_id", "cfp_id"], ["=", "=", "="], ["terminer", $entiter_id, $cfp_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["entreprise_id", "cfp_id"], ["=", "="], [$entiter_id, $cfp_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_inactif = $this->fonct->findWhereTrieOrderBy("v_facture_inactif", ["entreprise_id", "cfp_id"], ["=", "="], [$entiter_id, $cfp_id], ["invoice_date"], "DESC", $nb_pag_inactif, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "entreprise_id", "cfp_id"], ["!=", "=", "="], ["terminer", $entiter_id, $cfp_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "entreprise_id", "cfp_id"], ["=", "=", "="], ["terminer", $entiter_id, $cfp_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);
            return view(
                'admin.facture.facture',
                compact('pagination_full','pagination_brouillon', 'pagination_actif', 'pagination_payer', 'pour_list', 'devise', 'entreprise', 'entiter_id', 'full_facture', 'mode_payement', 'facture_actif', 'facture_inactif', 'facture_payer')
            );
        }

        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
            $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
            $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
            $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["activiter", "cfp_id", "entreprise_id"], ["=", "=", "="], [True, $entiter_id, $entreprise_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "cfp_id", "entreprise_id"], ["!=", "=", "="], ["terminer", $entiter_id, $entreprise_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "cfp_id", "entreprise_id"], ["=", "=", "="], ["terminer", $entiter_id, $entreprise_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["activiter", "cfp_id", "entreprise_id"], ["=", "=", "="], [True, $entiter_id, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "cfp_id", "entreprise_id"], ["!=", "=", "="], ["terminer", $entiter_id, $entreprise_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "cfp_id", "entreprise_id"], ["=", "=", "="], ["terminer", $entiter_id, $entreprise_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);
            return view(
                'admin.facture.facture_etp',
                compact('pour_list', 'devise','encaissement', 'cfp', 'entiter_id', 'pagination_full', 'pagination_actif', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_payer')
            );
        }
    }


    public function search_par_status(Request $req, $nb_pag_full = null, $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null, $status_pag = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $mode_payement = DB::select('select * from mode_financements');
        $nb_limit = 10;
        $status = null;
        $para = [];
        $opt = [];
        $val = [];
        $para_inactif = [];
        $opt_inactif = [];
        $val_inactif = [];
        $para_actif = [];
        $opt_actif = [];
        $val_actif = [];
        $para_payer = [];
        $opt_payer = [];
        $val_payer = [];

        if ($status_pag != null) {
            $status = $status_pag;
        } else {
            $status = $req->status;
        }
        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);

            if ($status == "EN_COUR") { // partiellement payer
                $para = ["cfp_id", "facture_encour", "jour_restant", "activiter"];
                $opt = ["=", "=", ">=", "="];
                $val = [$cfp_id, "en_cour", 1, True];

                $para_inactif =  ["cfp_id", "facture_encour", "activiter"];
                $opt_inactif = ["=", "=", "="];
                $val_inactif = [$cfp_id, "en_cour", True];

                $para_actif =  ["cfp_id", "facture_encour", "jour_restant", "activiter"];
                $opt_actif = ["=", "=", ">=", "="];
                $val_actif = [$cfp_id, "en_cour", 1, True];

                $para_payer =  ["cfp_id", "facture_encour", "activiter"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$cfp_id, "en_cour", False];
            } else if ($status == "ACTIF") { // actif

                $para = ["cfp_id", "activiter", "facture_encour"];
                $opt = ["=", "=", "!="];
                $val = [$cfp_id, True, "terminer"];

                $para_inactif =  ["cfp_id", "facture_encour", "activiter"];
                $opt_inactif = ["=", "=", "="];
                $val_inactif = [$cfp_id, "en_cour", True];

                $para_actif =  ["cfp_id", "facture_encour", "activiter"];
                $opt_actif = ["=", "!=", "="];
                $val_actif = [$cfp_id, "terminer", True];

                $para_payer =  ["cfp_id", "facture_encour", "activiter"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$cfp_id, "terminer", False];

                // dd($para);
            } else if ($status == "INACTIF") { // inactif

                $para = ["cfp_id", "activiter"];
                $opt = ["=", "="];
                $val = [$cfp_id, FALSE];

                $para_inactif = ["cfp_id", "activiter"];
                $opt_inactif = ["=", "="];
                $val_inactif = [$cfp_id, FALSE];

                $para_actif = ["cfp_id", "activiter"];
                $opt_actif = ["=", "="];
                $val_actif = [$cfp_id, FALSE];

                $para_payer = ["cfp_id", "activiter"];
                $opt_payer = ["=", "="];
                $val_payer = [$cfp_id, FALSE];
            } else if ($status == "PAYER") { // payer

                $para = ["cfp_id", "dernier_montant_ouvert", "activiter", "facture_encour"];
                $opt = ["=", "<=", "=", "="];
                $val = [$cfp_id, 0, True, "terminer"];

                $para_inactif = ["cfp_id", "activiter"];
                $opt_inactif = ["=", "="];
                $val_inactif = [$cfp_id, True];

                $para_actif = ["cfp_id", "activiter"];
                $opt_actif = ["=", "="];
                $val_actif = [$cfp_id, FALSE];

                $para_payer = ["cfp_id", "activiter", "facture_encour"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$cfp_id, True, "terminer"];
            } else { // retard

                $para = ["cfp_id", "jour_restant", "facture_encour"];
                $opt = ["=", "<=", "!="];
                $val = [$cfp_id, 0, "terminer"];

                $para_inactif = ["cfp_id", "activiter", "jour_restant"];
                $opt_inactif = ["=", "=", "<="];
                $val_inactif = [$cfp_id, FALSE, 0];

                $para_actif = ["cfp_id", "activiter", "jour_restant", "facture_encour"];
                $opt_actif = ["=", "=", "<=", "!="];
                $val_actif = [$cfp_id, True, 0, "terminer"];

                $para_payer = ["cfp_id", "activiter", "facture_encour"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$cfp_id, FALSE, "terminer"];
            }

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", $para, $opt, $val, "AND");
            $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", $para_inactif, $opt_inactif, $val_inactif, "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", $para_actif, $opt_actif, $val_actif, "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", $para_payer, $opt_payer, $val_payer, "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", $para, $opt, $val, ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_inactif = $this->fonct->findWhereTrieOrderBy("v_facture_inactif", $para_inactif, $opt_inactif, $val_inactif, ["invoice_date"], "DESC", $nb_pag_inactif, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", $para_actif, $opt_actif, $val_actif, ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", $para_payer, $opt_payer, $val_payer, ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            return view(
                'admin.facture.facture',
                compact('pagination_full', 'pagination_brouillon', 'pagination_actif', 'pagination_payer', 'pour_list', 'devise', 'entreprise', 'status', 'full_facture', 'mode_payement', 'facture_actif', 'facture_inactif', 'facture_payer')
            );
        }

        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
            $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
            $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
            $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);

            if ($status == "EN_COUR") { // partiellement payer

                $para = ["entreprise_id", "facture_encour", "jour_restant", "activiter"];
                $opt = ["=", "=", ">=", "="];
                $val = [$entreprise_id, "en_cour", 1, True];

                $para_actif =  ["entreprise_id", "facture_encour", "jour_restant", "activiter"];
                $opt_actif = ["=", "=", ">=", "="];
                $val_actif = [$entreprise_id, "en_cour", 1, True];

                $para_payer =  ["entreprise_id", "facture_encour", "activiter"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$entreprise_id, "en_cour", False];
            } else if ($status == "ACTIF") { // actif

                $para = ["entreprise_id", "activiter", "facture_encour"];
                $opt = ["=", "=", "!="];
                $val = [$entreprise_id, True, "terminer"];

                $para_actif =  ["entreprise_id", "facture_encour", "activiter"];
                $opt_actif = ["=", "!=", "="];
                $val_actif = [$entreprise_id, "terminer", True];

                $para_payer =  ["entreprise_id", "facture_encour", "activiter"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$entreprise_id, "terminer", False];
            } else if ($status == "PAYER") { // payer

                $para = ["entreprise_id", "dernier_montant_ouvert", "activiter", "facture_encour"];
                $opt = ["=", "<=", "=", "="];
                $val = [$entreprise_id, 0, True, "terminer"];

                $para_actif = ["entreprise_id", "activiter"];
                $opt_actif = ["=", "="];
                $val_actif = [$entreprise_id, FALSE];

                $para_payer = ["entreprise_id", "activiter", "facture_encour"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$entreprise_id, True, "terminer"];
            } else { // retard

                $para = ["entreprise_id", "jour_restant", "facture_encour", "activiter"];
                $opt = ["=", "<=", "!=", "="];
                $val = [$entreprise_id, 0, "terminer", True];

                $para_actif = ["entreprise_id", "activiter", "jour_restant", "facture_encour"];
                $opt_actif = ["=", "=", "<=", "!="];
                $val_actif = [$entreprise_id, True, 0, "terminer"];

                $para_payer = ["entreprise_id", "activiter", "facture_encour"];
                $opt_payer = ["=", "=", "="];
                $val_payer = [$entreprise_id, FALSE, "terminer"];
            }
            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", $para, $opt, $val, "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", $para_actif, $opt_actif, $val_actif, "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", $para_payer, $opt_payer, $val_payer, "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", $para, $opt, $val, ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", $para_actif, $opt_actif, $val_actif, ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", $para_payer, $opt_payer, $val_payer, ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            return view(
                'admin.facture.facture_etp',
                compact('pour_list', 'devise', 'cfp', 'status', 'pagination_full', 'pagination_actif', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_payer')
            );
        }
    }

    public function search_par_num_fact(Request $req, $nb_pag_full = null,  $nb_pag_inactif = null, $nb_pag_actif = null, $nbPagination_payer = null, $pour_list = null, $num_fact_pag = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $mode_payement = DB::select('select * from mode_financements');
        $num_fact = null;
        $nb_limit = 10;

        if ($num_fact_pag != null) {
            $num_fact = $num_fact_pag;
        } else {
            $num_fact = $req->num_fact;
        }

        if ($nb_pag_full <= 0 || $nb_pag_full == null) {
            $nb_pag_full = 1;
        }

        if ($nb_pag_inactif <= 0 || $nb_pag_inactif == null) {
            $nb_pag_inactif = 1;
        }

        if ($nb_pag_actif <= 0 || $nb_pag_actif == null) {
            $nb_pag_actif = 1;
        }

        if ($nbPagination_payer <= 0 || $nbPagination_payer == null) {
            $nbPagination_payer = 1;
        }

        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["num_facture", "cfp_id"], ["LIKE", "="], ["%" . $num_fact . "%", $cfp_id], "AND");
            $totale_pag_brouillon = $this->fonct->getNbrePagination("v_facture_inactif", "num_facture", ["num_facture", "cfp_id"], ["LIKE", "="], ["%" . $num_fact . "%", $cfp_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "num_facture", "cfp_id"], ["!=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $cfp_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "num_facture", "cfp_id"], ["=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $cfp_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_brouillon = $this->fonct->nb_liste_pagination($totale_pag_brouillon, $nb_pag_inactif, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["num_facture", "cfp_id"], ["LIKE", "="], ["%" . $num_fact . "%", $cfp_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_inactif = $this->fonct->findWhereTrieOrderBy("v_facture_inactif", ["num_facture", "cfp_id"], ["LIKE", "="], ["%" . $num_fact . "%", $cfp_id], ["invoice_date"], "DESC", $nb_pag_inactif, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "num_facture", "cfp_id"], ["!=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $cfp_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "num_facture", "cfp_id"], ["=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $cfp_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            $etp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);
            $entreprise = $this->fonct->concatTwoList($etp1, $etp2);
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);
            return view(
                'admin.facture.facture',
                compact('pour_list', 'devise', 'entreprise', 'num_fact', 'pagination_full', 'pagination_brouillon', 'pagination_actif', 'pagination_payer', 'mode_payement', 'full_facture', 'facture_actif', 'facture_inactif', 'facture_payer')
            );
        }

        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
            $cfp1 = $this->fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
            $cfp2 = $this->fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
            $cfp = $this->fonct->concatTwoList($cfp1, $cfp2);

            $totale_pag_full = $this->fonct->getNbrePagination("v_full_facture", "num_facture", ["activiter", "num_facture", "entreprise_id"], ["=", "LIKE", "="], [True, "%" . $num_fact . "%", $entreprise_id], "AND");
            $totale_pag_actif = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "num_facture", "entreprise_id"], ["!=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $entreprise_id], "AND");
            $totale_pag_payer = $this->fonct->getNbrePagination("v_facture_actif", "num_facture", ["facture_encour", "num_facture", "entreprise_id"], ["=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $entreprise_id], "AND");

            $pagination_full = $this->fonct->nb_liste_pagination($totale_pag_full, $nb_pag_full, $nb_limit);
            $pagination_actif = $this->fonct->nb_liste_pagination($totale_pag_actif, $nb_pag_actif, $nb_limit);
            $pagination_payer = $this->fonct->nb_liste_pagination($totale_pag_payer, $nbPagination_payer, $nb_limit);

            $full_facture = $this->fonct->findWhereTrieOrderBy("v_full_facture", ["activiter", "num_facture", "entreprise_id"], ["=", "LIKE", "="], [True, "%" . $num_fact . "%", $entreprise_id], ["invoice_date"], "DESC", $nb_pag_full, $nb_limit);
            $facture_actif =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "num_facture", "entreprise_id"], ["!=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $entreprise_id], ["invoice_date"], "DESC", $nb_pag_actif, $nb_limit);
            $facture_payer =  $this->fonct->findWhereTrieOrderBy("v_facture_actif", ["facture_encour", "num_facture", "entreprise_id"], ["=", "LIKE", "="], ["terminer", "%" . $num_fact . "%", $entreprise_id], ["invoice_date"], "DESC", $nbPagination_payer, $nb_limit);

            return view(
                'admin.facture.facture_etp',
                compact('pour_list', 'devise', 'cfp', 'num_fact', 'pagination_full', 'pagination_actif', 'pagination_payer', 'full_facture', 'mode_payement', 'facture_actif', 'facture_payer')
            );
        }
    }



    public function detail_facture($numero_fact)
    {

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

            $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);
            $facture_avoir = $this->fonct->findWhere(
                "v_liste_facture",
                ["projet_id", "UPPER(reference_facture)", "cfp_id"],
                [$montant_totale->projet_id, "AVOIR", $cfp_id]
            );
            $facture_acompte = $this->fonct->findWhere(
                "v_facture_inactif",
                ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
            if (count($facture_acompte) <= 0) {
                $facture_acompte = $this->fonct->findWhere(
                    "v_facture_actif",
                    ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
                    [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
                );
            }
            $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            if ($montant_totale->rest_payer > 0) {
                $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
            } else {
                $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
            }
            return view("admin.facture.detail_facture", compact('devise', 'entreprise', 'cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
        }
    }


    public function detail_facture_etp($cfp_id, $numero_fact)
    {

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);

        $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);

        $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $facture_avoir = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "AVOIR", $cfp_id]
        );
        $facture_acompte = $this->fonct->findWhere(
            "v_facture_inactif",
            ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
            [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
        );
        if (count($facture_acompte) <= 0) {
            $facture_acompte = $this->fonct->findWhere(
                "v_facture_actif",
                ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
        }
        $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        if ($montant_totale->rest_payer > 0) {
            $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
        } else {
            $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
        }


        return view("admin.facture.detail_facture", compact('devise', 'entreprise', 'cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function generatePDF($numero_fact)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
        $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

        $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);
        $facture_avoir = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "AVOIR", $cfp_id]
        );
        $facture_acompte = $this->fonct->findWhere(
            "v_facture_inactif",
            ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
            [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
        );
        if (count($facture_acompte) <= 0) {
            $facture_acompte = $this->fonct->findWhere(
                "v_facture_actif",
                ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
        }
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

        $pdf = PDF::loadView('admin.pdf.pdf_facture', compact('devise', 'entreprise', 'cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('facture de ' . $entreprise->nom_etp . ' sur le project  ' . $facture[0]->nom_projet . '.pdf');
        //   return view('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function generatePDF_etp($cfp_id, $numero_fact)
    {
        $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

        $facture = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
        $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);
        $facture_avoir = $this->fonct->findWhere(
            "v_liste_facture",
            ["projet_id", "UPPER(reference_facture)", "cfp_id"],
            [$montant_totale->projet_id, "AVOIR", $cfp_id]
        );
        $facture_acompte = $this->fonct->findWhere(
            "v_facture_inactif",
            ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
            [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
        );
        if (count($facture_acompte) <= 0) {
            $facture_acompte = $this->fonct->findWhere(
                "v_facture_actif",
                ["projet_id", "UPPER(reference_type_facture)", "cfp_id"],
                [$montant_totale->projet_id, "ACOMPTE", $cfp_id]
            );
        }
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

        $pdf = PDF::loadView('admin.pdf.pdf_facture', compact('devise', 'entreprise', 'cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('facture de ' . $entreprise->nom_etp . ' sur le project  ' . $facture[0]->nom_projet . '.pdf');
        //   return view('admin.pdf.pdf_facture', compact('cfp', 'facture', 'frais_annexes', 'montant_totale', 'facture_avoir', 'facture_acompte', 'lettre_montant'));
    }

    public function valid_facture(Request $req)
    {

        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $this->fact->valider_facture_inactif($req->num_facture, $cfp_id);
        return redirect()->route('liste_facture');
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
        return $res;
    }

    public function create(Request $request)
    {

        $remise = $this->fonct->findWhereMulitOne("type_remise", ["id"], [$request->type_remise_id]);
        $type_facture = $this->fonct->findWhereMulitOne("type_facture", ["id"], [$request->type_facture]);
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

        $para = ["groupe_id", "entreprise_id"];
        $path = "";
        $status = null;
        $prix_sess =0;

        if ($request->type_facture > 0 && $request->id_mode_financement > 0 && $request->entreprise_id > 0) {
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$request->entreprise_id]);
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $assujeti_cfp = $this->fonct->findWhereMulitOne("assujetti", ["id"], [$cfp->assujetti_id]);
            $assujeti_etp = $this->fonct->findWhereMulitOne("assujetti", ["id"], [$entreprise->assujetti_id]);
            $tax_id = $this->fonct->findWhereMulitOne("taxes", ["pourcent"], [0.00])->id;
            $tabDataTypeFinance['tax_id'] = $tax_id;

            if ($assujeti_cfp->assujetti == 1 && $assujeti_etp->assujetti == 1) {
                $tax_id = $this->fonct->findWhereMulitOne("taxes", ["description"], ["TVA"])->id;
                $tabDataTypeFinance['tax_id'] = $tax_id;
            }
            $verify_num_fact = $this->fonct->findWhere("factures", ["num_facture"], [$request['num_facture']]);
            if (count($verify_num_fact) <= 0) {
                $verify_session_exist = $this->fact->veriry_session_deja_facture_sur_type_fact($cfp_id, $request->projet_id, $request);
                if ($verify_session_exist <= 0) {

                    if ($request["session_id"] && $request["facture"]) {

                        DB::beginTransaction();
                        try {

                            for ($i = 0; $i < count($request["session_id"]); $i++) {
                                $val = [$request["session_id"][$i], $request->entreprise_id];

                                $tabData['facture'] = $request["facture"][$i];
                                $tabData['qte'] = $request["qte"][$i];
                                $tabDataDate['due_date'] = $request['due_date'];
                                $tabDataDate['invoice_date'] = $request['invoice_date'];
                                $tabDataTypeFinance['id_mode_financement'] = $request['id_mode_financement'];
                                $tabDataDesc['description'] = $request['description'][$i];
                                $tabDataDesc['other_message'] = $request['other_message'];
                                $tabDataDesc['remise'] = $request->remise;
                                $tabDataDesc['remise_id'] = $request->type_remise_id;
                                $prix_sess =$request["facture"][$i] * $request["qte"][$i];
                                
                               
                                $this->fact->insert(
                                    $cfp_id,
                                    $request->projet_id,
                                    $request->entreprise_id,
                                    $request["session_id"][$i],
                                    $tabData,
                                    $tabDataDate,
                                    $tabDataTypeFinance,
                                    $tabDataDesc,
                                    $request['num_facture'],
                                    $request["reference_bc"],
                                    $tabDataDesc["remise"],
                                    $request["type_facture"]
                                ); 
                                if ($request->remise) {
                                    if ( $request->type_remise_id == 1) {
                                        $montant_remise = ($request->remise)/count($request["session_id"]);
                                        // $pourcent =  $request->remise / $prix_sess;
                                        // $montant_remise = $prix_sess * $pourcent;
                                    }else if( $request->type_remise_id == 2){
                                        $montant_remise =  ($prix_sess * $request->remise) / 100;
                                    }
                                   
                                    $montant_session =  $prix_sess - $montant_remise;
                                    $gp_facture = new GroupeFacture();
                                    $gp_facture->groupe_id = $request["session_id"][$i];
                                    $gp_facture->qte= $request["qte"][$i];
                                    $gp_facture->montant= $montant_session;
                                    $gp_facture->save();
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
                                            $desc
                                        );
                                    }
                                }
                            }
                            return redirect()->route("liste_facture");
                        } catch (\Exception $e) {
                            DB::rollback();
                            echo $e->getMessage();
                        }
                    } else {
                        return back()->with("error", "désoler,on ne peut creer une facture sans le montant totale! merci");
                    }
                } else {

                    return back()->with("error", "l'une des sessions ont été déjà facturer sur le type de facture '" . $type_facture->reference . "'");
                }
            } else {
                return back()->with("error", "le numero de la facture a été déjà utilisé! merci");
            }
        } else {
            return back()->with("error", "l'une de votre champs est invalid comme (type facture ou type de mode payement)! merci");
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

    public function getGroupe_projet_edit(Request $req)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

        $session_deja_facturer = $this->fonct->findWhere(
            "factures",
            ["num_facture", "projet_id", "entreprise_id", "cfp_id"],
            [$req->num_facture, $req->id, $req->entreprise_id, $cfp_id]
        );

        $val = [];
        $para = [];
        $option = [];
        for ($i = 0; $i < count($session_deja_facturer); $i += 1) {
            $val[$i] = $session_deja_facturer[$i]->groupe_entreprise_id;
            $para[$i] = "groupe_entreprise_id";
            $option[$i] = "!=";
        }
        $data = $this->fact->findWhereParam(
            "v_groupe_projet_entreprise_module",
            $para,
            $option,
            $val,
            ["projet_id", "entreprise_id", "cfp_id"],
            [$req->id, $req->entreprise_id, $cfp_id]
        );
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
        $assujetti = $this->fonct->findWhereMulitOne("assujetti", ["id"], [$data["entreprise"]->assujetti_id]);
        if ($assujetti->assujetti == true) { // true
            $data["taxes"] = $this->fonct->findWhereMulitOne("taxes", ["id"], [1]); // tva
        } else { // false
            $data["taxes"] = $this->fonct->findWhereMulitOne("taxes", ["id"], [2]); // HT
        }
        // $data["taxes"] = $assujetti;

        $data["projet"] = $this->fonct->findWhere("v_projet_facture", ["entreprise_id", "cfp_id"], [$req->id, $cfp_id]);
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


    public function edit_facture($numero_fact)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        if (Gate::allows('isCFP')) {
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $cfp = $this->fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            $montant_totale = $this->fonct->findWhereMulitOne("v_facture_existant", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);
            $projet = $this->fonct->findWhereMulitOne("projets", ["id"], [$montant_totale->projet_id]);

            $init_session = $this->fonct->findWhere("groupes", ["projet_id"], [$projet->id]);

            $session = $this->fonct->findWhere("v_liste_facture", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);
            $frais_annexes = $this->fonct->findWhere("v_frais_annexe", ["num_facture", "cfp_id"], [$numero_fact, $cfp_id]);

            // $taxe = $this->fonct->findWhereParam("taxes", ["id"], ["!="], [$session[0]->tax_id]);
            $type_facture = $this->fonct->findWhereParam("type_facture", ["id"], ["!="], [$session[0]->type_facture_id]);
            $mode_payement = $this->fonct->findWhereParam("mode_financements", ["id"], ["!="], [$session[0]->type_facture_id]);
            $type_remise = $this->fonct->findWhereParam("type_remise", ["id"], ["!="], [$montant_totale->remise_id]);

            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$montant_totale->entreprise_id]);
            $assujetti = $this->fonct->findWhereMulitOne("assujetti", ["id"], [$entreprise->assujetti_id]);
            if ($assujetti->assujetti == true) { // true
                $taxes = $this->fonct->findWhereMulitOne("taxes", ["id"], [1]); // tva
            } else { // false
                $taxes = $this->fonct->findWhereMulitOne("taxes", ["id"], [2]); // HT
            }

            if ($montant_totale->rest_payer > 0) {
                $lettre_montant = $this->fact->int2str($montant_totale->dernier_montant_ouvert);
            } else {
                $lettre_montant = $this->fact->int2str($montant_totale->net_ttc);
            }

            return view('admin.facture.edit_facture', compact('lettre_montant','taxes','devise', 'init_session', 'mode_payement', 'type_remise', 'projet', 'entreprise', 'type_facture', 'cfp', 'montant_totale', 'session', 'frais_annexes'));
        }
    }


    public function modifier_facture($num_facture, $entreprise_id, Request $request)
    {
        $remise = $this->fonct->findWhereMulitOne("type_remise", ["id"], [$request->type_remise_id]);
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;

        $tax = $this->fonct->findWhereOne("taxes", "id", "=", $request->tax_id);
        $para = ["groupe_id", "entreprise_id"];
        $path = "";
        $status = null;
        if ($request["session_id"]) {

            DB::beginTransaction();
            try {
                if ($request["facture"]) {
                    for ($i = 0; $i < count($request["session_id"]); $i++) {
                        if ($request["facture"][$i] > 0) {
                            $val = [$request["session_id"][$i], $request->entreprise_id];

                            $tabData['facture'] = $request["facture"][$i];
                            $tabData['qte'] = $request["qte"][$i];

                            $tabDataDate['due_date'] = $request['due_date'];
                            $tabDataDate['invoice_date'] = $request['invoice_date'];

                            $tabDataTypeFinance['id_mode_financement'] = $request['id_mode_financement'];

                            $tabDataDesc['description'] = $request['description'][$i];
                            $tabDataDesc['other_message'] = $request['other_message'];
                            $tabDataDesc['remise'] = $request->remise;
                            $tabDataDesc['remise_id'] = $request->type_remise_id;

                            $this->fact->update_facture(
                                $cfp_id,
                                $request['projet_id'],
                                $entreprise_id,
                                $request["session_id"][$i],
                                $tabData,
                                $tabDataDate,
                                $tabDataTypeFinance,
                                $tabDataDesc,
                                $request['num_facture'],
                                $request["reference_bc"],
                                $tabDataDesc["remise"],
                                $request["type_facture"]
                            );
                        }
                    }
                }
                if ($request["facture_new"]) {
                    for ($i = 0; $i < count($request["session_id_new"]); $i++) {

                        if ($request["facture_new"][$i] > 0) {
                            $val = [$request["session_id_new"][$i], $request->entreprise_id];

                            $tabDatas['facture'] = $request["facture"][$i];
                            $tabDatas['qte'] = $request["qte"][$i];

                            $tabDataDates['due_date'] = $request['due_date'];
                            $tabDataDates['invoice_date'] = $request['invoice_date'];

                            $tabDataTypeFinances['tax_id'] = $request['tax_id'];
                            $tabDataTypeFinances['id_mode_financement'] = $request['id_mode_financement'];
                            // $tabDataTypeFinances['id_type_payement'] = $request['id_type_payement'];

                            $tabDataDescs['description'] = $request['description_new'][$i];
                            $tabDataDescs['other_message'] = $request['other_message'];
                            $tabDataDescs['remise'] = $request->remise;
                            $tabDataDescs['remise_id'] = $request->type_remise_id;

                            $this->fact->insert(
                                $cfp_id,
                                $request['projet_id'],
                                $entreprise_id,
                                $request["session_id_new"][$i],
                                $tabDatas,
                                $tabDataDescs['remise'],
                                $tabDataDates,
                                $tabDataTypeFinances,
                                $tabDataDescs,
                                $num_facture,
                                $request['reference_bc'],
                                $tabDataDescs['remise'],
                                $request['type_facture']
                            );
                        }
                    }
                }


                if ($request["frais_annexe_id"]) {
                    for ($i = 0; $i < count($request["frais_annexe_id"]); $i += 1) {
                        $id_frais = $request["frais_annexe_id"][$i];
                        $montant = $request["montant_frais_annexe"][$i];
                        $qte = $request["qte_annexe"][$i];
                        $desc = $request["description_annexe"][$i];

                        if ($montant > 0) {
                            $this->fact->update_frais_annexe(
                                $cfp_id,
                                $request['projet_id'],
                                $entreprise_id,
                                $request['num_facture'],
                                $qte,
                                $id_frais,
                                $montant,
                                $desc
                            );
                        }
                    }
                }

                if ($request["frais_annexe_id_new"]) {


                    for ($i = 0; $i < count($request["frais_annexe_id_new"]); $i += 1) {
                        $id_frais_new = $request["frais_annexe_id_new"][$i];
                        $montant_new = $request["montant_frais_annexe_new"][$i];
                        $qte_new = $request["qte_annexe_new"][$i];
                        $desc_new = $request["description_annexe_new"][$i];
                        if ($montant_new > 0) {
                            $this->fact->insert_frais_annexe(
                                $cfp_id,
                                $request['projet_id'],
                                $entreprise_id,
                                $request['num_facture'],
                                $qte_new,
                                $id_frais_new,
                                $montant_new,
                                $desc_new
                            );
                        }
                    }
                }
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
            return redirect()->route('liste_facture');
        } else {
            return back()->with("error_facture", "désoler,on ne peut creer une facture sans le montant totale! merci");
        }

        // return redirect()->route('liste_facture');
    }

    public function delete_session_facture($num_facture, $groupe_entreprise_id)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        $session_fact = $this->fonct->findWhere("factures", ["num_facture", "cfp_id"], [$num_facture, $cfp_id]);
        DB::beginTransaction();

        if (count($session_fact) > 1) {
            try {
                DB::delete('delete from factures where num_facture = ? and cfp_id=? and groupe_entreprise_id=?', [$num_facture, $cfp_id, $groupe_entreprise_id]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
            return back();
        } else {
            try {
                DB::delete('delete from factures where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
            return redirect()->route("liste_facture");
        }
    }

    public function delete_frais_annexe_facture($num_facture, $frais_annexe_id)
    {
        $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
        DB::delete('delete from montant_frais_annexes where num_facture = ? and cfp_id=? and frais_annexe_id=?', [$num_facture, $cfp_id, $frais_annexe_id]);

        return back();
    }


    // ====================================================JSON pour les tries par COLONNE TABLE


    public function trie_par(Request $req)
    {
        $nb_limit = 10;

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $data_num_fact_trie = null;
        $rep_par_trie = "";
        $para = [];
        $opt = [];
        $val = [];
        $para_inactif = [];
        $opt_inactif = [];
        $val_inactif = [];
        $para_actif = [];
        $opt_actif = [];
        $val_actif = [];
        $para_payer = [];
        $opt_payer = [];
        $val_payer = [];

        $arrow='<i class="fa icon_trie fa-arrow-down"></i>';
        // -------------------------------------------------------------
        if (Gate::allows('isCFP')) {
            // ---------------------------------- ts mhz fafana
            if ($req->data_value == 0) {
                $data_num_fact_trie = "ASC";
                $arrow='<i class="fa icon_trie fa-arrow-up"></i>';
            } else {
                $data_num_fact_trie = "DESC";
            }

            if ($req->trie_par == "NUM_FACT") {
                $rep_par_trie = "num_facture";
            }

            if ($req->trie_par == "DUE_DTE") {
                $rep_par_trie = "due_date";
            }

            if ($req->trie_par == "TOTAL_SOLDE") {
                $rep_par_trie = "montant_total";
            }

            if ($req->trie_par == "RESTE_SOLDE") {
                $rep_par_trie = "dernier_montant_ouvert";
            }

            if($req->trie_par == "DTE_FACT"){
                $rep_par_trie = "date_facture";
            }

            if ($req->trie_par == "ENTITE") {
                $rep_par_trie = "nom_etp";
            }

            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::user()->id])->cfp_id;
            $encaissement = DB::select('select * from v_encaissement where cfp_id=?', [$cfp_id]);

            if (isset($req->invoice_dte) && isset($req->due_dte)) { // dte exist

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["due_date", "due_date", "cfp_id"],
                    [">=", "<=", "="],
                    [$req->invoice_dte, $req->due_dte, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    ["due_date", "due_date", "cfp_id"],
                    [">=", "<=", "="],
                    [$req->invoice_dte, $req->due_dte, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "due_date", "due_date", "cfp_id"],
                    ["!=", ">=", "<=", "="],
                    ["terminer", $req->invoice_dte, $req->due_dte, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "due_date", "due_date", "cfp_id"],
                    ["=", ">=", "<=", "="],
                    ["terminer", $req->invoice_dte, $req->due_dte, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->solde_debut) && isset($req->solde_fin)) { // reste à payer par client

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["montant_total", "montant_total", "cfp_id"],
                    [">=", "<=", "="],
                    [$req->solde_debut, $req->solde_fin, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    ["montant_total", "montant_total", "cfp_id"],
                    [">=", "<=", "="],
                    [$req->solde_debut, $req->solde_fin, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "montant_total", "montant_total", "cfp_id"],
                    ["!=", ">=", "<=", "="],
                    ["terminer", $req->solde_debut, $req->solde_fin, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "montant_total", "montant_total", "cfp_id"],
                    ["=", ">=", "<=", "="],
                    ["terminer", $req->solde_debut, $req->solde_fin, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->num_fact)) { // par N° facture

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["num_facture", "cfp_id"],
                    ["LIKE", "="],
                    ["%" . $req->num_fact . "%", $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    ["num_facture", "cfp_id"],
                    ["LIKE", "="],
                    ["%" . $req->num_fact . "%", $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "num_facture", "cfp_id"],
                    ["!=", "LIKE", "="],
                    ["terminer", "%" . $req->num_fact . "%", $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "num_facture", "cfp_id"],
                    ["=", "LIKE", "="],
                    ["terminer", "%" . $req->num_fact . "%", $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->entiter_id)) { // par ETP

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["entreprise_id", "cfp_id"],
                    ["=", "="],
                    [$req->entiter_id, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    ["entreprise_id", "cfp_id"],
                    ["=", "="],
                    [$req->entiter_id, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "entreprise_id", "cfp_id"],
                    ["!=", "=", "="],
                    ["terminer", $req->entiter_id, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "entreprise_id", "cfp_id"],
                    ["=", "=", "="],
                    ["terminer", $req->entiter_id, $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->status)) { // par status

                if ($req->status == "EN_COUR") { // partiellement payer
                    $para = ["cfp_id", "facture_encour", "jour_restant", "activiter"];
                    $opt = ["=", "=", ">=", "="];
                    $val = [$cfp_id, "en_cour", 1, True];

                    $para_inactif =  ["cfp_id", "facture_encour", "activiter"];
                    $opt_inactif = ["=", "=", "="];
                    $val_inactif = [$cfp_id, "en_cour", True];

                    $para_actif =  ["cfp_id", "facture_encour", "jour_restant", "activiter"];
                    $opt_actif = ["=", "=", ">=", "="];
                    $val_actif = [$cfp_id, "en_cour", 1, True];

                    $para_payer =  ["cfp_id", "facture_encour", "activiter"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$cfp_id, "en_cour", False];
                } else if ($req->status == "ACTIF") { // actif

                    $para = ["cfp_id", "activiter", "facture_encour"];
                    $opt = ["=", "=", "!="];
                    $val = [$cfp_id, True, "terminer"];

                    $para_inactif =  ["cfp_id", "facture_encour", "activiter"];
                    $opt_inactif = ["=", "=", "="];
                    $val_inactif = [$cfp_id, "en_cour", True];

                    $para_actif =  ["cfp_id", "facture_encour", "activiter"];
                    $opt_actif = ["=", "!=", "="];
                    $val_actif = [$cfp_id, "terminer", True];

                    $para_payer =  ["cfp_id", "facture_encour", "activiter"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$cfp_id, "terminer", False];

                    // dd($para);
                } else if ($req->status == "INACTIF") { // inactif

                    $para = ["cfp_id", "activiter"];
                    $opt = ["=", "="];
                    $val = [$cfp_id, FALSE];

                    $para_inactif = ["cfp_id", "activiter"];
                    $opt_inactif = ["=", "="];
                    $val_inactif = [$cfp_id, FALSE];

                    $para_actif = ["cfp_id", "activiter"];
                    $opt_actif = ["=", "="];
                    $val_actif = [$cfp_id, FALSE];

                    $para_payer = ["cfp_id", "activiter"];
                    $opt_payer = ["=", "="];
                    $val_payer = [$cfp_id, FALSE];
                } else if ($req->status == "PAYER") { // payer

                    $para = ["cfp_id", "dernier_montant_ouvert", "activiter", "facture_encour"];
                    $opt = ["=", "<=", "=", "="];
                    $val = [$cfp_id, 0, True, "terminer"];

                    $para_inactif = ["cfp_id", "activiter"];
                    $opt_inactif = ["=", "="];
                    $val_inactif = [$cfp_id, True];

                    $para_actif = ["cfp_id", "activiter"];
                    $opt_actif = ["=", "="];
                    $val_actif = [$cfp_id, FALSE];

                    $para_payer = ["cfp_id", "activiter", "facture_encour"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$cfp_id, True, "terminer"];
                } else { // retard

                    $para = ["cfp_id", "jour_restant", "facture_encour"];
                    $opt = ["=", "<=", "!="];
                    $val = [$cfp_id, 0, "terminer"];

                    $para_inactif = ["cfp_id", "activiter", "jour_restant"];
                    $opt_inactif = ["=", "=", "<="];
                    $val_inactif = [$cfp_id, FALSE, 0];

                    $para_actif = ["cfp_id", "activiter", "jour_restant", "facture_encour"];
                    $opt_actif = ["=", "=", "<=", "!="];
                    $val_actif = [$cfp_id, True, 0, "terminer"];

                    $para_payer = ["cfp_id", "activiter", "facture_encour"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$cfp_id, FALSE, "terminer"];
                }

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    $para,
                    $opt,
                    $val,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    $para_inactif,
                    $opt_inactif,
                    $val_inactif,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    $para_actif,
                    $opt_actif,
                    $val_actif,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    $para_payer,
                    $opt_payer,
                    $val_payer,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else { // simple

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["cfp_id"],
                    ["="],
                    [$cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_inactif = $this->fonct->findWhereTrieOrderBy(
                    "v_facture_inactif",
                    ["cfp_id"],
                    ["="],
                    [$cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_brouillon,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour",  "cfp_id"],
                    ["!=",  "="],
                    ["terminer",  $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour",  "cfp_id"],
                    ["=", "="],
                    ["terminer",  $cfp_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            }

            return response()->json([
                "full_facture" => $full_facture,
                "arrow" => $arrow,
                "encaissement" => $encaissement,
                "facture_inactif" => $facture_inactif,
                "facture_actif" => $facture_actif,
                "facture_payer" => $facture_payer,
                "devise" => $devise,
                "entiter" => "OF"
            ]);
        }

        // ===========================================================================================================================================================================
        if (Gate::allows('isReferent')) {
            $entreprise_id = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
            $encaissement = DB::select('select * from v_encaissement where entreprise_id=?', [$entreprise_id]);
            $arrow='<i class="fa icon_trie fa-arrow-down"></i>';
            // ---------------------------------- ts mhz fafana
            if ($req->data_value == 0) {
                $data_num_fact_trie = "ASC";
                $arrow='<i class="fa icon_trie fa-arrow-up"></i>';
            } else {
                $data_num_fact_trie = "DESC";
            }

            if ($req->trie_par == "NUM_FACT") {
                $rep_par_trie = "num_facture";
            }

            if ($req->trie_par == "DUE_DTE") {
                $rep_par_trie = "due_date";
            }

            if ($req->trie_par == "TOTAL_SOLDE") {
                $rep_par_trie = "montant_total";
            }

            if ($req->trie_par == "RESTE_SOLDE") {
                $rep_par_trie = "dernier_montant_ouvert";
            }
            if($req->trie_par == "DTE_FACT"){
                $rep_par_trie = "date_facture";
            }

            if ($req->trie_par == "ENTITE") {
                $rep_par_trie = "nom_cfp";
            }


            if (isset($req->invoice_dte) && isset($req->due_dte)) { // par dte

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["activiter", "due_date", "due_date", "entreprise_id"],
                    ["=", ">=", "<=", "="],
                    [True, $req->invoice_dte, $req->due_dte, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "due_date", "due_date", "entreprise_id"],
                    ["!=", ">=", "<=", "="],
                    ["terminer", $req->invoice_dte, $req->due_dte, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "due_date", "due_date", "entreprise_id"],
                    ["=", ">=", "<=", "="],
                    ["terminer", $req->invoice_dte, $req->due_dte, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->solde_debut) && isset($req->solde_fin)) { // reste à payer

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["activiter", "montant_total", "montant_total", "entreprise_id"],
                    ["=", ">=", "<=", "="],
                    [True, $req->solde_debut, $req->solde_fin, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "montant_total", "montant_total", "entreprise_id"],
                    ["!=", ">=", "<=", "="],
                    ["terminer", $req->solde_debut, $req->solde_fin, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "montant_total", "montant_total", "entreprise_id"],
                    ["=", ">=", "<=", "="],
                    ["terminer", $req->solde_debut, $req->solde_fin, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->num_fact)) { // par N° facture

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["activiter", "num_facture", "entreprise_id"],
                    ["=", "LIKE", "="],
                    [True, "%" . $req->num_fact . "%", $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "num_facture", "entreprise_id"],
                    ["!=", "LIKE", "="],
                    ["terminer", "%" . $req->num_fact . "%", $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "num_facture", "entreprise_id"],
                    ["=", "LIKE", "="],
                    ["terminer", "%" . $req->num_fact . "%", $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->entiter_id)) { // OF

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["activiter", "cfp_id", "entreprise_id"],
                    ["=", "=", "="],
                    [True, $req->entiter_id, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "cfp_id", "entreprise_id"],
                    ["!=", "=", "="],
                    ["terminer", $req->entiter_id, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour", "cfp_id", "entreprise_id"],
                    ["=", "=", "="],
                    ["terminer", $req->entiter_id, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else if (isset($req->status)) { // par status

                if ($req->status == "EN_COUR") { // partiellement payer
                    $para = ["entreprise_id", "facture_encour", "jour_restant", "activiter"];
                    $opt = ["=", "=", ">=", "="];
                    $val = [$entreprise_id, "en_cour", 1, True];

                    $para_actif =  ["entreprise_id", "facture_encour", "jour_restant", "activiter"];
                    $opt_actif = ["=", "=", ">=", "="];
                    $val_actif = [$entreprise_id, "en_cour", 1, True];

                    $para_payer =  ["entreprise_id", "facture_encour", "activiter"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$entreprise_id, "en_cour", False];
                } else if ($req->status == "ACTIF") { // actif

                    $para = ["entreprise_id", "activiter", "facture_encour"];
                    $opt = ["=", "=", "!="];
                    $val = [$entreprise_id, True, "terminer"];

                    $para_actif =  ["entreprise_id", "facture_encour", "activiter"];
                    $opt_actif = ["=", "!=", "="];
                    $val_actif = [$entreprise_id, "terminer", True];

                    $para_payer =  ["entreprise_id", "facture_encour", "activiter"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$entreprise_id, "terminer", False];

                    // dd($para);
                } else if ($req->status == "PAYER") { // payer

                    $para = ["entreprise_id", "dernier_montant_ouvert", "activiter", "facture_encour"];
                    $opt = ["=", "<=", "=", "="];
                    $val = [$entreprise_id, 0, True, "terminer"];

                    $para_actif = ["entreprise_id", "activiter"];
                    $opt_actif = ["=", "="];
                    $val_actif = [$entreprise_id, FALSE];

                    $para_payer = ["entreprise_id", "activiter", "facture_encour"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$entreprise_id, True, "terminer"];
                } else { // retard

                    $para = ["entreprise_id", "jour_restant", "facture_encour", "activiter"];
                    $opt = ["=", "<=", "!=", "="];
                    $val = [$entreprise_id, 0, "terminer", True];

                    $para_actif = ["entreprise_id", "activiter", "jour_restant", "facture_encour"];
                    $opt_actif = ["=", "=", "<=", "!="];
                    $val_actif = [$entreprise_id, True, 0, "terminer"];

                    $para_payer = ["entreprise_id", "activiter", "facture_encour"];
                    $opt_payer = ["=", "=", "="];
                    $val_payer = [$entreprise_id, FALSE, "terminer"];
                }

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    $para,
                    $opt,
                    $val,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    $para_actif,
                    $opt_actif,
                    $val_actif,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    $para_payer,
                    $opt_payer,
                    $val_payer,
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            } else { // simple

                $full_facture = $this->fonct->findWhereTrieOrderBy(
                    "v_full_facture",
                    ["activiter", "entreprise_id"],
                    ["=", "="],
                    [True, $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_full,
                    $nb_limit
                );
                $facture_actif =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour",  "entreprise_id"],
                    ["!=",  "="],
                    ["terminer",  $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_actif,
                    $nb_limit
                );
                $facture_payer =  $this->fonct->findWhereTrieOrderBy(
                    "v_facture_actif",
                    ["facture_encour",  "entreprise_id"],
                    ["=", "="],
                    ["terminer",  $entreprise_id],
                    [$rep_par_trie],
                    $data_num_fact_trie,
                    $req->nb_pagination_payer,
                    $nb_limit
                );
            }

            return response()->json([
                "full_facture" => $full_facture,
                "encaissement" => $encaissement,
                "arrow" => $arrow,
                "facture_actif" => $facture_actif,
                "facture_payer" => $facture_payer,
                "devise" => $devise,
                "entiter" => "ETP"
            ]);
        }
    }
}
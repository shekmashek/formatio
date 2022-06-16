<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Facture;
use App\detail;
use App\entreprise;
use App\formation;
use App\module;
use App\projet;
use App\responsable;
use App\stagiaire;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Models\FonctionGenerique;
use App\cfp;
use App\chefDepartement;
use App\formateur;
use App\Collaboration;

use function Ramsey\Uuid\v1;

use App\Http\Controllers\Controller;

class HomeControllerTDBF extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isCFP')) {
            $domaine = $this->fonct->findAll("domaines");
            $user_id = User::where('id', Auth::user()->id)->value('id');
            $centre_fp = cfp::where('user_id', $user_id)->value('id');
            $GChart = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as net_ht ,ROUND(IFNULL(SUM(net_ttc),0),2) as net_ttc , MONTH(invoice_date) as mois,
                year(invoice_date) as annee from v_facture_existant where year(invoice_date)=year(now()) or year(invoice_date)=YEAR(DATE_SUB(now(),
                INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' group by MONTH(invoice_date),
                year(invoice_date) order by MONTH( invoice_date),year(invoice_date) desc');

            $CA_actuel = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where YEAR(invoice_date)=year(now()) and cfp_id = ' . $centre_fp . ' ');
            $CA_precedent = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where year(invoice_date)=YEAR(DATE_SUB(now(), INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' ');

            // debut
            // $formations = formation::where('cfp_id', $centre_fp)->value('id');
            // $top_10_module = DB::select('select ');
            // ty no anaovana DB select  $modules = module::where('formation_id', $formations)->value('id');
            // fin

            // debut top 10 par client

            // fin top 10 par client

            // dd($user_id, $centre_fp, $top_10_par_client);
            return view('cfp.dashboard_cfp.dashboardTDBF', compact('GChart','domaine', 'CA_actuel', 'CA_precedent'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

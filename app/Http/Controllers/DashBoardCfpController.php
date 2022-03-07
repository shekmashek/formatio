<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
use App\cfp;

use App\User;
class DashBoardCfpController extends Controller
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
        $user_id = User::where('id', Auth::user()->id)->value('id');
        $centre_fp = cfp::where('user_id', $user_id)->value('id');
        $GChart = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as net_ht ,ROUND(IFNULL(SUM(net_ttc),0),2) as net_ttc , MONTH(invoice_date) as mois,
                year(invoice_date) as annee from v_facture_existant where year(invoice_date)=year(now()) or year(invoice_date)=YEAR(DATE_SUB(now(),
                INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' group by MONTH(invoice_date),
                year(invoice_date) order by MONTH( invoice_date),year(invoice_date) desc');

        $CA_actuel = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where YEAR(invoice_date)=year(now()) and cfp_id = ' . $centre_fp . ' ');
        $CA_precedent = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where year(invoice_date)=YEAR(DATE_SUB(now(), INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' ');

        $client_top_10_par_anne = DB::select('SELECT entreprise_id,nom_etp,(SUM(net_ttc)) net_ttc from v_facture_existant where cfp_id='.$centre_fp.' group by entreprise_id,nom_etp order by (SUM(net_ttc)) desc limit 10');

        return view('admin.dashboard.chart_cfp.dashboard_cfp', compact('GChart', 'CA_actuel', 'CA_precedent'));
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

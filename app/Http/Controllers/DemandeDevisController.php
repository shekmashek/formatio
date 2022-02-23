<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\demande_devis\demande_devisMail;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\FonctionGenerique;

class DemandeDevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $fonct = new FonctionGenerique();
        if (Gate::allows('isReferent')) {
            $module = $fonct->findWhereMulitOne("modules",["id"],[$request->module_id]);
            $resp_cfp = $fonct->findWhereMulitOne("responsables_cfp",["cfp_id","prioriter"],[$module->cfp_id,"1"]);
            $resp_etp = $fonct->findWhereMulitOne("responsables",["user_id"],[Auth::user()->id]);
            $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$resp_etp->entreprise_id]);

            // dd($module);
            // dd($resp_cfp);
            // dd($resp_etp);
            // dd($etp);
    // ($resp_cfp,$module,$resp_etp,$etp)
            Mail::to($resp_etp->email_resp)->send(new demande_devisMail($resp_cfp, $module, $resp_etp, $etp));
            return back()->with('success','demande de devis a été envoyé!');
        }

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

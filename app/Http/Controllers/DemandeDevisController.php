<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\responsable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\demande_devis\demande_devisMail;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\FonctionGenerique;

class DemandeDevisController extends Controller
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
        $user_id = Auth::user()->id;
        $id_module = $request->id_module;
        $nom=$request->nom;
        $mail=$request->mail;
        $objet=$request->objet;
        $description=$request->details;
        $id_cfp = $request->id_cfp;
        $fonct = new FonctionGenerique();
        $etp_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        // dd( $etp_id );

        if (Gate::allows('isReferent')) {
            $module = $fonct->findWhereMulitOne("v_module",["id"],[$id_module]);
            $resp_cfp = $fonct->findWhereMulitOne("responsables_cfp",["cfp_id","prioriter"],[$id_cfp,"1"]);
            $resp_etp = $fonct->findWhereMulitOne("responsables",["user_id"],[Auth::user()->id]);
            $etp = $fonct->findWhereMulitOne("entreprises",["id"],[$resp_etp->entreprise_id]);
            $resp_etp_id=$resp_etp->id;
        DB::insert('insert into demande_devis (nom,email,objet,description,etp_id,resp_etp_id,cfp_id,module_id)  values (?,?,?,?,?,?,?,?)',[$nom,$mail,$objet,$description,$etp_id ,$resp_etp_id,$id_cfp,$id_module]);
            //   url()->previous();
            // dd($resp_cfp);
            // dd($resp_etp);
            // dd($etp);
            // ($resp_cfp,$module,$resp_etp,$etp);
         //   Mail::to($resp_etp->email_resp)->send(new demande_devisMail($resp_cfp, $module, $resp_etp, $etp));
            return redirect()->back()->with('message', 'Votre demande de devis a été bien envoyé!');
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
 
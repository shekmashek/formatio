<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\responsable;
use App\DepartementEntreprise;
use App\User;
use App\cfp;
use App\Secteur;
use App\Mail\entrepriseMail;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;

class CfpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
        });
    }

    public function index(){
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();

        $entreprise_id = responsable::where('user_id',$user_id)->value('entreprise_id');
        $demmande = $fonct->findWhere("v_demmande_etp_pour_cfp", ["demmandeur_etp_id"], [$entreprise_id]);

        $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]);

        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["entreprise_id"],[$entreprise_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["entreprise_id"],[$entreprise_id]);
        $cfp = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);
// dd($demmande);
        return view('cfp.cfp', compact('cfp','demmande','invitation'));

    }
}

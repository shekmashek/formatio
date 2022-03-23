<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\responsable;
use App\Mail\entrepriseMail;
use Illuminate\Support\Facades\Auth;
use App\Models\FonctionGenerique;
use App\Models\getImageModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class CfpController extends Controller
{
    public function __construct()
    {
        $this->fonct  = new FonctionGenerique();

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }

    public function index()
    {
        $user_id = Auth::id();
        $fonct = new FonctionGenerique();

        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');

        $refuse_demmande_cfp = $fonct->findWhere("v_refuse_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
        $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]);

        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
        $cfp = $fonct->concatTwoList($etp1Collaborer, $etp2Collaborer);
        return view('cfp.cfp', compact('cfp', 'refuse_demmande_cfp', 'invitation'));
    }

    public function img_cfp($logo_cfp)
    {
        $get_img = new getImageModel();
        $dossier = 'entreprise';
        return $get_img->get_image($logo_cfp, $dossier);
    }
    //modification du profil
    public function edit_logo($id,Request $request){
        $cfp = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.edit_photo', compact('cfp'));
    }
    public function edit_nom($id,Request $request){
        $cfp = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.edit_nom', compact('cfp'));
    }
    public function edit_adresse($id,Request $request){
        $cfp = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
        return view('cfp.modification_profil.edit_adresse', compact('cfp'));
    }


    public function modifier_logo($id,Request $request){
        $image = $request->file('image');
        if($image != null){
            $cfp = $this->fonct->findWhereMulitOne("cfps",["id"],[$id]);
            $image_ancien = $cfp->logo;
            //supprimer l'ancienne image
            File::delete(public_path("images/CFP/".$image_ancien));
            //enregiistrer la nouvelle photo
            $nom_image = str_replace(' ', '_', $request->nom . '.' . $request->image->extension());
            $destinationPath = 'images/CFP';
            $image->move($destinationPath, $nom_image);
            //onn modifie ainsi l'url
            $url_logo = URL::to('/')."/images/CFP/".$nom_image;

            DB::update('update cfps set logo = ?,url_logo = ? where id = ?', [$nom_image,$url_logo,$id]);

        }
        else{
            return redirect()->back()->with('error', 'Choisissez une photo avant de cliquer sur enregistrer');
        }
        return redirect()->route('profil_of',[$id]);
    }
    public function modifier_nom($id,Request $request){
        DB::update('update cfps set nom = ? where id = ?', [$request->nom,$id]);
        return redirect()->route('profil_of',[$id]);
    }
    public function modifier_adresse($id,Request $request){

    }
}

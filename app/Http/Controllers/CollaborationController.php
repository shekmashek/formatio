<?php

namespace App\Http\Controllers;

use App\Collaboration;
use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\cfp;
use App\formateur;
use App\responsable;

class CollaborationController extends Controller
{
    public function __construct()
    {
        $this->collaboration = new Collaboration();
        $this->fonct = new FonctionGenerique();
    }

    // =========================  insert cfp à etp et etp à cfp

    public function create_cfp_etp(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_cfp_etp", ["demmandeur_cfp_id", "inviter_etp_id"], [$req["cfp_id"], $req["etp_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_cfp_etp($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyer sur cette entreprise !");
        }
    }

    public function create_etp_cfp(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_etp_cfp", ["demmandeur_etp_id", "inviter_cfp_id"], [$req["etp_id"], $req["cfp_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_etp_cfp($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyer sur cette centre de formation !");
        }
    }
    // =========================  insert formateur à cfp et cfp à formateur

    public function create_formateur_cfp(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_formateur_cfp", ["demmandeur_formateur_id", "inviter_cfp_id"], [$req["formateur_id"], $req["cfp_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_formateur_cfp($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyer sur cette centre de formation !");
        }
    }

    public function create_cfp_formateur(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_cfp_formateur", ["demmandeur_cfp_id", "inviter_formateur_id"], [$req["cfp_id"], $req["formateur_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_cfp_formateur($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyer sur formateur!");
        }
    }
    // =========================  annule cfp à etp et etp à cfp

    public function delete_cfp_etp($id)
    {
        return $this->collaboration->verify_annulation_collaboration_cfp_etp($id);
    }

    public function delete_etp_cfp($id)
    {
        return $this->collaboration->verify_annulation_collaboration_etp_cfp($id);
    }
    // =========================  annule formateur à cfp et cfp à formateur

    public function delete_formateur_cfp($id)
    {
        return $this->collaboration->verify_annulation_collaboration_formateur_cfp($id);
    }

    public function delete_cfp_formateur($id)
    {
        return $this->collaboration->verify_annulation_collaboration_cfp_formateur($id);
    }
    // ======================== affichage cfp etp =========================================
    public function collaboration_etp_cfp()
    {
        $fonct = new FonctionGenerique();
        $id = Auth::id();
        $entreprise_id = responsable::where('user_id', $id)->value('entreprise_id');

        $demmande = $fonct->findWhere("v_demmande_etp_pour_cfp", ["demmandeur_etp_id"], [$entreprise_id]);
        $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]);
        $cfps = $fonct->findAll("cfps");
        return view('collaboration.collaboration_etp', compact('cfps', 'demmande', 'invitation', 'entreprise_id'));
    }

    // ======================== affichage formateur cfp =========================================

    public function collaboration_formateur_cfp()
    {
        $fonct = new FonctionGenerique();
        $id = Auth::id();
        $formateur_id = formateur::where('user_id', $id)->value('id');
        $demmande = $fonct->findWhere("v_demmande_formateur_pour_cfp", ["demmandeur_formateur_id"], [$formateur_id]);
        $invitation = $fonct->findWhere("v_invitation_formateur_pour_cfp", ["inviter_formateur_id"], [$formateur_id]);
        $cfps = $fonct->findAll("cfps");
        return view('collaboration.collaboration_frmt', compact('cfps', 'demmande', 'invitation', 'formateur_id'));
    }

    public function collaboration_cfp_etp_et_formateur()
    {
        $fonct = new FonctionGenerique();
        $id = Auth::id();
        $cfp_id =cfp::where('user_id', $id)->value('id');
        $demmande_etp = $fonct->findWhere("v_demmande_cfp_pour_etp", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_etp = $fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]);
        $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);

        $entreprise = $fonct->findAll("entreprises");
        $formateur = $fonct->findAll("formateurs");

        return view('collaboration.collaboration_cfp', compact('entreprise', 'formateur', 'demmande_etp', 'invitation_etp', 'demmande_formateur', 'invitation_formateur', 'cfp_id'));
    }


    public function collaboration()
    {
        $role_id = User::where('email', Auth::user()->email)->value('role_id');
        if (Gate::allows('isFormateur')) {
            return $this->collaboration_formateur_cfp();
        } elseif (Gate::allows('isCFP')) {
            return $this->collaboration_cfp_etp_et_formateur();
        } elseif (Gate::allows('isReferent')) {
            return $this->collaboration_etp_cfp();
        } else {
            return back();
        }
    }

    // =========================== annulation invation ======================================

    public function annulation_invitation_etp_cfp($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_etp_cfp($id);
    }

    public function annulation_invitation_cfp_etp($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_cfp_etp($id);
    }

    public function annulation_invitation_formateur_cfp($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_formateur_cfp($id);
    }

    public function annulation_invitation_cfp_formateur($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_cfp_formateur($id);
    }


    // ========================== accepter inviation ============


    public function accept_invitation_etp_cfp($id)
    {
        return $this->collaboration->accept_invitation_collaboration_etp_cfp($id);
    }

    public function accept_invitation_cfp_etp($id)
    {
        return $this->collaboration->accept_invitation_collaboration_cfp_etp($id);
    }

    public function accept_invitation_formateur_cfp($id)
    {
        return $this->collaboration->accept_invitation_collaboration_formateur_cfp($id);
    }

    public function accept_invitation_cfp_formateur($id)
    {
        return $this->collaboration->accept_invitation_collaboration_cfp_formateur($id);
    }

    // =========================================================


    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Collaboration $collaboration)
    {
        //
    }

    public function edit(Collaboration $collaboration)
    {
        //
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        //
    }

    public function destroy(Collaboration $collaboration)
    {
        //
    }
}

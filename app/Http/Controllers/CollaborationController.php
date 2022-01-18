<?php

namespace App\Http\Controllers;

use App\Collaboration;
use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\cfp;
use App\entreprise;
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
            return back()->with('error', "une invitation a été déjà envoyée à ce centre de formation !");
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

        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["entreprise_id"],[$entreprise_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["entreprise_id"],[$entreprise_id]);
        $cfp_tmp = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);
        $cfp = new cfp();
        $cfp1 = $cfp->getCfpCollaborer($cfp_tmp);
        $cfp2 = $cfp->getCfpNotCollaborer($cfp1);

        $cfps = $fonct->concatTwoList($cfp1,$cfp2);

        // $cfps = $fonct->findAll("cfps");
        return view('collaboration.collaboration_etp', compact('cfps', 'demmande', 'invitation', 'entreprise_id'));
    }

    // ======================== affichage formateur cfp =========================================

    public function collaboration_formateur_cfp()
    {
        $fonct = new FonctionGenerique();
        $cfp = new cfp();

        $id = Auth::id();
        $formateur_id = formateur::where('user_id', $id)->value('id');
        $demmande = $fonct->findWhere("v_demmande_formateur_pour_cfp", ["demmandeur_formateur_id"], [$formateur_id]);
        $invitation = $fonct->findWhere("v_invitation_formateur_pour_cfp", ["inviter_formateur_id"], [$formateur_id]);

          // ======== formateur collaborer
            $cfp1 = $fonct->findWhere("v_demmande_formateur_cfp", ["formateur_id"], [$formateur_id]);
            $cfp2 = $fonct->findWhere("v_demmande_cfp_formateur", ["formateur_id"], [$formateur_id]);
            $cfpCollaborer1_tmp = $fonct->concatTwoList($cfp1,$cfp2);

            $cfpCollaborer1 = $cfp->getCfpCollaborer($cfpCollaborer1_tmp);
            $cfpCollaborer2 = $cfp->getCfpNotCollaborer($cfpCollaborer1);

            $cfps = $fonct->concatTwoList($cfpCollaborer1,$cfpCollaborer2);

        return view('collaboration.collaboration_frmt', compact('cfps', 'demmande', 'invitation', 'formateur_id'));
    }


    public function collaboration_cfp_etp_et_formateur(){
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp",["cfp_id"],[$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);

            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            return view('collaboration.collaboration_cfp', compact('formateur','demmande_formateur','invitation_formateur'));
        }
    }
   /* public function collaboration_cfp_etp_et_formateur()
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

         // ======== formateur collaborer
        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateur_tmp = $fonct->concatTwoList($formateur1,$formateur2);
        $listeFormateur = $formateur_tmp;

        $format = new formateur();
        $forma_colab1 = $format->getCollaborer("formateurs",$formateur_tmp);
        $forma_colab2 = $format->getNotCollaborer("formateurs",$forma_colab1);

        $formateur = $fonct->concatTwoList($forma_colab1,$forma_colab2);


        // ======== entreprise collaborer
        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
        $entreprise_tmp = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);

        $listeEntreprise = $entreprise_tmp;

        $etp = new entreprise();
        $entreprise1 = $etp->getCollaborer("entreprises",$entreprise_tmp);
        $entreprise2 = $etp->getNotCollaborer("entreprises",$entreprise1);

        $entreprise = $fonct->concatTwoList($entreprise1,$entreprise2);

        return view('collaboration.collaboration_cfp', compact('listeFormateur','listeEntreprise','entreprise', 'formateur', 'demmande_etp', 'invitation_etp', 'demmande_formateur', 'invitation_formateur', 'cfp_id'));
    }
*/
/*
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

         // ======== formateur collaborer
        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateurCollaborer = $fonct->concatTwoList($formateur1,$formateur2);

        // ======== entreprise collaborer
        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
        $entrepriseCollaborer = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);

        return view('collaboration.collaboration_cfp', compact('entreprise', 'formateur', 'demmande_etp', 'invitation_etp', 'demmande_formateur', 'invitation_formateur', 'cfp_id','formateurCollaborer','entrepriseCollaborer'));
    }
*/
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

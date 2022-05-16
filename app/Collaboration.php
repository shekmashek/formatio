<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\cfp;
use App\formateur;

class Collaboration extends Model
{
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
    }

    /*   public function insert_collaboration_cfp_etp($cfp_id,$imput){
        $data = [$cfp_id,$imput["etp_id"]];
        DB::insert('insert into demmande_cfp_etp (demmandeur_cfp_id,inviter_etp_id,created_at,updated_at) values (?,?, NOW(), NOW())', $data);
        DB::commit();
    }
*/
    public function insert_collaboration_cfp_etp($cfp_id, $etp_id)
    {
        $data = [$cfp_id, $etp_id];
        DB::insert('insert into demmande_cfp_etp (demmandeur_cfp_id,inviter_etp_id,created_at,updated_at) values (?,?, NOW(), NOW())', $data);
        DB::commit();
    }

    public function insert_collaboration_etp_cfp($cfp_id, $etp_id)
    {
        $data = [$etp_id, $cfp_id];
        DB::insert('insert into demmande_etp_cfp (demmandeur_etp_id,inviter_cfp_id,created_at,updated_at) values (?,?, NOW(), NOW())', $data);
        DB::commit();
    }

    public function insert_collaboration_formateur_cfp($imput)
    {
        $data = [$imput["formateur_id"], $imput["cfp_id"]];
        DB::insert('insert into demmande_formateur_cfp (demmandeur_formateur_id,inviter_cfp_id,created_at,updated_at) values (?,?, NOW(), NOW())', $data);
        DB::commit();
    }

    public function insert_collaboration_cfp_formateur($cfp_id, $formateur_id)
    {
        $data = [$cfp_id, $formateur_id];
        DB::insert('insert into demmande_cfp_formateur (demmandeur_cfp_id,inviter_formateur_id,created_at,updated_at,activiter) values (?,?, NOW(), NOW(),1)', $data);
        DB::commit();
    }

    public function suprime_collaboration_cfp_etp($id)
    {
        DB::delete('delete from demmande_cfp_etp where id = ?', [$id]);
        DB::commit();
    }

    public function suprime_collaboration_etp_cfp($etp_id, $cfp_id)
    {
        DB::delete('delete from demmande_etp_cfp where demmandeur_etp_id = ? and inviter_cfp_id=?', [$etp_id, $cfp_id]);
        DB::delete('delete from demmande_cfp_etp where demmandeur_cfp_id = ? and inviter_etp_id=?', [$cfp_id, $etp_id]);
        DB::commit();
    }

    public function suprime_collaboration_formateur_cfp($id)
    {
        DB::delete('delete from demmande_formateur_cfp where id = ?', [$id]);
        DB::commit();
    }

    public function suprime_collaboration_cfp_formateur($cfp_id, $formateur_id)
    {
        DB::delete('delete from demmande_formateur_cfp where demmandeur_formateur_id = ? and inviter_cfp_id=?', [$formateur_id, $cfp_id]);
        DB::delete('delete from demmande_cfp_formateur where demmandeur_cfp_id = ? and inviter_formateur_id=?', [$cfp_id, $formateur_id]);

        DB::commit();
    }

    // ========================= invitation refuse

    // ----------------------------------------------------------------------
    public function insert_invitation_refuser_etp_cfp($cfp_id, $etp_id)
    {
        $data = [$etp_id, $cfp_id];
        DB::insert('insert into refuse_demmande_etp_cfp (demmandeur_etp_id,inviter_cfp_id,created_at) values (?,?, NOW())', $data);
        DB::commit();
    }
    public function suprime_invitation_collaboration_etp_cfp($id)
    {
        DB::delete('delete from demmande_cfp_etp where id = ?', [$id]);
        DB::commit();

        return back();
    }
    // -----------------------------------------
    public function insert_invitation_refuser_cfp_etp($cfp_id, $etp_id)
    {
        $data = [$cfp_id, $etp_id];
        DB::insert('insert into refuse_demmande_cfp_etp (demmandeur_cfp_id,inviter_etp_id,created_at) values (?,?, NOW())', $data);
        DB::commit();
    }
    public function suprime_invitation_collaboration_cfp_etp($id)
    {
        DB::delete('delete from demmande_etp_cfp where id = ?', [$id]);
        DB::commit();

        return back();
    }


    // --------------------------------------------
    public function suprime_invitation_collaboration_cfp_formateur($id)
    {
        DB::delete('delete from demmande_formateur_cfp where id = ?', [$id]);
        DB::commit();

        return back();
    }

    public function suprime_invitation_collaboration_formateur_cfp($id)
    {
        DB::delete('delete from demmande_cfp_formateur where id = ?', [$id]);
        DB::commit();

        return back();
    }

    //=================   accepter invitation==========================
    public function accept_invitation_collaboration_etp_cfp($id)
    {
        $demande = $this->fonct->findWhereMulitOne("demmande_cfp_etp", ["id"], [$id]);
        $verify_exist = $this->fonct->findWhere("demmande_etp_cfp", ["demmandeur_etp_id", "inviter_cfp_id"], [$demande->inviter_etp_id, $demande->demmandeur_cfp_id]);
        DB::beginTransaction();
        try {
            if (count($verify_exist) > 0) {
                DB::delete("delete from demmande_etp_cfp where demmandeur_etp_id=? AND inviter_cfp_id=?", [$demande->inviter_etp_id, $demande->demmandeur_cfp_id]);
            }
            DB::update("update demmande_cfp_etp set activiter=1 where id=?", [$id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back();
    }

    public function accept_invitation_collaboration_cfp_etp($id)
    {
        $demande = $this->fonct->findWhereMulitOne("demmande_etp_cfp", ["id"], [$id]);
        $verify_exist = $this->fonct->findWhere("demmande_cfp_etp", ["demmandeur_cfp_id", "inviter_etp_id"], [$demande->inviter_cfp_id, $demande->demmandeur_etp_id]);
        DB::beginTransaction();
        try {
            if (count($verify_exist) > 0) {
                DB::delete("delete from demmande_cfp_etp where demmandeur_cfp_id=? AND inviter_etp_id=?", [$demande->inviter_cfp_id, $demande->demmandeur_etp_id]);
            }
            DB::update("update demmande_etp_cfp set activiter=1 where id=?", [$id]);
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        return back();
    }

    public function accept_invitation_collaboration_cfp_formateur($id)
    {
        DB::update("update demmande_formateur_cfp set activiter=1 where id=?", [$id]);
        DB::commit();

        return back();
    }

    public function accept_invitation_collaboration_formateur_cfp($id)
    {
        DB::update("update demmande_cfp_formateur set activiter=1 where id=?", [$id]);
        DB::commit();

        return back();
    }

    public function validation_form_cfp_etp($imput)
    {
        $rules = [
            'cfp_id.required' => 'champs invalid type',
            'cfp_id.number' => "champs invalid type, parce que la valeur n'est pas valid",
            'etp_id.required' => 'champs invalid type',
            'etp_id.number' => "champs invalid type, parce que la valeur n'est pas valid"
        ];
        $critereForm = [
            'cfp_id' => 'required|number',
            'etp_id' => 'required|number'
        ];
        $imput->validate($critereForm, $rules);
    }

    public function validation_form_formateur_etp($imput)
    {
        $rules = [
            'formateur_id.required' => 'champs invalid type',
            'formateur_id.number' => "champs invalid type, parce que la valeur n'est pas valid",
            'etp_id.required' => 'champs invalid type',
            'etp_id.number' => "champs invalid type, parce que la valeur n'est pas valid"
        ];
        $critereForm = [
            'formateur_id' => 'required|number',
            'etp_id' => 'required|number'
        ];
        $imput->validate($critereForm, $rules);
    }

    public function validation_form_cfp_formateur($imput)
    {
        $rules = [
            'nom_format.required' => 'veuillez remplir le champs,merci!',
            'email_format.required' => "veuillez remplir le champs,merci!",
            'email_format.email' => 'votre mail est invalid',
        ];
        $critereForm = [
            'nom_format' => 'required',
            'email_format' => 'required|email'
        ];
        $imput->validate($critereForm, $rules);
    }


    public function verify_collaboration_cfp_etp($cfp_id, $etp_id, $nom_resp)
    {
        DB::beginTransaction();
        try {
            $this->insert_collaboration_cfp_etp($cfp_id, $etp_id);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back()->with("success", "une invitation de collaboration a été envoyée ");
    }

    public function verify_collaboration_etp_cfp($cfp_id, $etp_id, $nom_cfp)
    {
        //  $this->validation_form($imput);
        DB::beginTransaction();
        try {
            $this->insert_collaboration_etp_cfp($cfp_id, $etp_id);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back()->with("success", "une invitation de collaboration a été envoyé à " . $nom_cfp);
    }

    public function verify_collaboration_formateur_cfp($imput)
    {
        // $this->validation_form_cfp_etp($imput);
        DB::beginTransaction();
        try {
            $this->insert_collaboration_formateur_cfp($imput->input());
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back();
    }

    public function verify_collaboration_cfp_formateur($cfp_id, $formateur_id, $nom_forma)
    {
        // $this->validation_form($imput);
        DB::beginTransaction();
        try {
            $this->insert_collaboration_cfp_formateur($cfp_id, $formateur_id);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back()->with("success", "une invitation de collaboration a été à " . $nom_forma);
    }



    public function verify_annulation_collaboration_etp_cfp($cfp_id, $etp_id)
    {
        $this->suprime_collaboration_etp_cfp($etp_id, $cfp_id);
        return back();
    }


    /*
    public function verify_annulation_collaboration_cfp_etp($id){
        DB::beginTransaction();
        try
        {
            $this->suprime_collaboration_cfp_etp($id);
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error","une erreur s'est présenter,veuillez réssailler!");
        }
        return back();
    }

    public function verify_annulation_collaboration_etp_cfp($input){
        DB::beginTransaction();
        try
        {
            $this->suprime_collaboration_etp_cfp($input->etp_id,$input->cfp_id);
        } catch(Exception $e){
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error","une erreur s'est présenter,veuillez réssailler!");
        }
        return back();
    }

    */

    public function verify_annulation_collaboration_formateur_cfp($id)
    {
        DB::beginTransaction();
        try {
            $this->suprime_collaboration_formateur_cfp($id);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back();
    }

    public function verify_annulation_collaboration_cfp_formateur($cfp_id, $formateur_id)
    {
        $this->suprime_collaboration_cfp_formateur($cfp_id, $formateur_id);
        return back();
    }


    public function count_invitation()
    {
        $fonct = new FonctionGenerique();
        $id = Auth::id();
        // $role_id = User::where('email',Auth::user()->email)->value('role_id');
        $totale_invitation = 0;
        if (Gate::allows('isFormateur')) {
            $formateur_id = formateur::where('user_id', $id)->value('id');
            $totale_invitation += count($fonct->findWhere("v_invitation_formateur_pour_cfp", ["inviter_formateur_id"], [$formateur_id]));
        } elseif (Gate::allows('isCFP')) {
            $cfp_id = CFP::where('user_id', $id)->value('id');
            $totale_invitation += count($fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]));
            $totale_invitation += count($fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]));
        } elseif (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $id)->value('entreprise_id');
            $totale_invitation += count($fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]));
        } else {
            $totale_invitation = 0;
        }
        return $totale_invitation;
    }
}

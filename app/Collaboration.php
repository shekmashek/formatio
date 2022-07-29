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

    public function insert_collaboration_cfp_formateur($cfp_id, $formateur_id)
    {
        $data = [$cfp_id, $formateur_id];
        DB::insert('insert into demmande_cfp_formateur (demmandeur_cfp_id,inviter_formateur_id,created_at,updated_at,activiter) values (?,?, NOW(), NOW(),1)', $data);
        DB::commit();
    }

    public function suprime_collaboration_etp_cfp($etp_id, $cfp_id)
    {
        DB::delete('delete from collaboration_etp_cfp where etp_id = ? and cfp_id = ?', [$etp_id, $cfp_id]);
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
    public function suprime_invitation_collaboration_etp_cfp($id,$id_collab)
    {
        DB::update('update collaboration_etp_cfp set statut = ? where cfp_id = ? and id = ?', [3,$id,$id_collab]);
        DB::commit();

        return back();
    }


    // -----------------------------------------
    public function suprime_invitation_collaboration_cfp_etp($id,$id_collab)
    {
        DB::update('update collaboration_etp_cfp set statut = ? where etp_id = ? and id = ?', [3,$id,$id_collab]);
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
    public function accept_invitation_collaboration_etp_cfp($id,$resp_etp_id,$id_collab)
    {
        $demande = $this->fonct->findWhereMulitOne("collaboration_etp_cfp", ["cfp_id","demmandeur"], [$id,'cfp']);
        $verify_exist = $this->fonct->findWhere("collaboration_etp_cfp", ["etp_id", "cfp_id","demmandeur"], [$demande->etp_id, $demande->cfp_id,'cfp']);
        if ($verify_exist != null) {
            DB::beginTransaction();
            try {
                $query = DB::update("update collaboration_etp_cfp set statut = ? where cfp_id = ? and demmandeur = ? and id = ?", [2,$id,'cfp',$id_collab]);
                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
        }
        return back();
    }

    public function accept_invitation_collaboration_cfp_etp($id,$resp_cfp_id,$id_collab)
    {
        $demande = $this->fonct->findWhereMulitOne("collaboration_etp_cfp", ["etp_id","demmandeur"], [$id,'etp']);
        $verify_exist = $this->fonct->findWhere("collaboration_etp_cfp", ["cfp_id", "etp_id","demmandeur"], [$demande->cfp_id, $demande->etp_id,'etp']);
        if ($verify_exist != null) {
            DB::beginTransaction();
            try {
                DB::update("update collaboration_etp_cfp set statut = ? where etp_id = ? and demmandeur = ? and id = ?", [2,$id,'etp',$id_collab]);
                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                echo $e->getMessage();
            }
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

    public function verify_collaboration_formateur_cfp($imput)
    {
        // $this->validation_form_cfp_etp($imput);
        DB::beginTransaction();
        try {
            $this->insert_collaboration_formateur_cfp($imput->input());
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            return back()->with("error", "une erreur s'est présenter,veuillez réssailler!");
        }
        return back()->with("success", "une invitation de collaboration a été envoyée à " . $nom_forma);
    }



    public function verify_annulation_collaboration_etp_cfp($cfp_id, $etp_id)
    {
        $this->suprime_collaboration_etp_cfp($etp_id, $cfp_id);
        return back();
    }

    public function verify_annulation_collaboration_formateur_cfp($id)
    {
        DB::beginTransaction();
        try {
            $this->suprime_collaboration_formateur_cfp($id);
        } catch (\Exception $e) {
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
            $totale_invitation += count($fonct->findWhere("collaboration_etp_cfp", ["cfp_id","statut"], [$cfp_id,2]));
            $totale_invitation += count($fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]));
        } elseif (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $id)->value('entreprise_id');
            $totale_invitation += count($fonct->findWhere("collaboration_etp_cfp", ["etp_id","statut"], [$entreprise_id,2]));
        } else {
            $totale_invitation = 0;
        }
        return $totale_invitation;
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appel_offre extends Model
{
    protected $table = "appel_offres";
    protected $fillable = [
       'id','tdr_url','reference_soumission','date_fin','hr_fin','prestation_demande','dossier_fournir','contexte_prestation','information_generale','exigence_soumission','entreprise_id','created_at','updated_at','publier'
    ];

    public static function validation($input){
        $rules = [
            'tdr.required' => 'Veillez remplir le champ.',
            'reference_soumission.required' => 'Veillez remplir le champ.',
            'dte.required' => 'Veillez remplir le champ.',
            'hr.required' => 'Veillez remplir le champ.',
            'prestation.required' => 'Veillez remplir le champ.',
            'contexte.required' => 'Veillez remplir le champ.',
            'dossier_fournir.required' => 'Veillez remplir le champ.',
            'information_generale.required' => 'Veillez remplir le champ.',
            'exigence_soumission.required'=>'Veillez remplir le champ.'
        ];
        $critere=[
            'tdr' => 'required',
            'reference_soumission' => 'required',
            'dte' => 'required',
            'hr' => 'required',
            'prestation' => 'required',
            'contexte' => 'required',
            'information_generale' => 'required',
            'dossier_fournir' =>'required',
            'exigence_soumission' => 'required'
        ];
        $input->validate($critere,$rules);
    }

}

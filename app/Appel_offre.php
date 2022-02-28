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
            'desc_court.required' => 'Veillez remplir le champ.',
            'desc_detailer.required' => 'Veillez remplir le champ.',
            'thematique.required' => 'Veillez remplir le champ.'
        ];
        $critere=[
            'tdr' => 'required',
            'reference_soumission' => 'required',
            'dte' => 'required',
            'hr' => 'required',
            'desc_court' => 'required',
            'desc_detailer' => 'required',
            'thematique' => 'required'
          ];
        $input->validate($critere,$rules);
    }

}

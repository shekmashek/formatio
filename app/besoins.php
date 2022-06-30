<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Domaine;
use App\formation;
use App\stagiaire;

class besoins extends Model
{
    protected $table = "besoin_stagiaire";
    protected $fillable = [
        'stagiaire_id','entreprise_id','domaines_id','thematique_id','anneePlan_id','objectif','date_previsionnelle','organisme','statut','type',   
    ];

    /**
     * Get all of the comments for the besoins
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'domaines_id');
    }
    public function formation()
    {
        return $this->belongsTo(formation::class, 'thematique_id');
    }
    public function stagiaire()
    {
        return $this->belongsTo(stagiaire::class, 'stagiaire_id');
    }
    public function anne()
    {
        return $this->belongsTo(PlanFormation::class, 'anneePlan_id');
    }
    
}

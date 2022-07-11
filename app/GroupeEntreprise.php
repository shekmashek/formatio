<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeEntreprise extends Model
{
    protected $table = "groupe_entreprises";

    protected $fillable = ['groupe_id'];

    public function groupe() {
        return $this->belongsTo('App\groupe', 'groupe_id');
    }

    public function entreprise() {
        return $this->belongsTo('App\entreprise', 'entreprise_id');
    }

}

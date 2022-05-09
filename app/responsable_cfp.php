<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class responsable_cfp extends Model
{
   protected $table="responsables_cfp";
   public function cfp()
   {
       return $this->belongsTo('App\cfp');
   }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix_pour_questions extends Model
{
    protected $table = "choix_pour_questions";
    protected $fillable = [
        'id','question_id','reponse'
    ];
}

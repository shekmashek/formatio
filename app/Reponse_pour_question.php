<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse_pour_question extends Model
{
    protected $table = "reponse_pour_questions";
    protected $fillable = [
        'id','choix_pour_question_id','question_id'
    ];
}

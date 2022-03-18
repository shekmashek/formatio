<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_evaluation extends Model
{
    protected $table = "question_evaluations";
    protected $fillable = [
        'id','question','cfp_id','formation_id'
    ];
}

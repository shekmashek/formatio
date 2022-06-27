<?php

namespace App;

use Clockwork\Request\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FroidEvaluation extends Model
{
    public function periode_froid_evaluation($groupe){
        $date_eval = DB::select('select DATE_ADD(date_fin,interval 6 month) as date_eval from groupes where id = ?',[$groupe])[0]->date_eval;
        $today = date('now');
        if($date_eval < $today){
            return 1;
        }
        return 0;
    }
}

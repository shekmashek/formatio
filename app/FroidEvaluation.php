<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FroidEvaluation extends Model
{
    public function periode_froid_evaluation($groupe){
        $module = DB::select('select module_id from groupes where id = ?',[$groupe])[0]->module_id;
        $interval = DB::select('select date_eval_froid from modules where id = ?',[$module])[0]->date_eval_froid;
        $date_eval = DB::select('select DATE_ADD(date_fin,interval ? month) as date_eval from groupes where id = ?',[$interval,$groupe])[0]->date_eval;
        $today = Carbon::now()->toDateString();
        if($date_eval < $today){
            return 1;
        }
        return 0;
    }
}

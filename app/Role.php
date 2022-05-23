<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class Role extends Model
{
    protected $fillable = ['role_name'];

    public function getEmployerReferent($employers)
    {
        $fonct = new FonctionGenerique();
        $employe = $employers;
        $role_referent = $fonct->findWhereMulitOne("v_role_etp", ["role_name"], ["referent"]);

        $data = array();
        for ($i = 0; $i < count($employe); $i += 1) {
            $data[$i] = $employe[$i];
            $verify_role_referent_exist = $fonct->findWhereMulitOne("role_users", ["user_id", "role_id"], [$data[$i]->user_id, $role_referent->id]);
            if ($verify_role_referent_exist != null) {
                // dd($verify_role_referent_exist);
                $data[$i]->is_referent = True;
                if ($verify_role_referent_exist->prioriter == 1) {
                    $data[$i]->prioriter = True;
                } else {
                    $data[$i]->prioriter = false;
                }
                $data[$i]->activiter_role = True;
            } else {
                $data[$i]->is_referent = false;
                $data[$i]->prioriter = false;
                $data[$i]->activiter_role = false;
            }
            $data[$i]->role_id=$role_referent->id;
        }
        // dd($data);
        return $data;
    }
}

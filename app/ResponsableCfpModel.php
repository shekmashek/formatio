<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class ResponsableCfpModel extends Model
{
    public function verify_form($input)
    {
        $rules = [
            'nom.required' => 'le Nom ne doit pas être null',
            'cin_1.required' => 'invalid',
            'cin_2.required' => 'invalid',
            'cin_3.required' => 'invalid',
            'cin_4.required' => 'invalid',
            'cin_5.required' => 'invalid',
            'cin_6.required' => 'invalid',
            'cin_7.required' => 'invalid',
            'cin_8.required' => 'invalid',
            'cin_9.required' => 'invalid',
            'cin_10.required' => 'invalid',
            'cin_11.required' => 'invalid',
            'cin_12.required' => 'invalid',
            'phone.required' => 'le numero de télephone ne doit pas être null',
            'email.required' => 'le mail ne doit pas être null',
            'fonction.required' => 'le fonction ne doit pas être null'
        ];
        $critereForm = [
            'nom' => 'required',
            'cin_1' => 'required',
            'cin_2' => 'required',
            'cin_3' => 'required',
            'cin_4' => 'required',
            'cin_5' => 'required',
            'cin_6' => 'required',
            'cin_7' => 'required',
            'cin_8' => 'required',
            'cin_9' => 'required',
            'cin_10' => 'required',
            'cin_11' => 'required',
            'cin_12' => 'required',
            'fonction' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ];
        $input->validate($critereForm, $rules);
    }

    public function concat_nb_cin($input)
    {
        $cin = $input["cin_1"] . $input["cin_2"] . $input["cin_3"] . $input["cin_4"] . $input["cin_5"] . $input["cin_6"] . $input["cin_7"] . $input["cin_8"] . $input["cin_9"] . $input["cin_10"] . $input["cin_11"] . $input["cin_12"];
        return $cin;
    }

    public function verify_cin($input)
    {
        $cin = $this->concat_nb_cin($input);
        $data = DB::select('select * from users WHERE cin =?', [$cin]);
        return $data;
    }


    public function insert_resp_CFP($doner, $cfp_id, $user_id)
    {
        $data = [
            $doner["nom"], $doner["prenom"], $doner["cin"], $doner["email"], $doner["phone"], $doner["fonction"],
            $cfp_id, $user_id
        ];
        DB::beginTransaction();
        try {
            DB::insert('insert into responsables_cfp(nom_resp_cfp,prenom_resp_cfp,cin_resp_cfp,email_resp_cfp,telephone_resp_cfp,fonction_resp_cfp
        ,cfp_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,1,NOW())', $data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back()->with('success', 'terminé!');
    }

    public function delete_resp_CFP($id_delete)
    {
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("responsables_cfp", ["id"], [$id_delete]);

        DB::beginTransaction();
        try {
            DB::delete('delete from responsables_cfp where id=?', [$id_delete]);
            DB::delete('delete from users where id=?', [$resp->user_id]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back()->with('success', 'terminé!');
    }
}

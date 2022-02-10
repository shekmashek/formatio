<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\FonctionGenerique;

class Programme extends Model
{
    protected $table = "programmes";
    protected $fillable = [
        'id','titre','module_id'
    ];
    public function module(){
        return $this->belongsTo('App\module');
    }

    // get full
    public function  findAll(){  return programme::get();  }

    //get find by id
    public function findWhereId($para,$val){  return programme::where(''.$para,$val)->get();    }

    //get find by id
    public function findById($id){  return programme::where('id',$id)->get()[0];    }

     // find programme avec module,categorie,catalogue
     public function findAllProgramme(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll("v_programme");
    }

    //fonction generique
    public function findWhere($para=[],$val=[]){
        $fonction = new FonctionGenerique();
        $data =  $fonction->findWhere("v_programme",$para,$val);
        return $data;
        }

    //fonction generique
    public function findWhereOne($para,$opt,$val){
        $fonction = new FonctionGenerique();
        $data =  $fonction->findWhereOne("v_programme",$para,$opt,$val);
        return $data;
    }


     // fonction insert nouveau
    public function insert($imput){
        $programme = new programme();
        $programme->titre =  $imput['titre_progamme'];
        $programme->module_id =  $imput['list_module'];
        $programme->save();
    }

    public function edit($id,$imput){
        // $update = new Programme();
        $update=[
            'titre'=> $imput['titre_progamme'],
            'module_id' => $imput['list_module']
        ];
        programme::where('id',$id)->update($update);
    }

    public function supression($id){

      //  $res=programme::where('id',$id)->delete();
        $res=DB::delete('delete from programmes where id = ?', [$id]);
        if ($res){
          $data=[
          'success'=>'supression du programme est effectuer!'
        ];
        }else{
            $data=[
            'errors'=>'erreur des suppression du programme'
            ];
        }
        return response()->json($data);
    }

    //fonction de verification validation formulaire
    public function validation_form($imput){

        $rules=[
            'titre_progamme.required' => 'le titre ne doit pas etre null ',
            'titre_programme.string' => 'le titre de programme ne doit pas contenier des chiffres',
            'titre_progamme.regex' => 'le titre ne dois pas contenir des chiffre alors utiliser( _ ou - )',
            'titre_progamme.min' => 'le titre minimun doit contenir aux moins deux caracteres',
            'titre_progamme.max' => 'le titre ne doit pas depasser',
            'list_module.required' => 'le module ne doit pas etre null '
        ];
        $critereForm=[
            'titre_progamme' => 'required|regex:/^[\pL\s\-]+$/u|string|min:2|max:100',
            'list_module' =>'required'
        ];
          // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        // $imput->validate($critereForm);
        $imput->validate($critereForm, $rules);
    }

    public function validation_form2($imput){

        $rules=[
            'titre_progamme.required' => 'le titre ne doit pas etre null ',
            'titre_programme.string' => 'le titre de programme ne doit pas contenier des chiffres',
            'titre_progamme.alpha' => 'le titre ne dois pas contenir des chiffre ',
            'titre_progamme.min' => 'le titre minimun doit contenir aux moins deux caracteres',
            'titre_progamme.max' => 'le titre ne doit pas depasser',
            'list_module.required' => 'le module ne doit pas etre null '
        ];
        $critereForm=[
            'titre_progamme' => 'required|string|alpha|min:2|max:100',
            'list_module' =>'required'
        ];
        // $imput->validate($critereForm);
        $imput->validate($critereForm, $rules);
    }





}

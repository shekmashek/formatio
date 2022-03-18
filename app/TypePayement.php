<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class TypePayement extends Model
{
    protected $table="type_payement";
    protected $fillable=['id','type'];

    public function findAll(){
        return TypePayement::get();
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admins";
    protected $fillable = [
        'nom','user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}

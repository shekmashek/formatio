<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    protected $table="role_users";
    protected $fillable = [
        'id','user_id', 'role_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function role(){
        return $this->belongsTo('App\Role');
    }
}

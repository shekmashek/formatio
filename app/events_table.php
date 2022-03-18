<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events_table extends Model
{
    protected $table = "events_table";
    protected $fillable = [
        'id','start','title'
    ];
}

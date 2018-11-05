<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $fillable = [
        'user_id', 'order','date','status'
    ];
}

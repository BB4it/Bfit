<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    //

    protected $fillable=[
        'user_id','device_type','device_token','is_open'
    ];
}

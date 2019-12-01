<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable=[
        'name',
        'email',
        'phone',
        'another_phone',
        'sms_user_name',
        'sms_password',
        'sms_url',
        'sms_sender',
        'android_url',
        'ios_url',
        'commission',
        'keywords','description'
    ];

}

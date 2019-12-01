<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable=[
        'user_id',
        'title',
        'message',
        'type',
        'order_id',
    ];
}

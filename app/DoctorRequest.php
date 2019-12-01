<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorRequest extends Model
{
    //
    protected $fillable = ['name','phone','email','spcializtion'];
}

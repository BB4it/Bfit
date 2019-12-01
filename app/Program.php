<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $fillable = [
        'title','description','price','period','image','active','user_id','date','offer'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

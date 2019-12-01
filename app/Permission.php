<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $gaurd = 'permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'permission_name', 'table_name',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role')->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class,'admin_permission')->withTimestamps();
    }
}

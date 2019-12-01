<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $gaurd = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'role_name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role')->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_role')->withTimestamps();
    }
}

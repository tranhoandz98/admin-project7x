<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\UserRole;
use App\Models\Permission;

class Role extends Model
{
    //
    protected $guarded = [];

    // protected $fillable=[
    //     'name',
    //     'description',
    //     'created_by',
    //     'updated_by'
    // ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}

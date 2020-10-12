<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\User;
use App\Models\UserRole;
class Role extends Model
{
    //
protected $fillable=[
    'name',
    'description',
    'created_by',
    'updated_by'
];

public function users()
{
    return $this->belongsToMany(User::class,'user_role');
}

}

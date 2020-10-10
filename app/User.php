<?php

namespace App;

use App\Models\District;
use App\Models\Province;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\UserRole;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'display_name',
        'phone',
        'department',
        'code',
        'status',
        'type_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role');
    }

    // public function user_role(){
    //     return $this->hasOne(UserRole::class, 'user_id', 'id');
    // }
    public function districts(){
        return $this->belongsTo(District::class);
    }
    public function provinces(){
        return $this->belongsTo(Province::class);
    }
}

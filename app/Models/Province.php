<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Province extends Model
{
    //
    protected $table = 'cs_category_province';

    public function users(){
        $this->hasMany(User::class);
    }
    public function districts(){
        $this->hasMany(District::class,'province_id','code');
    }

}

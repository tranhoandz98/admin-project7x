<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Province extends Model
{
    //
    protected $table = 'cs_category_province';
    protected $guarded=[];

    public function users(){
       return $this->hasMany(User::class);
    }
    public function districts(){
       return $this->hasMany(District::class,'province_id','code');
    }

}

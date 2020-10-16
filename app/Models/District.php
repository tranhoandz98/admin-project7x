<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Province;

class District extends Model
{
    //
    protected $table = 'cs_category_district';
    protected $guarded=[];

    public function users(){
      return  $this->hasMany(User::class);
    }
    public function provinces(){
       return $this->belongsTo(Province::class,'district_id','code');
    }

}

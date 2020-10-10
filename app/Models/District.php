<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class District extends Model
{
    //
    protected $table = 'cs_category_district';

    public function users(){
        $this->hasMany(User::class);
    }

}

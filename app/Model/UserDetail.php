<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'f_user_detail';
    protected $guarded = [];


    public function getBalanceAttribute($value)
    {
        return $value*1/1;
    }
}

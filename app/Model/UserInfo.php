<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'f_userinfo';
    protected $guarded = [];

/*     public function getRegisterTimeAttribute()
    {
        return Carbon::now()->toDateString($this->attributes['register_time']);
    } */
}

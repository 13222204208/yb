<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alipay extends Model
{
    protected $table = 'bg_alipay';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DelNotice extends Model
{
    protected $table = 'f_del_notice';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

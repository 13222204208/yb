<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FastRecord extends Model
{
    protected $table = 'fast_record';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

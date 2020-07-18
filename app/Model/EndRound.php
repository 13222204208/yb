<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EndRound extends Model
{
    protected $table = 'g_endround';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

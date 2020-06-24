<?php

namespace App\Model;

use App\Model\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Betting extends Model
{
    use Timestamp;
    protected $table = 'bg_betting';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

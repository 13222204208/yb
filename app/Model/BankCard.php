<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $table = 'bg_bank_card';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}

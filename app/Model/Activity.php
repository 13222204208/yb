<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'bg_activity';
    protected $guarded = [];
    public $timestamps = false;
}

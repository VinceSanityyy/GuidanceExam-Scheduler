<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_type',
        'sched_date',
        'isConfirmed',
    ];
}

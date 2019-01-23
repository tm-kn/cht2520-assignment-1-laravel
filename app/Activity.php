<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'project',
        'activity',
        'start_datetime',
        'end_datetime',
        'description'
    ];

    public $timestamps = false;
}

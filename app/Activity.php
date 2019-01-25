<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];

    public function getDurationAttribute()
    {
        $end_datetime = $this->end_datetime ? $this->end_datetime : Carbon::now();
        return $end_datetime->diffAsCarbonInterval($this->start_datetime);
    }

    public function getStartDateAttribute()
    {
        return new Carbon($this->start_datetime->toDateString());
    }

    public function isActive()
    {
        return $this->end_datetime === null;
    }

    public function stop()
    {
        if (!$this->isActive()) {
            throw Exception('Cannot stop inactive activity.');
        }
        $this->end_datetime = Carbon::now();
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

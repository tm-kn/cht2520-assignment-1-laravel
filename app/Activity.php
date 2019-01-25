<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project',
        'activity',
        'start_datetime',
        'end_datetime',
        'description'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];

    /**
     * Get duration between start and end date.
     *
     * @return \Carbon\CarbonInterval
     */
    public function getDurationAttribute()
    {
        $end_datetime = $this->end_datetime ? $this->end_datetime : Carbon::now();
        return $end_datetime->diffAsCarbonInterval($this->start_datetime);
    }

    /**
     * Get start date without time.
     *
     * @return \Carbon\Carbon
     */
    public function getStartDateAttribute()
    {
        return new Carbon($this->start_datetime->toDateString());
    }

    /**
     * Check if activity is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return is_null($this->end_datetime);
    }

    /**
     * Stop an activity if it is active.
     */
    public function stop()
    {
        // Do not allow stoping inactive activities.
        if (!$this->isActive()) {
            throw Exception('Cannot stop inactive activity.');
        }
        $this->end_datetime = Carbon::now();
        $this->save();
    }

    /**
     * Get associated user.
     * @return \App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

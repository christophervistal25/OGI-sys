<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StudentViewGrade extends Model
{
    public $timestamps = false;

    protected $fillable = ['start_date', 'end_date'];

    protected $dates = [
        'start_date', 'end_date',
    ];

    public function setStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = Carbon::parse($value);
    }

    public function setEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = Carbon::parse($value);
    }

    public static function isStudentCanLogin()
    {
        $schedule = self::orderBy('start_date', 'DESC')->first();
        if (is_null($schedule)) {
            return false;
        } else {
            $time = Carbon::now();

            return $time->between($schedule->start_date, $schedule->end_date);
        }
    }
}

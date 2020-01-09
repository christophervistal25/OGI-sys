<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GradeEvaluation extends Model
{
    public $timestamps = false;
    protected $fillable = ['start_date', 'end_date'];
    protected $dates = [
    	'start_date', 'end_date'
    ];

    public static function canAdd()
    {
		$currentDate = date('Y-m-d') . ' 00:00:00';
		$date = self::where('start_date', '<=', $currentDate)
    				->where('end_date', '>=', $currentDate)
    				->first();
    	return $date;
    }
}

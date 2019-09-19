<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function courses()
    {
    	return $this->hasMany('App\Course');
    }

     /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomAction($department)
    {
        return view('admin.departments.includes.index_action', 
            compact('department'))->render();
    }
}
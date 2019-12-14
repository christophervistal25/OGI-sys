<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Department extends Model
{
    protected $fillable = ['name'];

    public function courses()
    {
    	return $this->hasMany('App\Course');
    }

    public function subjects()
    {
         return $this->hasMany('App\Subject');
    }

    public function instructors()
    {
         return $this->hasMany('App\Instructor');
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
    
    public static function laratablesName($department)
    {
        if (Str::contains(url()->previous(), 'department/students')) {
            // The request is from the list of students.
            return view('admin.departments.includes.clickable_name_student', compact('department'))->render();
        } else {
            return view('admin.departments.includes.clickable_name', compact('department'))->render();    
        }
    }
}

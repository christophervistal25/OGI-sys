<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_code', 'name', 'short_name', 'department_head', 'department_head_position'];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'department_id', 'id');
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
        return view(
            'admin.departments.includes.index_action',
            compact('department')
        )->render();
    }
}

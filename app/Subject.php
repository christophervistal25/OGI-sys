<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'level', 'credits', 'semester', 'school_year', 'department_id'];

    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_subjects', 'subject_id', 'student_id')
            ->withPivot('instructor_id', 'remarks')
            ->withTimestamps();
    }

    public function instructors()
    {
        return $this->belongsToMany('App\Instructor', 'instructor_subjects', 'subject_id', 'instructor_id')
            ->withPivot('block')
            ->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->with(['department']);
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomAction($subject)
    {
        return view('admin.subjects.includes.index_action', compact('subject'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomActionClick($subject)
    {
        return view('admin.studentsubject.includes.actions', compact('subject'))->render();
    }

    public static function laratablesName($subject)
    {
        $urlHasInstructorPrefix = request()->segment(1) === 'instructor';

        if ($urlHasInstructorPrefix) {
            return view('instructor.subjects.includes.clickable_name', compact('subject'))->render();
        } else {
            return view('admin.subjects.includes.clickable_name', compact('subject'))->render();
        }
    }
}

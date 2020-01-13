<?php

namespace App;

use App\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable
{
     use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // 'level'
    protected $fillable = [
        'firstname', 'middlename', 'lastname', 'name', 'password','birthdate', 'gender', 'profile', 'course_id', 'school_year', 'semester','level'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function(Student $student) {
            $studentCount = Student::count();
            $student->id_number = date('Y') . ++$studentCount;
            return true;
        });
    }

    public function getId(int $id_number) 
    {
        $this->primaryKey = 'id_number';
        return $this->find($id_number, ['id']);
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'student_subjects', 'student_id', 'subject_id')
                    ->withPivot('instructor_id', 'remarks')
                    ->withTimestamps();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public static function laratablesName($student)
    {
        return ucwords($student->name);
    }

    public static function laratablesGender($student)
    {
        return ucfirst($student->gender);
    }

    public static function laratablesCustomDepartment($student)
    {
        return $student->course->department->name;
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->with(['course', 'course.department']);
    }


    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomAction($student)
    {
        return view('admin.student.includes.index_action', compact('student'))->render();
    }

     /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomInstructorAction($student)
    {
        return view('instructor.subjects.includes.create_action', compact('student'))->render();
    }
}

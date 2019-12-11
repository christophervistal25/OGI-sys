<?php
namespace App;

use App\Instructor;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Instructor extends Authenticatable
{
     use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number', 'firstname','middlename', 'lastname', 'email', 'password', 'gender', 'profile', 'birthdate', 'active','status', 'civil_status', 'department_id', 'contact_no'
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
        self::creating(function(Instructor $instructor) {
            $instructorCount = Instructor::count();
            $instructor->id_number = date('Y') . ++$instructorCount;
            return true;
        });
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'instructor_subjects', 'instructor_id', 'subject_id')->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
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

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->with(['department']);
    }

    public static function laratablesFirstname($instructor)
    {
        return ucwords($instructor->firstname);
    }

    public static function laratablesLastname($instructor)
    {
        return ucwords($instructor->lastname);
    }

    public static function laratablesStatus($instructor)
    {
        return ucwords($instructor->status);
    }

    public static function laratablesCivilStatus($instructor)
    {
        return ucwords($instructor->civil_status);
    }

    public static function laratablesGender($instructor)
    {
        return ucfirst($instructor->gender);
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Instructor
     * @return string
     */
    public static function laratablesCustomAction($instructor)
    {
        return view('admin.instructor.includes.index_action', compact('instructor'))->render();
    }

    public static function laratablesIdNumber($instructor)
    {
        return view('admin.instructor.includes.profile', compact('instructor'))->render();
    }

}

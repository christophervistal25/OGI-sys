<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'abbr', 'department_id'];

    public function student()
    {
        return $this->hasOne('App\Student');
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
     * Adds the condition for searching the name of the user in the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param string search term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function laratablesSearchDepartment($query, $searchValue)
    {
        return $query->orWhere('name', 'like', '%'.$searchValue.'%');
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomAction($course)
    {
        return view(
            'admin.courses.includes.index_action',
            compact('course')
        )->render();
    }
}

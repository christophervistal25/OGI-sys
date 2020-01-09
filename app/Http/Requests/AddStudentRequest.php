<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Course;
use App\Subject;

class AddStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $courses = Course::pluck('id')->toArray();
      return [
         'firstname'  => 'required',
         'middlename' => 'required',
         'lastname'   => 'required',
         'gender'                 => ['required', Rule::in(['male', 'female'])],
         'course_id'              => ['required', Rule::in($courses)],
         'password'               => 'required|confirmed|min:8|max:20',
         'school_year' => 'required',
         'semester' => ['required', Rule::in([1, 2, 3])],
        ];

    }

    public function attributes()
    {
        return [
            'course_id'              => 'course',
            'id_number'              => 'ID number',
            'level'             => 'year level'
        ];
    }

}

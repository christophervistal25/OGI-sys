<?php

namespace App\Http\Requests\Instructors;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddInstructorRequest extends FormRequest
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
        $departments = Department::pluck('id');

        return [
            'firstname' => ['required'],
            'middlename' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'unique:instructors'],
            'contact_no' => ['required', 'unique:instructors'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'work_status' => ['required', Rule::in(['full-time', 'part-time'])],
            'civil_status' => ['required', Rule::in(['widow', 'married', 'single'])],
            'department_id' => ['required', Rule::in($departments)],
            'password' => ['required', 'confirmed', 'min:8', 'max:20'],
            'birthdate' => ['required', 'date'],
            'profile' => ['nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'id_number' => 'employee number',
            'department_id' => 'department',
        ];
    }
}

<?php

namespace App\Http\Requests\Instructors;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditInstructorRequest extends FormRequest
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
        $id = request()->segment(3);

        $gender = ['male', 'female'];
        $status = ['full-time', 'part-time'];

        $departments = Department::pluck('id');

        $rules = [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:instructors,email,'.$id,
            'contact_no' => 'required|unique:instructors,contact_no,'.$id,
            'gender' => ['required', Rule::in($gender)],
            'work_status' => ['required', Rule::in($status)],
            'civil_status' => ['required', Rule::in(['widow', 'married', 'single'])],
            'department_id' => ['required', Rule::in($departments)],
            'birthdate' => 'required|date',
            'profile' => 'nullable',
        ];

        if (! is_null(request('password')) || ! is_null(request()->password_confirmation)) {
            $rules['password'] = 'required|confirmed|min:8|max:20';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'id_number' => 'employee number',
            'department_id' => 'department',
        ];
    }
}

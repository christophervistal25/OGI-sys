<?php

namespace App\Http\Requests\Admin;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCourseRequest extends FormRequest
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
            'name' => 'required|unique:courses',
            'abbr' => 'required',
            'department_id' => ['required', Rule::in($departments)],
        ];
    }

    public function attributes()
    {
        return [
            'department_id' => 'department',
        ];
    }
}

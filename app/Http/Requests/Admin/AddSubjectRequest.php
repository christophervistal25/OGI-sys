<?php

namespace App\Http\Requests\Admin;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddSubjectRequest extends FormRequest
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
            'name' => 'unique:subjects|required',
            'level' => 'required',
            'credits' => 'required|numeric',
            'description' => 'required',
            'school_year' => 'required',
            'department_id' => ['required', 'numeric', Rule::in($departments)],
            'semester' => ['required', Rule::in([1, 2, 3])],
        ];
    }

    public function attributes()
    {
        return [
            'department_id' => 'department',
            'name' => 'course no',
        ];
    }
}

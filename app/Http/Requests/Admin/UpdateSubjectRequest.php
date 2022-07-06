<?php

namespace App\Http\Requests\Admin;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
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
        $departments = Department::pluck('id');

        return [
            'semester' => ['required', Rule::in([1, 2, 3])],
            'level' => 'required|numeric',
            'credits' => 'required|numeric',
            'name' => 'required|unique:subjects,name,'.$id,
            'school_year' => 'required',
            'description' => 'required',
            'department_id' => ['required', 'numeric', Rule::in($departments)],
        ];
    }

    public function attributes()
    {
        return [
            'department_id' => 'department',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddStudentSubjectRequest extends FormRequest
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
        return [
            'subjects.name.*' => 'required',
            'subjects.description.*' => 'required',
            'subjects.level.*' => 'required',
            'subjects.semester.*' => ['required', Rule::in([1, 2, 3])],
        ];
    }

    public function attributes()
    {
        return [
            'subjects.name.*' => 'subject name',
            'subjects.description.*' => 'subject description',
            'subjects.level.*' => 'subject level',
            'subjects.semester.*' => 'subject semester',
        ];
    }
}

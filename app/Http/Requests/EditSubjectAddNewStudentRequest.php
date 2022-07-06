<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSubjectAddNewStudentRequest extends FormRequest
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
            'students.names' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'students.names' => 'student',
        ];
    }

    public function messages()
    {
        return [
            'students.names.required' => 'Please add some student.',
        ];
    }
}

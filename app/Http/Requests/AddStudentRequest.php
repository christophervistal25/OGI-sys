<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'firstname' => ['required'],
            'middlename' => ['nullable', 'min:2'],
            'lastname' => ['required'],
            'suffix' => ['nullable', 'min:2'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'civil_status' => ['required'],
            'citizenship' => ['required'],
            'birthdate' => ['required', 'date'],
            'email' => ['required'],
            'contact_no' => ['required'],
            'address' => ['required'],
            'elementary' => ['required'],
            'elementary_average' => ['required', 'numeric'],
            'elementary_from' => ['required', 'date', 'before:elementary_to'],
            'elementary_to' => ['required', 'date', 'after:elementary_from'],
            'elementary_address' => ['required'],
            'secondary' => ['required'],
            'secondary_average' => ['required', 'numeric'],
            'secondary_from' => ['required', 'date', 'before:secondary_to'],
            'secondary_to' => ['required', 'date', 'after:secondary_from'],
            'secondary_address' => ['required'],
            'mother_name' => ['required'],
            'mother_lastname' => ['required'],
            'mother_middlename' => ['nullable', 'min:2'],
            'mother_contact_no' => ['required'],
            'father_name' => ['required'],
            'father_lastname' => ['required'],
            'father_suffix ' => ['nullable', 'min:2'],
            'father_middlename' => ['nullable', 'min:2'],
            'father_contact_no' => ['required'],
            'achievements.*' => ['nullable', 'min:5'],
        ];
    }

    public function attributes()
    {
        return [
            'course_id' => 'course',
            'id_number' => 'ID number',
            'level' => 'year level',
            'father_name' => 'father firstname',
            'mother_name' => 'mother firstname',
        ];
    }
}

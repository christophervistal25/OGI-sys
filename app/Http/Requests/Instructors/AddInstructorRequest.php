<?php

namespace App\Http\Requests\Instructors;

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
              return [
              'name'      => 'required',
              'gender'    => ['required', Rule::in(['male', 'female'])],
              'password'  => 'required|confirmed|min:8|max:20',
              'birthdate' => 'required|date',
              'profile'   => 'nullable',
        ];
    }


    public function attributes()
    {
        return [
            'id_number' => 'employee number',
        ];
    }


}

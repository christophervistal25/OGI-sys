<?php

namespace App\Http\Requests\Admin;

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
        return [
            'semester'    => ['required', Rule::in([1, 2 , 3])],
            'level'       => 'required|numeric',
            'name'        => 'required|unique:subjects,name,'.request('id'),
            'description' => 'required',
        ];

    }
}
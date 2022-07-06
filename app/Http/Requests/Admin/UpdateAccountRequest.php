<?php

namespace App\Http\Requests\Admin;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            // 'firstname'  => 'required',
            // 'lastname'   => 'required',
            // 'contact_no' => 'required|unique:instructors,contact_no,' . Auth::user()->id,
            'profile' => 'nullable',
        ];

        if (! is_null(request()->password) || ! is_null(request()->password_confirmation)) {
            $rules['password'] = 'required|confirmed|min:8|max:20';
        }

        return $rules;
    }
}

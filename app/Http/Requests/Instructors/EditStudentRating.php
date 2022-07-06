<?php

namespace App\Http\Requests\Instructors;

use Illuminate\Foundation\Http\FormRequest;

class EditStudentRating extends FormRequest
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
            'pivot.remarks' => 'nullable|numeric|min:0|max:5|regex:/^[0-5](.+)?$/',
        ];
    }

    public function attributes()
    {
        return [
            'pivot.remarks' => 'rating',
        ];
    }
}

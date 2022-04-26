<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerValidationStudent extends FormRequest
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
        return 
        [
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100',
            'password' => 'required|min:1|max:100',
            'gender' => 'required',
            'course' => 'required',
            'year' => 'required'
        ];
    }
}
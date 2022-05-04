<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateValidation extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100',
            'gender' => 'required|in:M,F,O',
            'course' => 'required',
            'year' => 'required|min:4'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerValidation extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules()
    {
        return[
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100',
            'password' => 'required|min:1|max:100',
            'gender' => 'required',
            'course' => 'required'
        ];
    }
}

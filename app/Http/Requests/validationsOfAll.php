<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationsOfAll extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array
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
                'username' => 'required|min:3|max:100',
                'password' => 'required|min:1|max:100', 
                /*
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation'=>'required|confirmed',
                'gender' => 'required',
                'course' => 'required',
                'year' => 'required'
                */
            ];
    }
}

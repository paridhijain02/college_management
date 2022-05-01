<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationsOfAll extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
                'username' => 'required|min:3|max:100',
                'password' => 'required|min:5|max:100', 
            ];
    }
}

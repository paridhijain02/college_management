<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class assignmentVal extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'assignment' => 'required|min:3|max:200',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class assignmentDoneVal extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'done_assignment' => 'required|min:3|max:220'
        ];
    }
}

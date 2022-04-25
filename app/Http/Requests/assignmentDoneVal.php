<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class assignmentDoneVal extends FormRequest
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
            'done_assignment' => 'required|min:3|max:220'
        ];
    }
}

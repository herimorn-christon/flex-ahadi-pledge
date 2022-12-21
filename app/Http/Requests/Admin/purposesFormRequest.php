<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class purposesFormRequest extends FormRequest
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
        $rules=[
            'title'=>[
                'required',
                'string',
                'max:200'
            ],
            'start_date'=>[
                'required'
            ],
            'end_date'=>[
                'required'
            ], 
            'description'=>[
                'required'
            ]   
        ];

        return $rules;
    }
}

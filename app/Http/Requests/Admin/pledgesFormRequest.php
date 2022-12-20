<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class pledgesFormRequest extends FormRequest
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
            'type_id'=>[
                'required',
                'integer'
            ],
            'name'=>[
                'required',
                'string',
                'max:200'
            ],
            'amount'=>[
                'required'
            ],
            'deadline'=>[
                'required'
            ], 
            'description'=>[
                'required'
            ]   
        ];

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class paymentsFormRequest extends FormRequest
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
            'user_id'=>[
                'required',
                'integer'
            ],
            'pledge_id'=>[
                'required',
                'integer'
            ],
            'amount'=>[
                'required'
            ]
        ];

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class updateMemberFormRequest extends FormRequest
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
                'fname' => ['required', 'string', 'max:255'],
                'fname' => ['required', 'string', 'max:255'],
                'mname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:13'],
                'jumuiya' => ['required'],
                'date_of_birth' => ['required'],
                'gender' => ['required'],
                'email' => [ 'string','max:255']
            ];
    
            return $rules;
        }
    }


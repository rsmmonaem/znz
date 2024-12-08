<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'designation_id' => 'required',
            'date_of_joining' => 'required|date',
            'role_id' => '', // Optional field, no rules needed
            'password' => 'confirmed|min:6', // Optional if not required
            'employee_code' => 'required|unique:profile',
            'email' => 'email|max:255|unique:users', // Optional by default
            'username' => 'min:4|max:255|alpha_num|unique:users', // Optional by default
            'password_confirmation' => 'same:password', // Optional by default
        ];
    }

    public function attributes()
    {
        return[
            'role_id' => 'role',
            'designation_id' => 'designation',
        ];

    }
}

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:255',
            'surname'       => 'required|max:255',
            'street'        => 'required',
            'nr'            => 'required',
            'city'          => 'required',
            'postalcode'    => 'required',
            'country'       => 'required',

            'login'         => 'required',
            'email'         => 'required|email|max:255|unique:users',
            'password'      => 'required|confirmed|min:4',
        ];
    }
}

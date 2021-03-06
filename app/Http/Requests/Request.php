<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    return  [

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

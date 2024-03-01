<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'address' => 'required',
            'city' => 'required',
            'password' => 'required|min:6',
            'passwordc' => 'required|min:6'
        ];
    }
}

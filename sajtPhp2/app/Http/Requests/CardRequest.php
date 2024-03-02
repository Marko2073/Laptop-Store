<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cardnumber' => 'required|string|min:20,max:20',
            'cardname' => 'required|string',
            'expirationdate' => 'required|string|min:5,max:5',
            'cvv' => 'required|numeric|digits:3'
        ];
    }
}

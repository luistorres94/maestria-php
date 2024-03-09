<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CambiaPasswordRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'La contraseña es obligatoria',
            'password_confirmation.required' => 'Se requiere la confirmacion',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}

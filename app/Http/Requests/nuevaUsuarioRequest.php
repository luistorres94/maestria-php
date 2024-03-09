<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class nuevaUsuarioRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'user_name' => 'required|unique:users,user_name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'rol' => 'required|not_in:0|exists:rols,id'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
            'user_name.required' => 'El usuario es obligatorio',
            'user_name.unique' => 'El usuario ya existe',
            'email.required' => 'El correo es obligatorio',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'La contraseña es obligatoria',
            'rol.required' => 'El rol es obligatorio',
            'rol.not_in' => 'Selecciona una opcion valida',
            'rol.exists' => 'Rol no existente en base de datos'
        ];
    }
}

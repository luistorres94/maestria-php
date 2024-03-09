<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class editaUsuarioRequest extends FormRequest
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
            'name' => 'required',Rule::unique('users', 'usuario')->ignore($this->route('id'), 'id'),
            'user_name' => 'required',Rule::unique('users', 'user_name')->ignore($this->route('id'),'id'),
            'email' => 'required',Rule::unique('users', 'email')->ignore($this->route('id'),'id'),
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
            'rol.required' => 'El rol es obligatorio',
            'rol.not_in' => 'Selecciona una opcion valida',
            'rol.exists' => 'Rol no existente en base de datos'
        ];
    }
}

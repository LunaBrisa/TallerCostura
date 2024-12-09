<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveClientesRequest extends FormRequest
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
            'nombre' => 'required|string|max:100|min:3',
            'apellido_p' => 'required|string|max:60|min:3',
            'apellido_m' => 'required|string|max:60|min:3',
            'telefono' => 'required|digits:10|unique:PERSONAS,telefono',
            'compania' => 'nullable|string|max:100',
            'cargo' => 'nullable|min:3|max:100',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|outlook\.com|[a-zA-Z0-9.-]+\.edu\.mx)$/'
            ],
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array{
        return [
            'nombre.required' => 'El nombre de la persona es obligatorio. Intente de nuevo',
            'nombre.regex' => 'El nombre de la persona solo puede contener letras y espacios',
            'nombre.max' => 'El nombre de la persona no puede tener mas de 100 caracteres',
            'nombre.min' => 'El nombre de la persona no puede tener menos de 3 caracteres',
            'apellido_p.required' => 'El apellido paterno es obligatorio. Intente de nuevo',
            'apellido_p.regex' => 'El apellido paterno solo puede contener letras y espacios',
            'apellido_p.max' => 'El apellido paterno no puede tener mas de 60 caracteres',
            'apellido_p.min' => 'El apellido paterno no puede tener menos de 3 caracteres',
            'apellido_m.required' => 'El apellido materno es obligatorio. Intente de nuevo',
            'apellido_m.regex' => 'El apellido materno solo puede contener letras y espacios',
            'apellido_m.max' => 'El apellido materno no puede tener mas de 60 caracteres',
            'apellido_m.min' => 'El apellido materno no puede tener menos de 3 caracteres',
            'telefono.required' => 'El telefono es obligatorio. Intente de nuevo',
            'telefono.digits' => 'El telefono solo puede contener numeros y 10 digitos',
            'telefono.unique' => 'El telefono ya ha sido registrado',
            'compania.string' => 'La compañia solo puede contener letras y espacios',
            'compania.max' => 'La compañia no puede tener mas de 100 caracteres',
            'cargo.nullable' => 'El cargo es obligatorio. Intente de nuevo',
            'cargo.min' => 'El cargo no puede tener menos de 3 caracteres',
            'cargo.max' => 'El cargo no puede tener mas de 100 caracteres',
            'name.required' => 'El nombre es obligatorio. Intente de nuevo',
            'name.string' => 'El nombre solo puede contener letras y espacios',
            'name.max' => 'El nombre no puede tener mas de 255 caracteres',
            'email.required' => 'El correo es obligatorio. Intente de nuevo',
            'email.email' => 'El correo solo puede contener letras y espacios',
            'email.regex' => 'El dominio del correo no es válido',
            'password.required' => 'La contraseña es obligatoria. Intente de nuevo',
            'password.string' => 'La contraseña solo puede contener letras y espacios',
            'password.min' => 'La contraseña no puede tener menos de 8 caracteres',
            'password.confirmed' => 'La contraseña no coincide',
        ];
    }
}

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
            'nombre_usuario' => 'required|string|min:3|max:50',
            'contrasena' => 'required|string|min:6|max:10',
            'nombre' => 'required|alpha_spaces|min:3|max:50',
            'apellido_p' => 'required|alpha_spaces|min:3|max:50',
            'apellido_m' => 'required|alpha_spaces|max:255',
            'telefono' => 'required|digits:10',
            'correo' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|edu|gov)',
            'compania' => 'required|alpha_spaces|min:5|max:50',
            'cargo' => 'max:50',
        ];
    }
}

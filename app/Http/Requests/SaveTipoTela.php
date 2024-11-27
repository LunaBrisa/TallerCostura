<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTipoTela extends FormRequest
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
            'tipotelita' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50']
        ];
    }

    public function messages(): array
    {
        return [
            'tipotelita.required' => 'El nombre de la tela es obligatorio. Intente de nuevo',
            'tipotelita.regex' => 'El nombre de la tela solo puede contener letras y espacios',
            'tipotelita.max' => 'El nombre de la tela no puede tener mas de 50 caracteres'
        ];
    }
}

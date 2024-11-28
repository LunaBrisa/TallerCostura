<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelasRequest extends FormRequest
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
            'telita' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50'],
            'tipotelita' => ['required', 'numeric', 'exists:MATERIALES_TELAS,id'],
            'preciotelita' => ['required', 'decimal:2',],
        ];
    }

    public function messages(): array
    {
        return [
            'telita.required' => 'El nombre de la tela es obligatorio. Intente de nuevo',
            'telita.regex' => 'El nombre de la tela solo puede contener letras y espacios',
            'telita.max' => 'El nombre de la tela no puede tener mas de 50 caracteres',
            'tipotelita.required' => 'El tipo de tela es obligatorio. Intente de nuevo',
            'tipotelita.numeric' => 'El tipo de tela es invalido. Intente de nuevo',
            'tipotelita.exists' => 'El tipo de tela no se ha encontrado. Intente de nuevo',
            'preciotelita.required' => 'El precio de la tela es obligatorio. Intente de nuevo',
            'preciotelita.decimal' => 'El precio de la tela esta en un formato invalido. Formato correcto: 0.00',
        ];
    }
}

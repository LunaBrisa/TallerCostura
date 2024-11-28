<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifTelaRequest extends FormRequest
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
            'idtela' => ['required'],
            'telilla' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50'],
            'tipotelilla' => ['nullable', 'numeric', 'exists:MATERIALES_TELAS,id'],
            'preciotelilla' => ['nullable', 'decimal:2']
        ];
    }

    public function messages(): array{
        return [
            'idtela.required' => 'La tela no es valida',
            'telilla.max' => 'El campo nombre de la tela debe tener menos de 50 caracteres',
            'telilla.regex' => 'El campo nombre de la tela solo puede contener letras y espacios',
            'tipotelilla.exists' => 'El campo tipo de la tela es invalido',
            'tipotelilla.numeric' => 'El tipo de tela es invalido',
            'preciotelilla.decimal' => 'El formato del precio es invalido. Formato correcto: 0.00'
        ];
    }
}

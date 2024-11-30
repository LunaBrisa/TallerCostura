<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrendaTelaRequest extends FormRequest
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
            'telitaprendita' => ['required', 'exists:TELAS,id', 'numeric'],
            'cantidadtelitaprenda' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'telitaprendita.required' => 'Se debe de seleccionar una tela.',
            'telitaprendita.exists' => 'La tela seleccionada no es valida.',
            'telitaprendita.numeric' => 'La tela seleccionada no es valida.',
            'cantidadtelitaprenda.required' => 'Se debe de ingresar una cantidad de tela.',
            'cantidadtelitaprenda.numeric' => 'La cantidad debe ser un numero entero',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class modifCantidadTelaRequest extends FormRequest
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
            'idtela' => ['required', 'exists:PRENDAS_TELAS,id', 'numeric'],
            'cantidadsota' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'idtela.required' => 'Se debe de seleccionar una tela.',
            'idtela.exists' => 'La tela seleccionada no es valida.',
            'idtela.numeric' => 'La tela seleccionada no es valida.',
            'cantidadsota.required' => 'Se debe de ingresar una cantidad de tela.',
            'cantidadsota.numeric' => 'La cantidad debe ser un numero entero',
        ];
    }
}

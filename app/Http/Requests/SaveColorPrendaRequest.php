<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveColorPrendaRequest extends FormRequest
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
            'colorprenda' => ['required', 'exists:COLORES,id', 'numeric'],
            'imagencolorsillo' => ['required', 'max:255'],
            'idprenda' => ['required', 'exists:PRENDAS_CONFECCIONES,id', 'numeric']
        ];
    }

    public function messages(): array{
        return [
            'colorprenda.required' => 'El color de la prenda es obligatorio',
            'colorprenda.exists' => 'El color de la prenda es invalido',
            'colorprenda.numeric' => 'El color de la prenda es invalido',
            'imagencolorsillo.required' => 'La imagen de la prenda con el color es obligatoria',
            'imagencolorsillo.max' => 'La imagen de la prenda con el color no puede tener mas de 255 caracteres',
            'idprenda.exists' => 'La prenda de la que se trata no existe',
            'idprenda.numeric' => 'La prenda de la que se trata no existe',
        ];
    }
}

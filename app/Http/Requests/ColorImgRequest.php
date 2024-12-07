<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorImgRequest extends FormRequest
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
            'idprenda' => ['required', 'exists:PRENDAS_COLORES,id', 'numeric'],
            'imagencolorsillo' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array{
        return [
            'file.required' => 'Debe subir una imagen',
            'file.mimes' => 'El archivo debe ser de tipo JPG, JPEG, PNG',
            'file.max' => 'El archivo es muy grande',
            'idprenda.required' => 'El id de la prenda es obligatorio',
            'idprenda.exists' => 'El id de la prenda es invalido',
            'idprenda.numeric' => 'El id de la prenda es invalido',
        ];
    }
}

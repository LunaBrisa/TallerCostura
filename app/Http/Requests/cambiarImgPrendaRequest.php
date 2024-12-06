<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cambiarImgPrendaRequest extends FormRequest
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
            'imagensonaprenda' => 'required|image|mimes:jpeg,png,jpg,svg|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'imagensonaprenda.required' => 'El campo "Imagen de la Prenda" es requerido.',
            'imagensonaprenda.mimes' => 'El campo "Imagen de la Prenda" debe ser un archivo de imagen.',
            'imagensonaprenda.max' => 'El campo "Imagen de la Prenda" debe ser menor a 1024KB.',
        ];
    }
}

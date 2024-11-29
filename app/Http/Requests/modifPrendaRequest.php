<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class modifPrendaRequest extends FormRequest
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
            'idesote' => ['required','numeric'],
            'nombreprendota' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50'],
            'descripcionprendota' => ['nullable', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:255'],
            'precioprendota' => ['nullable', 'decimal:2'],
            'generote' => ['nullable', 'in:Hombre,Mujer,Infantil'],
            'tipoprendota' => ['nullable', 'exists:TIPOS_PRENDAS,id', 'numeric'],
            'imagensotaprenda' => ['nullable', 'image', 'max:255']
        ];
    }

    public function messages(): array{
        return [
            'nombreprendota.regex' => 'El nombre de la prenda solo puede contener letras y espacios',
            'nombreprendota.max' => 'El nombre de la prenda no puede tener mas de 50 caracteres',
            'descripcionprendota.regex' => 'La descripcion de la prenda solo puede contener letras y espacios',
            'descripcionprendota.max' => 'La descripcion de la prenda no puede tener mas de 255 caracteres',
            'precioprendota.decimal' => 'El formato del precio es invalido. Formato correcto: 0.00',
            'tipoprendota.exists' => 'El tipo de prenda es invalido',
            'tipoprendota.numeric' => 'El tipo de prenda es invalido',
            'generote.in' => 'El genero de la prenda es invalido',
            'imagensotaprenda.image' => 'La imagen de la prenda solo puede ser de formato JPG, JPEG, PNG, GIF o BMP',
            'imagensotaprenda.max' => 'La imagen de la prenda no puede tener mas de 255 caracteres'
        ];
    }
}

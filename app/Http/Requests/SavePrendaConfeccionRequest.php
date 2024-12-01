<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePrendaConfeccionRequest extends FormRequest
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
            'nombreprendita' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50'],
            'descripcionprendita' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:255'],
            'precio_obra_prendita' => ['required', 'decimal:2'],
            'generito' => ['required', 'in:Hombre,Mujer,Infantil'],
            'tipoprendita' => ['required', 'exists:TIPOS_PRENDAS,id', 'numeric'],
            'ruta_imagen' => ['required', 'image', 'max:2048'],
        ];
    }

    public function messages(): array{
        return [
            'nombreprendita.required' => 'El nombre de la prenda es obligatorio. Intente de nuevo',
            'nombreprendita.regex' => 'El nombre de la prenda solo puede contener letras y espacios',
            'nombreprendita.max' => 'El nombre de la prenda no puede tener mas de 50 caracteres',
            'descripcionprendita.required' => 'La descripcion de la prenda es obligatoria. Intente de nuevo',
            'descripcionprendita.regex' => 'La descripcion de la prenda solo puede contener letras y espacios',
            'descripcionprendita.max' => 'La descripcion de la prenda no puede tener mas de 255 caracteres',
            'precio_obra_prendita.required' => 'El precio de la prenda es obligatorio. Intente de nuevo',
            'precio_obra_prendita.decimal' => 'El formato del precio es invalido. Formato correcto: 0.00',
            'tipoprendita.required' => 'El tipo de prenda es invalido',
            'tipoprendita.exists' => 'El tipo de prenda es invalido',
            'tipoprendita.numeric' => 'El tipo de prenda es invalido',
            'generito.required' => 'El genero de la prenda es invalido',
            'generito.in' => 'El genero de la prenda es invalido',
            'ruta_imagen.required' => 'La imagen de la prenda es obligatoria. Intente de nuevo',
            'ruta_imagen.image' => 'La imagen de la prenda es invalido. Formato incorrecto',
            'ruta_imagen.max' => 'La imagen de la prenda es invalido. El tamaño de la imagen es invalido',
        ];
    }
}

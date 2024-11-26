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
            'nombreprendita' => ['required', 'max:50'],
            'descripcionprendita' => ['required', 'max:250'],
            'precio-obra-prendita' => ['required', 'decimal:2'],
            'precio-telas-prendita' => ['required', 'decimal:2'],
            'generito' => ['required', 'in:Hombre,Mujer'],
            'tipoprendita' => ['required', 'exists:TIPOS_PRENDAS,id', 'numeric']
        ];
    }
}

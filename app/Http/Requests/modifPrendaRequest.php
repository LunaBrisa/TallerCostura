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
            'nombreprendota' => ['nullable', 'max:50'],
            'descripcionprendota' => ['nullable', 'max:250'],
            'precioprendota' => ['nullable', 'decimal:2'],
            'generote' => ['nullable', 'in:Hombre,Mujer'],
            'tipoprendota' => ['nullable', 'exists:TIPOS_PRENDAS,id', 'numeric']
        ];
    }
}

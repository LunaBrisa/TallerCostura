<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTipoPrendaRequest extends FormRequest
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
            'tipoprendita' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:50'],
        ];
    }

    public function messages(): array{
        return [
            'tipoprendita.required' => 'El nombre del tipo de prenda es obligatorio. Intente de nuevo',
            'tipoprendita.regex' => 'El nombre del tipo de prenda solo puede contener letras y espacios',
            'tipoprendita.max' => 'El nombre del tipo de prenda no puede tener mas de 50 caracteres'
        ];
    }
}

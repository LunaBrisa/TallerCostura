<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifTipoPrendaRequest extends FormRequest
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
            'idtp' => ['required'],
            'tipoprendilla' => ['required', 'max:50']
        ];
    }

    public function messages(): array{
        return [
            'idtp.required' => 'El tipo de prenda es invalido',
            'tipoprendilla.required' => 'El nombre del tipo de prenda es obligatorio. Intente de nuevo',
            'tipoprendilla.max' => 'El nombre del tipo de prenda no puede tener mas de 50 caracteres'
        ];
    }
}

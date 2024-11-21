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
}

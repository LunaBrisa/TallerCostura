<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifTelaRequest extends FormRequest
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
            'idtela' => ['required'],
            'telilla' => ['required', 'max:50'],
            'tipotelilla' => ['required', 'numeric', 'exists:MATERIALES_TELAS,id']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifMateTelaRequest extends FormRequest
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
            'idmate' => ['required', 'numeric'],
            'materialtelilla' => ['required', 'regex:/^[\pL\s]+$/u', 'max:50']
        ];
    }

    public function messages(): array
    {
        return [
            'idmate.required' => 'No se ha detectado una tela',
            'idmate.numeric' => 'No se ha detectado una tela',
            'materialtelilla.required' => 'El nombre de la tela es obligatorio',
            'materialtelilla.regex' => 'El nombre de la tela solo puede contener letras y espacios',
            'materialtelilla.max' => 'El nombre de la tela no puede tener mas de 50 caracteres'
        ];
    }
}

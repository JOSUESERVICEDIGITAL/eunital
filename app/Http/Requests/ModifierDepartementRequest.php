<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierDepartementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $departement = $this->route('departement');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departements', 'nom')->ignore($departement?->id),
            ],
            'description' => ['nullable', 'string', 'max:3000'],
            'est_actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du département est obligatoire.',
            'nom.unique' => 'Ce département existe déjà.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierPosteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $poste = $this->route('poste');

        return [
            'departement_id' => ['nullable', 'exists:departements,id'],
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('postes', 'nom')->ignore($poste?->id),
            ],
            'description' => ['nullable', 'string', 'max:3000'],
            'est_actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du poste est obligatoire.',
            'nom.unique' => 'Ce poste existe déjà.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
        ];
    }
}

<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class InnovationIndicateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'unite' => ['nullable', 'string', 'max:100'],
            'valeur_reference' => ['nullable', 'numeric'],
            'valeur_cible' => ['nullable', 'numeric'],
            'valeur_actuelle' => ['nullable', 'numeric'],
        ];
    }
}

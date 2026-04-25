<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class DeploiementCouvertureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deploiement_innovation_id' => ['required', 'exists:deploiements_innovation,id'],
            'niveau_couverture' => ['nullable', 'string', 'max:255'],
            'structures_cibles' => ['nullable', 'integer', 'min:0'],
            'structures_couvertes' => ['nullable', 'integer', 'min:0'],
            'taux_couverture' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'date_mesure' => ['nullable', 'date'],
            'observation' => ['nullable', 'string'],
        ];
    }
}

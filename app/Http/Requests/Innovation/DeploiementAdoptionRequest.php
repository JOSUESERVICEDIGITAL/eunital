<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class DeploiementAdoptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deploiement_innovation_id' => ['required', 'exists:deploiements_innovation,id'],
            'zone' => ['nullable', 'string', 'max:255'],
            'beneficiaires_cibles' => ['nullable', 'integer', 'min:0'],
            'beneficiaires_actifs' => ['nullable', 'integer', 'min:0'],
            'taux_adoption' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'date_mesure' => ['nullable', 'date'],
        ];
    }
}

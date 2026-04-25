<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deploiement_adoption_id' => ['required', 'exists:deploiement_adoptions,id'],
            'segment' => ['nullable', 'string', 'max:255'],
            'categorie' => ['nullable', 'string', 'max:255'],
            'population_cible' => ['nullable', 'integer', 'min:0'],
            'population_active' => ['nullable', 'integer', 'min:0'],
            'taux_adoption' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'date_mesure' => ['nullable', 'date'],
            'observation' => ['nullable', 'string'],
        ];
    }
}

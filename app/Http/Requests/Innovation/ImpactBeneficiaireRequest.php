<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ImpactBeneficiaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'impact_innovation_id' => ['required', 'exists:impacts_innovation,id'],
            'categorie_beneficiaire' => ['required', 'string', 'max:255'],
            'nombre' => ['nullable', 'integer', 'min:0'],
            'observation' => ['nullable', 'string'],
        ];
    }
}

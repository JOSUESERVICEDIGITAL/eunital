<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeploiementZoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deploiement_innovation_id' => ['required', 'exists:deploiements_innovation,id'],
            'region_id' => ['nullable', 'integer'],
            'province_id' => ['nullable', 'integer'],
            'commune_id' => ['nullable', 'integer'],
            'statut' => ['required', Rule::in(['non_demarre', 'en_cours', 'termine'])],
            'date_deploiement' => ['nullable', 'date'],
        ];
    }
}

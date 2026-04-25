<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ImpactInnovationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],

            'type_impact' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'periode_mesure' => ['required', 'string'],

            'valeur_avant' => ['nullable', 'numeric'],
            'valeur_apres' => ['nullable', 'numeric'],
            'variation' => ['nullable', 'numeric'],
        ];
    }
}

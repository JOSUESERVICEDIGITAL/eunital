<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ImpactMesureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'impact_innovation_id' => ['required', 'exists:impacts_innovation,id'],
            'indicateur' => ['required', 'string', 'max:255'],
            'unite' => ['nullable', 'string', 'max:100'],
            'valeur' => ['nullable', 'numeric'],
            'date_mesure' => ['nullable', 'date'],
        ];
    }
}

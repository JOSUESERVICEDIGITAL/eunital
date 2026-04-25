<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ImpactRapportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'impact_innovation_id' => ['required', 'exists:impacts_innovation,id'],
            'titre' => ['required', 'string', 'max:255'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'resume' => ['nullable', 'string'],
            'redige_par' => ['nullable', 'exists:users,id'],
        ];
    }
}

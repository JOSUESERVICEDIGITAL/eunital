<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class SuiviInnovationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],

            'date_suivi' => ['required', 'date'],
            'statut_global' => ['required', 'string'],

            'resume' => ['nullable', 'string'],
            'progression' => ['nullable', 'integer', 'min:0', 'max:100'],

            'risques_majeurs' => ['nullable', 'string'],
            'recommandations' => ['nullable', 'string'],

            'redige_par' => ['nullable', 'exists:users,id'],
        ];
    }
}

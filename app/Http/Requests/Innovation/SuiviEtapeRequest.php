<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SuiviEtapeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'suivi_innovation_id' => ['required', 'exists:suivis_innovation,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'statut' => ['required', Rule::in(['a_faire', 'en_cours', 'terminee', 'bloquee'])],
            'date_echeance' => ['nullable', 'date'],
        ];
    }
}

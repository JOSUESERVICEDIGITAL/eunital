<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SuiviBlocageRequest extends FormRequest
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
            'niveau_criticite' => ['required', Rule::in(['faible', 'moyenne', 'haute', 'critique'])],
            'statut' => ['required', Rule::in(['ouvert', 'en_cours', 'resolu'])],
        ];
    }
}

<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InnovationJalonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_feuille_route_id' => ['required', 'exists:innovation_feuilles_routes,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date_prevue' => ['nullable', 'date'],
            'date_realisation' => ['nullable', 'date', 'after_or_equal:date_prevue'],
            'statut' => ['required', Rule::in(['a_faire', 'en_cours', 'realise', 'retarde', 'annule'])],
            'ordre_affichage' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

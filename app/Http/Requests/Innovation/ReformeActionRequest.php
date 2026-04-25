<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReformeActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reforme_interne_id' => ['required', 'exists:reformes_internes,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'responsable_id' => ['nullable', 'exists:users,id'],
            'date_debut' => ['nullable', 'date'],
            'date_echeance' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'statut' => ['required', Rule::in(['a_faire', 'en_cours', 'realisee', 'bloquee'])],
        ];
    }
}

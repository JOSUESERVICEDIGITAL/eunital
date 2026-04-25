<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComiteInnovationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string'],
            'description' => ['nullable', 'string'],

            'type_comite' => ['required', Rule::in(['strategique', 'technique', 'validation', 'suivi'])],
            'statut' => ['required', Rule::in(['actif', 'suspendu', 'archive'])],
        ];
    }
}

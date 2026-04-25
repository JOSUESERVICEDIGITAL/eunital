<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComiteDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comite_session_id' => ['required', 'exists:comite_sessions,id'],
            'titre' => ['required', 'string', 'max:255'],
            'decision' => ['required', 'string'],
            'statut' => ['required', Rule::in(['adoptee', 'rejetee', 'ajournee'])],
        ];
    }
}

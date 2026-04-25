<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ReformeDecisionRequest extends FormRequest
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
            'decision' => ['required', 'string'],
            'date_decision' => ['nullable', 'date'],
            'prise_par' => ['nullable', 'exists:users,id'],
        ];
    }
}

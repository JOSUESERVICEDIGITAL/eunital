<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReformeRisqueRequest extends FormRequest
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
            'niveau' => ['required', Rule::in(['faible', 'moyen', 'eleve', 'critique'])],
            'mesure_mitigation' => ['nullable', 'string'],
        ];
    }
}

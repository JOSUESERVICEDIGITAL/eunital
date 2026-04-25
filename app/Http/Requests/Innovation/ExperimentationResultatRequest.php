<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ExperimentationResultatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'experimentation_id' => ['required', 'exists:experimentations,id'],
            'indicateur' => ['required', 'string', 'max:255'],
            'unite' => ['nullable', 'string', 'max:100'],
            'valeur_reference' => ['nullable', 'numeric'],
            'valeur_obtenue' => ['nullable', 'numeric'],
            'observation' => ['nullable', 'string'],
        ];
    }
}

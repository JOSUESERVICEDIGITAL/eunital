<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExperimentationDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'experimentation_id' => ['required', 'exists:experimentations,id'],
            'decision' => ['required', Rule::in(['deployer', 'ajuster', 'abandonner', 'prolonger'])],
            'motif' => ['nullable', 'string'],
            'date_decision' => ['nullable', 'date'],
            'prise_par' => ['nullable', 'exists:users,id'],
        ];
    }
}

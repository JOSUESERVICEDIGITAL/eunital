<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ComiteReferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comite_session_id' => ['required', 'exists:comite_sessions,id'],
            'reference_type' => ['required', 'string', 'max:255'],
            'reference_id' => ['required', 'integer'],
            'objet' => ['nullable', 'string', 'max:255'],
            'observation' => ['nullable', 'string'],
        ];
    }
}

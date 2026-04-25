<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ComiteSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comite_innovation_id' => ['required', 'exists:comites_innovation,id'],
            'titre' => ['required', 'string', 'max:255'],
            'date_session' => ['nullable', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'ordre_du_jour' => ['nullable', 'string'],
        ];
    }
}

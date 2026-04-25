<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class ComiteParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comite_session_id' => ['required', 'exists:comite_sessions,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'nom' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'present' => ['boolean'],
        ];
    }
}

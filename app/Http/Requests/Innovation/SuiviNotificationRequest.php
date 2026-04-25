<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class SuiviNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'suivi_innovation_id' => ['required', 'exists:suivis_innovation,id'],
            'destinataire_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'lu' => ['boolean'],
        ];
    }
}

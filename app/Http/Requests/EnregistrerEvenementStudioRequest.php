<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerEvenementStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'client_studio_id' => ['nullable', 'exists:clients_studio,id'],
            'type' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:planifie,realise,annule'],
        ];
    }
}
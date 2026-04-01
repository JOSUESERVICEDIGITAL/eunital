<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerClientStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'adresse' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du client est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.email' => 'L’adresse email est invalide.',
            'email.max' => 'L’email ne doit pas dépasser 255 caractères.',
            'telephone.max' => 'Le téléphone ne doit pas dépasser 50 caractères.',
            'type.max' => 'Le type ne doit pas dépasser 100 caractères.',
        ];
    }
}
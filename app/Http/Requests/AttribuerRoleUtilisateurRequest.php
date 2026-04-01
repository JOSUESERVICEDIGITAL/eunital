<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttribuerRoleUtilisateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'roles.required' => 'Vous devez sélectionner au moins un rôle.',
            'roles.array' => 'Le format des rôles est invalide.',
            'roles.min' => 'Vous devez sélectionner au moins un rôle.',
            'roles.*.exists' => 'Un des rôles sélectionnés est invalide.',
        ];
    }
}
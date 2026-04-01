<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttribuerPermissionsRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['exists:permissions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.required' => 'Vous devez sélectionner au moins une permission.',
            'permissions.array' => 'Le format des permissions est invalide.',
            'permissions.min' => 'Vous devez sélectionner au moins une permission.',
            'permissions.*.exists' => 'Une des permissions sélectionnées est invalide.',
        ];
    }
}
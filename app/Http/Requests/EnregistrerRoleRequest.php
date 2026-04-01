<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255', 'unique:roles,nom'],
            'description' => ['nullable', 'string', 'max:2000'],
            'est_actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du rôle est obligatoire.',
            'nom.unique' => 'Ce nom de rôle existe déjà.',
        ];
    }
}
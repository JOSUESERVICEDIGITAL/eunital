<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $role = $this->route('role');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'nom')->ignore($role?->id),
            ],
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
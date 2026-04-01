<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifierPermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $permission = $this->route('permission');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'nom')->ignore($permission?->id),
            ],
            'groupe' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la permission est obligatoire.',
            'nom.unique' => 'Cette permission existe déjà.',
        ];
    }
}
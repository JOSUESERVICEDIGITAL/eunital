<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ModifierUtilisateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $utilisateur = $this->route('utilisateur');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($utilisateur?->id),
            ],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'telephone' => ['nullable', 'string', 'max:30'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'statut_compte' => ['required', 'in:actif,inactif,suspendu'],
            'est_actif' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre utilisateur.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'statut_compte.required' => 'Le statut du compte est obligatoire.',
            'statut_compte.in' => 'Le statut du compte sélectionné est invalide.',
            'roles.*.exists' => 'Un des rôles sélectionnés est invalide.',
        ];
    }
}
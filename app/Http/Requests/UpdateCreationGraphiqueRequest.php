<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreationGraphiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:logo,affiche,reseaux,uiux,branding,autre'],
            'statut' => ['required', 'in:brouillon,en_cours,validation,livre,archive'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
            'projet_studio_id' => ['nullable', 'exists:projet_studios,id'],
            'auteur_id' => ['nullable', 'exists:users,id'],
        ];
    }
}

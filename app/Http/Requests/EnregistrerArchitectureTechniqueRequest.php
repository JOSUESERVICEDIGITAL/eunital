<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerArchitectureTechniqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:8000'],
            'composants' => ['nullable', 'string', 'max:20000'],
            'technologies_recommandees' => ['nullable', 'string', 'max:15000'],
            'contraintes_techniques' => ['nullable', 'string', 'max:15000'],
            'diagramme' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'version' => ['nullable', 'string', 'max:50'],
            'statut' => ['required', 'in:brouillon,validee,obsolete'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre de l’architecture technique est obligatoire.',
            'diagramme.image' => 'Le diagramme doit être une image.',
            'diagramme.mimes' => 'Le diagramme doit être au format jpg, jpeg, png, webp ou svg.',
            'diagramme.max' => 'Le diagramme ne doit pas dépasser 4 Mo.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
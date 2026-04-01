<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerMembreEquipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'departement_id' => ['nullable', 'exists:departements,id'],
            'poste_id' => ['nullable', 'exists:postes,id'],
            'responsable_id' => ['nullable', 'exists:membres_equipe,id'],

            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
            'email_professionnel' => ['nullable', 'email', 'max:255', 'unique:membres_equipe,email_professionnel'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:4000'],

            'date_integration' => ['nullable', 'date'],
            'statut' => ['required', 'in:actif,inactif,en_pause'],
            'ordre_organigramme' => ['nullable', 'integer', 'min:0'],
            'est_visible_organigramme' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du membre est obligatoire.',
            'email_professionnel.email' => 'L’e-mail professionnel doit être valide.',
            'email_professionnel.unique' => 'Cet e-mail professionnel est déjà utilisé.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
            'poste_id.exists' => 'Le poste sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'La photo doit être au format jpg, jpeg, png ou webp.',
            'statut.required' => 'Le statut du membre est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}

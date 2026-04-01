<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierCampagneMarketingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'responsable_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'reseau' => ['required', 'in:facebook,instagram,tiktok,google,linkedin,youtube,multi_reseaux,autre'],
            'objectif' => ['nullable', 'string', 'max:255'],
            'audience' => ['nullable', 'string', 'max:255'],
            'budget' => ['required', 'numeric', 'min:0'],
            'budget_consomme' => ['nullable', 'numeric', 'min:0'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'statut' => ['required', 'in:brouillon,active,en_pause,terminee,archivee'],
            'est_active' => ['nullable', 'boolean'],
            'taux_conversion' => ['nullable', 'numeric', 'min:0'],
            'cout_par_resultat' => ['nullable', 'numeric', 'min:0'],
            'lien_annonce' => ['nullable', 'url', 'max:2000'],
            'visuel' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
            'titre.required' => 'Le titre de la campagne est obligatoire.',
            'reseau.required' => 'Le réseau de diffusion est obligatoire.',
            'reseau.in' => 'Le réseau sélectionné est invalide.',
            'budget.required' => 'Le budget est obligatoire.',
            'budget.numeric' => 'Le budget doit être un nombre.',
            'budget.min' => 'Le budget ne peut pas être négatif.',
            'budget_consomme.numeric' => 'Le budget consommé doit être un nombre.',
            'budget_consomme.min' => 'Le budget consommé ne peut pas être négatif.',
            'date_debut.date' => 'La date de début est invalide.',
            'date_fin.date' => 'La date de fin est invalide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
            'lien_annonce.url' => 'Le lien de l’annonce doit être valide.',
        ];
    }
}

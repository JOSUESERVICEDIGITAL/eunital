<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerTableauPerformanceMarketingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'campagne_marketing_id' => ['nullable', 'exists:campagnes_marketing,id'],
            'titre' => ['required', 'string', 'max:255'],
            'impressions' => ['nullable', 'integer', 'min:0'],
            'clics' => ['nullable', 'integer', 'min:0'],
            'conversions' => ['nullable', 'integer', 'min:0'],
            'leads' => ['nullable', 'integer', 'min:0'],
            'ventes' => ['nullable', 'integer', 'min:0'],
            'ctr' => ['nullable', 'numeric', 'min:0'],
            'cpc' => ['nullable', 'numeric', 'min:0'],
            'cpm' => ['nullable', 'numeric', 'min:0'],
            'roas' => ['nullable', 'numeric', 'min:0'],
            'cout_total' => ['nullable', 'numeric', 'min:0'],
            'revenu_genere' => ['nullable', 'numeric', 'min:0'],
            'periode_debut' => ['nullable', 'date'],
            'periode_fin' => ['nullable', 'date', 'after_or_equal:periode_debut'],
            'statut' => ['required', 'in:brouillon,publie,archive'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'campagne_marketing_id.exists' => 'La campagne sélectionnée est invalide.',
            'titre.required' => 'Le titre du tableau de performance est obligatoire.',
            'impressions.integer' => 'Le nombre d’impressions doit être un entier.',
            'clics.integer' => 'Le nombre de clics doit être un entier.',
            'conversions.integer' => 'Le nombre de conversions doit être un entier.',
            'leads.integer' => 'Le nombre de leads doit être un entier.',
            'ventes.integer' => 'Le nombre de ventes doit être un entier.',
            'ctr.numeric' => 'Le CTR doit être un nombre.',
            'cpc.numeric' => 'Le CPC doit être un nombre.',
            'cpm.numeric' => 'Le CPM doit être un nombre.',
            'roas.numeric' => 'Le ROAS doit être un nombre.',
            'cout_total.numeric' => 'Le coût total doit être un nombre.',
            'revenu_genere.numeric' => 'Le revenu généré doit être un nombre.',
            'periode_debut.date' => 'La période de début est invalide.',
            'periode_fin.date' => 'La période de fin est invalide.',
            'periode_fin.after_or_equal' => 'La période de fin doit être postérieure ou égale à la période de début.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}

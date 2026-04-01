<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class PolitiqueConfidentialiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $politiqueId = $this->route('politique_confidentialite') ? $this->route('politique_confidentialite')->id : null;

        return [
            'titre' => 'required|string|max:255',
            'version' => 'required|string|max:20',
            'contenu' => 'required|string',
            'donnees_collectees' => 'nullable|array',
            'finalites_traitement' => 'nullable|array',
            'droits_utilisateurs' => 'nullable|array',
            'sous_traitants' => 'nullable|array',
            'transferts_hors_ue' => 'nullable|array',
            'duree_conservation' => 'nullable|integer|min:1',
            'date_effet' => 'required|date',
            'date_fin' => 'nullable|date|after:date_effet',
            'is_active' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est requis.',
            'version.required' => 'La version est requise.',
            'contenu.required' => 'Le contenu est requis.',
            'date_effet.required' => 'La date d\'effet est requise.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date d\'effet.',
            'duree_conservation.min' => 'La durée de conservation doit être d\'au moins 1 jour.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier qu'il n'y a pas de version active en conflit
            if ($this->is_active) {
                $activeExists = \App\Models\Juridique\PolitiqueConfidentialite::where('is_active', true)
                    ->where('id', '!=', $this->route('politique_confidentialite') ? $this->route('politique_confidentialite')->id : null)
                    ->exists();

                if ($activeExists) {
                    $validator->errors()->add(
                        'is_active',
                        'Il existe déjà une version active de la politique de confidentialité.'
                    );
                }
            }
        });
    }
}

<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DemarcheRgpdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'type' => ['required', Rule::in([
                'registre_traitement', 'analyse_impact', 'consentement',
                'notification_violation', 'demande_droit', 'information'
            ])],
            'description' => 'required|string',
            'donnees_concernees' => 'nullable|array',
            'responsables' => 'nullable|array',
            'sous_traitants' => 'nullable|array',
            'mesures_securite' => 'nullable|array',
            'date_realisation' => 'nullable|date',
            'date_limite' => 'nullable|date|after_or_equal:date_realisation',
            'statut' => ['nullable', Rule::in(['en_cours', 'realise', 'non_conforme', 'depasse'])],
            'documents_associes' => 'nullable|array',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la démarche est requis.',
            'type.required' => 'Le type de démarche est requis.',
            'type.in' => 'Le type sélectionné n\'est pas valide.',
            'description.required' => 'La description est requise.',
            'date_limite.after_or_equal' => 'La date limite doit être postérieure ou égale à la date de réalisation.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('statut')) {
            $this->merge(['statut' => 'en_cours']);
        }

        // Si la date limite est dépassée, mettre à jour le statut
        if ($this->date_limite && \Carbon\Carbon::parse($this->date_limite)->isPast() && $this->statut !== 'realise') {
            $this->merge(['statut' => 'depasse']);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Si la démarche est réalisée, la date de réalisation est obligatoire
            if ($this->statut === 'realise' && !$this->date_realisation) {
                $validator->errors()->add(
                    'date_realisation',
                    'La date de réalisation est obligatoire pour une démarche réalisée.'
                );
            }
        });
    }
}

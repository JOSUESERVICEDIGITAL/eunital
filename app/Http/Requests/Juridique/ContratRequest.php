<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => 'required|exists:documents,id|unique:contrats,document_id,' . ($this->route('contrat') ? $this->route('contrat')->id : null),
            'reference' => 'nullable|string|max:100|unique:contrats,reference,' . ($this->route('contrat') ? $this->route('contrat')->id : null),
            'type_contrat' => ['required', Rule::in([
                'cdi', 'cdd', 'freelance', 'prestation', 'partenariat',
                'location', 'vente', 'licence', 'niveau_service', 'confidentialite'
            ])],
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'montant' => 'nullable|numeric|min:0',
            'devise' => 'nullable|string|size:3',
            'conditions' => 'nullable|array',
            'clauses' => 'nullable|array',
            'penalites' => 'nullable|array',
            'duree_preavis' => 'nullable|integer|min:0',
            'renouvellement_auto' => 'nullable|boolean',
            'duree_renouvellement' => 'nullable|integer|min:1',
            'objet' => 'nullable|string',
            'parties' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.required' => 'Le document est requis.',
            'document_id.exists' => 'Le document sélectionné n\'existe pas.',
            'document_id.unique' => 'Ce document a déjà un contrat associé.',
            'type_contrat.required' => 'Le type de contrat est requis.',
            'type_contrat.in' => 'Le type de contrat sélectionné n\'est pas valide.',
            'date_debut.required' => 'La date de début est requise.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'montant.min' => 'Le montant doit être positif.',
            'devise.size' => 'La devise doit comporter 3 caractères.',
            'duree_preavis.min' => 'La durée de préavis doit être positive.',
            'duree_renouvellement.min' => 'La durée de renouvellement doit être d\'au moins 1 jour.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('devise')) {
            $this->merge(['devise' => 'EUR']);
        }

        if (!$this->has('renouvellement_auto')) {
            $this->merge(['renouvellement_auto' => false]);
        }

        // Générer une référence si non fournie
        if (!$this->has('reference')) {
            $prefix = strtoupper(substr($this->type_contrat, 0, 3));
            $year = date('Y');
            $random = strtoupper(substr(uniqid(), -6));
            $this->merge(['reference' => "{$prefix}-{$year}-{$random}"]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que le document associé est bien un contrat
            if ($this->document_id) {
                $document = \App\Models\Juridique\Document::find($this->document_id);
                if ($document && $document->typeDocument &&
                    !in_array($document->typeDocument->categorie, ['contrat', 'commercial'])) {
                    $validator->errors()->add(
                        'document_id',
                        'Le document sélectionné n\'est pas de type contrat.'
                    );
                }
            }
        });
    }
}

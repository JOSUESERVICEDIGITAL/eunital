<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type_document_id' => 'required|exists:types_documents,id',
            'modele_document_id' => 'nullable|exists:modeles_documents,id',
            'statut' => ['nullable', Rule::in([
                'brouillon', 'en_attente', 'signature_attendue',
                'signe', 'valide', 'expire', 'annule', 'archive'
            ])],
            'contenu' => 'nullable|array',
            'metadatas' => 'nullable|array',
            'variables_utilisees' => 'nullable|array',
            'fichier' => 'nullable|file|mimes:pdf|max:10240',
            'version' => 'nullable|integer|min:1',
            'date_effet' => 'nullable|date',
            'date_expiration' => 'nullable|date|after_or_equal:date_effet',
            'date_signature' => 'nullable|date',
            'utilisateurs' => 'nullable|array',
            'utilisateurs.*.id' => 'exists:users,id',
            'utilisateurs.*.role' => 'required|in:destinataire,expediteur,signataire,temoin',
            'entreprises' => 'nullable|array',
            'entreprises.*.id' => 'exists:entreprises,id',
            'entreprises.*.role' => 'required|in:partie,tiers,representant'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du document est requis.',
            'type_document_id.required' => 'Le type de document est requis.',
            'type_document_id.exists' => 'Le type de document sélectionné n\'existe pas.',
            'fichier.mimes' => 'Le fichier doit être au format PDF.',
            'fichier.max' => 'Le fichier ne doit pas dépasser 10 Mo.',
            'date_expiration.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'effet.',
            'utilisateurs.*.role.required' => 'Le rôle de l\'utilisateur est requis.',
            'utilisateurs.*.role.in' => 'Le rôle doit être: destinataire, expediteur, signataire ou temoin.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('statut')) {
            $this->merge(['statut' => 'brouillon']);
        }

        if (!$this->has('version')) {
            $this->merge(['version' => 1]);
        }

        if ($this->has('fichier') && !$this->has('fichier_path')) {
            // Le fichier_path sera géré dans le contrôleur
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que le type de document nécessite une signature si statut = signe
            if ($this->statut === 'signe' && $this->type_document_id) {
                $typeDocument = \App\Models\Juridique\TypeDocument::find($this->type_document_id);
                if ($typeDocument && $typeDocument->necessite_signature && !$this->date_signature) {
                    $validator->errors()->add(
                        'date_signature',
                        'Ce type de document nécessite une date de signature.'
                    );
                }
            }
        });
    }
}

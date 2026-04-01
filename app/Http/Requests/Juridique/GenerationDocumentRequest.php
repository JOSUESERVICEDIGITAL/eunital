<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;

class GenerationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'modele_document_id' => 'required|exists:modeles_documents,id',
            'type_document_id' => 'required|exists:types_documents,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'variables' => 'nullable|array',
            'date_effet' => 'nullable|date',
            'date_expiration' => 'nullable|date|after_or_equal:date_effet',
            'utilisateurs' => 'nullable|array',
            'utilisateurs.*.id' => 'required|exists:users,id',
            'utilisateurs.*.role' => 'required|in:destinataire,expediteur,signataire,temoin',
            'entreprises' => 'nullable|array',
            'entreprises.*.id' => 'required|exists:entreprises,id',
            'entreprises.*.role' => 'required|in:partie,tiers,representant',
            'format' => 'nullable|in:html,pdf,both'
        ];
    }

    public function messages(): array
    {
        return [
            'modele_document_id.required' => 'Le modèle de document est requis.',
            'modele_document_id.exists' => 'Le modèle sélectionné n\'existe pas.',
            'type_document_id.required' => 'Le type de document est requis.',
            'type_document_id.exists' => 'Le type sélectionné n\'existe pas.',
            'titre.required' => 'Le titre du document est requis.',
            'date_expiration.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'effet.',
            'utilisateurs.*.id.required' => 'L\'identifiant de l\'utilisateur est requis.',
            'utilisateurs.*.id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'utilisateurs.*.role.required' => 'Le rôle de l\'utilisateur est requis.',
            'format.in' => 'Le format doit être html, pdf ou both.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('format')) {
            $this->merge(['format' => 'both']);
        }

        // Vérifier les variables obligatoires du modèle
        if ($this->modele_document_id) {
            $modele = \App\Models\Juridique\ModeleDocument::find($this->modele_document_id);
            if ($modele && $modele->champs_requis) {
                $missing = [];
                foreach ($modele->champs_requis as $champ) {
                    if (!isset($this->variables[$champ])) {
                        $missing[] = $champ;
                    }
                }
                if (!empty($missing)) {
                    session()->flash('missing_variables', $missing);
                }
            }
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que toutes les variables requises sont fournies
            if ($this->modele_document_id) {
                $modele = \App\Models\Juridique\ModeleDocument::find($this->modele_document_id);
                if ($modele && $modele->champs_requis) {
                    foreach ($modele->champs_requis as $champ) {
                        if (!isset($this->variables[$champ]) || empty($this->variables[$champ])) {
                            $validator->errors()->add(
                                "variables.{$champ}",
                                "La variable '{$champ}' est requise pour ce modèle."
                            );
                        }
                    }
                }
            }
        });
    }
}

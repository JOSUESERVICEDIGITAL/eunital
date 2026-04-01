<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConformiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'legalite_id' => 'required|exists:legalites,id',
            'entreprise_id' => 'nullable|exists:entreprises,id',
            'statut' => ['required', Rule::in(['conforme', 'non_conforme', 'partiellement_conforme', 'en_cours'])],
            'evaluations' => 'nullable|array',
            'actions_correctives' => 'nullable|array',
            'preuves' => 'nullable|array',
            'date_controle' => 'nullable|date',
            'date_prochaine_evaluation' => 'nullable|date|after_or_equal:date_controle',
            'commentaires' => 'nullable|string',
            'score_conformite' => 'nullable|numeric|min:0|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'legalite_id.required' => 'Le texte légal est requis.',
            'legalite_id.exists' => 'Le texte légal sélectionné n\'existe pas.',
            'statut.required' => 'Le statut de conformité est requis.',
            'statut.in' => 'Le statut doit être: conforme, non_conforme, partiellement_conforme ou en_cours.',
            'date_prochaine_evaluation.after_or_equal' => 'La date de la prochaine évaluation doit être postérieure ou égale à la date du contrôle.',
            'score_conformite.min' => 'Le score de conformité doit être compris entre 0 et 100.',
            'score_conformite.max' => 'Le score de conformité doit être compris entre 0 et 100.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('statut')) {
            $this->merge(['statut' => 'en_cours']);
        }

        if ($this->has('date_controle') && !$this->has('date_prochaine_evaluation')) {
            $this->merge([
                'date_prochaine_evaluation' => \Carbon\Carbon::parse($this->date_controle)->addYear()
            ]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que le score correspond au statut
            if ($this->score_conformite && $this->statut) {
                if ($this->statut === 'conforme' && $this->score_conformite < 80) {
                    $validator->errors()->add(
                        'score_conformite',
                        'Pour être conforme, le score doit être d\'au moins 80%.'
                    );
                }
                if ($this->statut === 'non_conforme' && $this->score_conformite > 50) {
                    $validator->errors()->add(
                        'score_conformite',
                        'Pour être non conforme, le score doit être inférieur à 50%.'
                    );
                }
            }
        });
    }
}

<?php

namespace App\Http\Requests\Juridique;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArchiveJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $archiveId = $this->route('archive_juridique') ? $this->route('archive_juridique')->id : null;

        return [
            'reference' => 'nullable|string|max:100|unique:archives_juridiques,reference,' . $archiveId,
            'titre' => 'required|string|max:255',
            'type' => ['required', Rule::in(['document', 'contrat', 'litige', 'demarche', 'legalite'])],
            'item_id' => 'required|integer',
            'item_type' => 'required|string',
            'contenu_archive' => 'required|array',
            'metadatas' => 'nullable|array',
            'date_archivage' => 'required|date',
            'date_conservation_jusqu' => 'nullable|date|after:date_archivage',
            'statut_conservation' => ['nullable', Rule::in(['actif', 'a_detruire', 'detruit'])],
            'motif' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de l\'archive est requis.',
            'type.required' => 'Le type d\'archive est requis.',
            'type.in' => 'Le type d\'archive doit être: document, contrat, litige, demarche ou legalite.',
            'item_id.required' => 'L\'identifiant de l\'élément est requis.',
            'item_type.required' => 'Le type de l\'élément est requis.',
            'contenu_archive.required' => 'Le contenu archivé est requis.',
            'date_archivage.required' => 'La date d\'archivage est requise.',
            'date_conservation_jusqu.after' => 'La date de conservation doit être postérieure à la date d\'archivage.'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('reference')) {
            $prefix = strtoupper(substr($this->type, 0, 3));
            $year = date('Y');
            $random = strtoupper(substr(uniqid(), -6));
            $this->merge(['reference' => "{$prefix}-{$year}-{$random}"]);
        }

        if (!$this->has('date_archivage')) {
            $this->merge(['date_archivage' => now()]);
        }

        if (!$this->has('statut_conservation')) {
            $this->merge(['statut_conservation' => 'actif']);
        }

        // Durée de conservation par défaut: 10 ans
        if (!$this->has('date_conservation_jusqu')) {
            $this->merge([
                'date_conservation_jusqu' => now()->addYears(10)
            ]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que l'élément à archiver existe
            if ($this->item_type && $this->item_id) {
                $model = "App\\Models\\Juridique\\" . ucfirst($this->item_type);
                if (class_exists($model)) {
                    $item = $model::find($this->item_id);
                    if (!$item) {
                        $validator->errors()->add(
                            'item_id',
                            "L'élément de type {$this->item_type} avec l'ID {$this->item_id} n'existe pas."
                        );
                    }
                }
            }
        });
    }
}

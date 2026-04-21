<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DossierPersonnelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $documents = $this->input('documents');

        if (is_string($documents)) {
            $decoded = json_decode($documents, true);
            $documents = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $this->merge([
            'matricule' => $this->filled('matricule') ? strtoupper(trim((string) $this->input('matricule'))) : null,
            'numero_cnss' => $this->filled('numero_cnss') ? trim((string) $this->input('numero_cnss')) : null,
            'numero_piece_identite' => $this->filled('numero_piece_identite') ? trim((string) $this->input('numero_piece_identite')) : null,
            'adresse' => $this->filled('adresse') ? trim((string) $this->input('adresse')) : null,
            'notes' => $this->filled('notes') ? trim((string) $this->input('notes')) : null,
            'documents' => $documents,
        ]);
    }

    public function rules(): array
    {
        $id = $this->route('dossier_personnel')?->id ?? $this->route('dossier_personnel');

        return [
            'membre_equipe_id' => ['required', 'exists:membres_equipe,id'],
            'matricule' => ['required', 'string', 'max:255', Rule::unique('dossiers_personnel', 'matricule')->ignore($id)],

            'numero_cnss' => ['nullable', 'string', 'max:255'],
            'numero_piece_identite' => ['nullable', 'string', 'max:255'],
            'adresse' => ['nullable', 'string', 'max:255'],

            'date_naissance' => ['nullable', 'date'],
            'date_embauche' => ['nullable', 'date'],

            'salaire_base' => ['nullable', 'numeric', 'min:0'],

            'statut_professionnel' => ['nullable', Rule::in(['en_poste', 'suspendu', 'demission', 'licencie', 'archive'])],

            'documents' => ['nullable', 'array'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'membre_equipe_id.required' => 'Le membre de l’équipe est obligatoire.',
            'membre_equipe_id.exists' => 'Le membre sélectionné est invalide.',
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule existe déjà.',
            'salaire_base.numeric' => 'Le salaire de base doit être un nombre.',
            'salaire_base.min' => 'Le salaire de base ne peut pas être négatif.',
            'statut_professionnel.in' => 'Le statut professionnel est invalide.',
            'documents.array' => 'Le champ documents doit être un tableau valide.',
        ];
    }
}
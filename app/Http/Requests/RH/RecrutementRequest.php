<?php

namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RecrutementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $titre = trim((string) $this->input('titre', ''));
        $slug = trim((string) $this->input('slug', ''));

        $this->merge([
            'titre' => $titre,
            'slug' => $slug !== '' ? Str::slug($slug) : ($titre !== '' ? Str::slug($titre) : null),
            'description' => $this->filled('description') ? trim((string) $this->input('description')) : null,
        ]);
    }

    public function rules(): array
    {
        $id = $this->route('recrutement')?->id ?? $this->route('recrutement');

        return [
            'departement_id' => ['nullable', 'exists:departements,id'],
            'poste_id' => ['nullable', 'exists:postes,id'],
            'responsable_id' => ['nullable', 'exists:users,id'],

            'titre' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('recrutements', 'slug')->ignore($id)],
            'description' => ['nullable', 'string'],

            'type_contrat' => ['required', Rule::in(['cdi', 'cdd', 'stage', 'freelance', 'consultance', 'autre'])],
            'statut' => ['nullable', Rule::in(['brouillon', 'ouvert', 'en_cours', 'ferme', 'archive'])],

            'date_ouverture' => ['nullable', 'date'],
            'date_cloture' => ['nullable', 'date', 'after_or_equal:date_ouverture'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du recrutement est obligatoire.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug existe déjà.',
            'type_contrat.required' => 'Le type de contrat est obligatoire.',
            'type_contrat.in' => 'Le type de contrat est invalide.',
            'statut.in' => 'Le statut est invalide.',
            'date_cloture.after_or_equal' => 'La date de clôture doit être après ou égale à la date d’ouverture.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
            'poste_id.exists' => 'Le poste sélectionné est invalide.',
            'responsable_id.exists' => 'Le responsable sélectionné est invalide.',
        ];
    }
}
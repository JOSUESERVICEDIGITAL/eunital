<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierImageMarqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'nom_marque' => ['required', 'string', 'max:255'],
            'slogan' => ['nullable', 'string', 'max:255'],
            'ton_marque' => ['nullable', 'string', 'max:255'],
            'identite_visuelle' => ['nullable', 'string', 'max:10000'],
            'palette_couleurs' => ['nullable', 'string', 'max:10000'],
            'elements_langage' => ['nullable', 'string', 'max:10000'],
            'ligne_editoriale' => ['nullable', 'string', 'max:10000'],
            'logo' => ['nullable', 'string', 'max:255'],
            'charte_graphique' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:brouillon,active,obsolete,archivee'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'nom_marque.required' => 'Le nom de marque est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}

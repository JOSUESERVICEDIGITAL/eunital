<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'resume' => ['nullable', 'string', 'max:1000'],
            'contenu' => ['required', 'string'],
            'categorie_id' => ['nullable', 'exists:categories,id'],
            'image_principale' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'statut' => ['required', 'in:brouillon,publie,archive'],
            'commentaires_actives' => ['nullable', 'boolean'],
            'date_publication' => ['nullable', 'date'],
            'etiquettes' => ['nullable', 'array'],
            'etiquettes.*' => ['exists:etiquettes,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categorie_media_id' => ['nullable', 'exists:categories_medias,id'],
            'user_id' => ['nullable', 'exists:users,id'],

            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],

            'fichier' => ['nullable', 'file', 'max:20480'],
            'miniature' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'type_media' => ['required', 'in:image,video,document,audio,lien'],
            'url_externe' => ['nullable', 'url', 'max:2000'],
            'alt_text' => ['nullable', 'string', 'max:255'],

            'est_public' => ['nullable', 'boolean'],
            'est_en_avant' => ['nullable', 'boolean'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $typeMedia = $this->input('type_media');
            $fichier = $this->file('fichier');
            $urlExterne = $this->input('url_externe');

            if (!$fichier && !$urlExterne) {
                $validator->errors()->add('fichier', 'Vous devez ajouter un fichier ou un lien externe.');
            }

            if ($typeMedia === 'lien' && empty($urlExterne)) {
                $validator->errors()->add('url_externe', 'Un lien externe est obligatoire pour un média de type lien.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'categorie_media_id.exists' => 'La catégorie média sélectionnée est invalide.',
            'user_id.exists' => 'L’utilisateur sélectionné est invalide.',
            'titre.required' => 'Le titre du média est obligatoire.',
            'fichier.file' => 'Le champ fichier doit contenir un fichier valide.',
            'fichier.max' => 'Le fichier ne doit pas dépasser 20 Mo.',
            'miniature.image' => 'La miniature doit être une image.',
            'miniature.mimes' => 'La miniature doit être au format jpg, jpeg, png ou webp.',
            'miniature.max' => 'La miniature ne doit pas dépasser 4 Mo.',
            'type_media.required' => 'Le type de média est obligatoire.',
            'type_media.in' => 'Le type de média sélectionné est invalide.',
            'url_externe.url' => 'Le lien externe doit être une URL valide.',
        ];
    }
}
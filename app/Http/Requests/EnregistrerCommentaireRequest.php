<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerCommentaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_id' => ['required', 'exists:articles,id'],
            'nom' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'contenu' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:commentaires,id'],
        ];
    }
}

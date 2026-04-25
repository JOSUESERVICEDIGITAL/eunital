<?php

namespace App\Http\Requests\Innovation;

use Illuminate\Foundation\Http\FormRequest;

class InnovationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'innovation_id' => ['required', 'exists:innovations,id'],
            'titre' => ['required', 'string', 'max:255'],
            'type_document' => ['nullable', 'string', 'max:100'],
            'fichier' => ['required', 'string', 'max:255'],
            'uploaded_by' => ['nullable', 'exists:users,id'],
        ];
    }
}

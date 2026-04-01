<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdentiteVisuelleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'string', 'max:255'],
            'palette_couleurs' => ['nullable', 'string', 'max:255'],
            'typographie' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:creation,validation,termine'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
        ];
    }
}

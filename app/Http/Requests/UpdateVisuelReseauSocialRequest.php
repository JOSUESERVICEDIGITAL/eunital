<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisuelReseauSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'plateforme' => ['required', 'in:facebook,instagram,linkedin,tiktok,youtube'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:creation,programme,publie'],
            'date_publication' => ['nullable', 'date'],
            'client_studio_id' => ['nullable', 'exists:client_studios,id'],
        ];
    }
}

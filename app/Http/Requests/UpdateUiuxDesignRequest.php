<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUiuxDesignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:wireframe,maquette,prototype'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'statut' => ['required', 'in:conception,test,valide'],
            'projet_studio_id' => ['nullable', 'exists:projet_studios,id'],
        ];
    }
}

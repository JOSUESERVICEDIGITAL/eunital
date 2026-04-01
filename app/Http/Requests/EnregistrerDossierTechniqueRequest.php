<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnregistrerDossierTechniqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auteur_id' => ['nullable', 'exists:users,id'],
            'titre' => ['required', 'string', 'max:255'],
            'resume' => ['nullable', 'string', 'max:10000'],
            'document_principal' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt', 'max:20480'],
            'version' => ['nullable', 'string', 'max:50'],
            'type_dossier' => ['required', 'in:specification,documentation,procedure,manuel,analyse'],
            'statut' => ['required', 'in:brouillon,publie,archive'],
        ];
    }

    public function messages(): array
    {
        return [
            'auteur_id.exists' => 'L’auteur sélectionné est invalide.',
            'titre.required' => 'Le titre du dossier technique est obligatoire.',
            'document_principal.file' => 'Le document principal doit être un fichier valide.',
            'document_principal.mimes' => 'Le document principal doit être de type pdf, doc, docx, ppt, pptx, xls, xlsx ou txt.',
            'document_principal.max' => 'Le document principal ne doit pas dépasser 20 Mo.',
            'type_dossier.required' => 'Le type de dossier est obligatoire.',
            'type_dossier.in' => 'Le type de dossier sélectionné est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
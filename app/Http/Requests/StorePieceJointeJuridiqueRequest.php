<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePieceJointeJuridiqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'fichier' => 'required|file|max:5000',

            'type_piece' => 'required|string',

            'contrat_juridique_id' => 'nullable|exists:contrats_juridiques,id',
            'engagement_juridique_id' => 'nullable|exists:engagements_juridiques,id',
            'dossier_juridique_id' => 'nullable|exists:dossiers_juridiques,id',
            'archive_hub_id' => 'nullable|exists:archives_hub,id',
        ];
    }
}

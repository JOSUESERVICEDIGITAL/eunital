<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeleDocumentJuridique extends Model
{
    protected $table = 'modeles_documents_juridiques';

    protected $fillable = [
        'nom',
        'type_document',
        'contenu',
        'actif',
        'version',
        'auteur_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}
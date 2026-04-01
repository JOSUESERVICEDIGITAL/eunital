<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentJuridique extends Model
{
    protected $table = 'documents_juridiques';

    protected $fillable = [
        'titre',
        'categorie',
        'contenu',
        'fichier',
        'statut',
        'auteur_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}
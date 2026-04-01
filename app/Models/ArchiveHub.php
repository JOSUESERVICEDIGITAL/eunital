<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveHub extends Model
{
    protected $table = 'archives_hub';

    protected $fillable = [
        'titre',
        'categorie',
        'type_fichier',
        'fichier',
        'date_archive',
        'description',
        'visible',
        'auteur_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function piecesJointes()
    {
        return $this->hasMany(PieceJointeJuridique::class, 'archive_hub_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PieceJointeJuridique extends Model
{
    protected $table = 'pieces_jointes_juridiques';

    protected $fillable = [
        'titre',
        'fichier',
        'type_piece',
        'contrat_juridique_id',
        'engagement_juridique_id',
        'dossier_juridique_id',
        'archive_hub_id',
        'auteur_id',
    ];

    public function contrat()
    {
        return $this->belongsTo(ContratJuridique::class, 'contrat_juridique_id');
    }

    public function engagement()
    {
        return $this->belongsTo(EngagementJuridique::class, 'engagement_juridique_id');
    }

    public function dossier()
    {
        return $this->belongsTo(DossierJuridique::class, 'dossier_juridique_id');
    }

    public function archive()
    {
        return $this->belongsTo(ArchiveHub::class, 'archive_hub_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}
<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ArchiveJuridique extends Model
{
    protected $table = 'archives_juridiques';

    protected $fillable = [
        'reference',
        'titre',
        'type',
        'item_id',
        'item_type',
        'contenu_archive',
        'metadatas',
        'date_archivage',
        'date_conservation_jusqu',
        'statut_conservation',
        'motif',
        'archive_par'
    ];

    protected $casts = [
        'contenu_archive' => 'array',
        'metadatas' => 'array',
        'date_archivage' => 'date',
        'date_conservation_jusqu' => 'date'
    ];

    // Relations polymorphes
    public function item()
    {
        return $this->morphTo();
    }

    public function archiveur()
    {
        return $this->belongsTo(User::class, 'archive_par');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('statut_conservation', 'actif');
    }

    public function scopeADetruire($query)
    {
        return $query->where('statut_conservation', 'a_detruire');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'document' => 'Document',
            'contrat' => 'Contrat',
            'litige' => 'Litige',
            'demarche' => 'Démarche',
            'legalite' => 'Textes légaux'
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getStatutConservationLabelAttribute()
    {
        $labels = [
            'actif' => 'Actif',
            'a_detruire' => 'À détruire',
            'detruit' => 'Détruit'
        ];
        return $labels[$this->statut_conservation] ?? $this->statut_conservation;
    }

    // Méthodes
    public function marquerADetruire()
    {
        $this->update(['statut_conservation' => 'a_detruire']);
    }
}

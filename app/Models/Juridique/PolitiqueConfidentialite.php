<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PolitiqueConfidentialite extends Model
{
    protected $table = 'politique_confidentialite';

    protected $fillable = [
        'titre',
        'version',
        'contenu',
        'donnees_collectees',
        'finalites_traitement',
        'droits_utilisateurs',
        'sous_traitants',
        'transferts_hors_ue',
        'duree_conservation',
        'date_effet',
        'date_fin',
        'is_active',
        'cree_par'
    ];

    protected $casts = [
        'donnees_collectees' => 'array',
        'finalites_traitement' => 'array',
        'droits_utilisateurs' => 'array',
        'sous_traitants' => 'array',
        'transferts_hors_ue' => 'array',
        'duree_conservation' => 'integer',
        'date_effet' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean'
    ];

    // Relations
    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('is_active', true)
                     ->where('date_effet', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('date_fin')
                           ->orWhere('date_fin', '>=', now());
                     });
    }

    // Accesseurs
    public function getVersionCourteAttribute()
    {
        return 'v' . $this->version;
    }

    public function getDureeConservationFormateeAttribute()
    {
        if (!$this->duree_conservation) return 'Non définie';

        $jours = $this->duree_conservation;
        if ($jours >= 365) return floor($jours / 365) . ' an(s)';
        if ($jours >= 30) return floor($jours / 30) . ' mois';
        return $jours . ' jour(s)';
    }
}

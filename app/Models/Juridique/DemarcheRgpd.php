<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;

class DemarcheRgpd extends Model
{
    protected $table = 'demarches_rgpd';

    protected $fillable = [
        'titre',
        'type',
        'description',
        'donnees_concernees',
        'responsables',
        'sous_traitants',
        'mesures_securite',
        'date_realisation',
        'date_limite',
        'statut',
        'documents_associes',
        'observations'
    ];

    protected $casts = [
        'donnees_concernees' => 'array',
        'responsables' => 'array',
        'sous_traitants' => 'array',
        'mesures_securite' => 'array',
        'date_realisation' => 'date',
        'date_limite' => 'date',
        'documents_associes' => 'array'
    ];

    // Scopes
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeRealisees($query)
    {
        return $query->where('statut', 'realise');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'registre_traitement' => 'Registre des traitements',
            'analyse_impact' => 'Analyse d\'impact',
            'consentement' => 'Gestion des consentements',
            'notification_violation' => 'Notification de violation',
            'demande_droit' => 'Demande de droit',
            'information' => 'Information'
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getStatutLabelAttribute()
    {
        $labels = [
            'en_cours' => 'En cours',
            'realise' => 'Réalisé',
            'non_conforme' => 'Non conforme',
            'depasse' => 'Dépassé'
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_cours' => 'warning',
            'realise' => 'success',
            'non_conforme' => 'danger',
            'depasse' => 'secondary'
        ];
        return $badges[$this->statut] ?? 'secondary';
    }

    // Méthodes
    public function valider()
    {
        $this->update([
            'statut' => 'realise',
            'date_realisation' => now()
        ]);
    }
}

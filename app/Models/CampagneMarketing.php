<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampagneMarketing extends Model
{
    use HasFactory;

    protected $table = 'campagnes_marketing';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'description',
        'reseau',
        'objectif',
        'audience',
        'budget',
        'budget_consomme',
        'date_debut',
        'date_fin',
        'statut',
        'est_active',
        'taux_conversion',
        'cout_par_resultat',
        'lien_annonce',
        'visuel',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
            'budget_consomme' => 'decimal:2',
            'taux_conversion' => 'decimal:2',
            'cout_par_resultat' => 'decimal:2',
            'date_debut' => 'date',
            'date_fin' => 'date',
            'est_active' => 'boolean',
        ];
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function acquisitions()
    {
        return $this->hasMany(AcquisitionMarketing::class, 'campagne_marketing_id');
    }

    public function tableauxPerformance()
    {
        return $this->hasMany(TableauPerformanceMarketing::class, 'campagne_marketing_id');
    }

    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    public function estActive()
    {
        return $this->statut === 'active';
    }

    public function estEnPause()
    {
        return $this->statut === 'en_pause';
    }

    public function estTerminee()
    {
        return $this->statut === 'terminee';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }

    public function estMultiReseaux()
    {
        return $this->reseau === 'multi_reseaux';
    }

    public function budgetRestant()
    {
        return (float) $this->budget - (float) $this->budget_consomme;
    }
}

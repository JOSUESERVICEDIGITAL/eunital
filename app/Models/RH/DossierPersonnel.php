<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DossierPersonnel extends Model
{
    protected $table = 'dossiers_personnel';

    protected $guarded = [];

    protected $casts = [
        'date_naissance' => 'date',
        'date_embauche' => 'date',
        'salaire_base' => 'decimal:2',
        'documents' => 'array',
    ];

    public const STATUT_EN_POSTE = 'en_poste';
    public const STATUT_SUSPENDU = 'suspendu';
    public const STATUT_DEMISSION = 'demission';
    public const STATUT_LICENCIE = 'licencie';
    public const STATUT_ARCHIVE = 'archive';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function presences(): HasMany
    {
        return $this->hasMany(PresenceRh::class, 'membre_equipe_id', 'membre_equipe_id');
    }

    public function conges(): HasMany
    {
        return $this->hasMany(CongeRh::class, 'membre_equipe_id', 'membre_equipe_id');
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(EvaluationRh::class, 'membre_equipe_id', 'membre_equipe_id');
    }

    public function sanctions(): HasMany
    {
        return $this->hasMany(SanctionDisciplinaire::class, 'membre_equipe_id', 'membre_equipe_id');
    }

    public function signalementsBienEtre(): HasMany
    {
        return $this->hasMany(BienEtreTravail::class, 'membre_equipe_id', 'membre_equipe_id');
    }

    public function scopeActifs(Builder $query): Builder
    {
        return $query->where('statut_professionnel', self::STATUT_EN_POSTE);
    }

    public function estActif(): bool
    {
        return $this->statut_professionnel === self::STATUT_EN_POSTE;
    }
}
<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidature extends Model
{
    protected $table = 'candidatures';

    protected $guarded = [];

    protected $casts = [
        'date_candidature' => 'date',
    ];

    public const STATUT_RECU = 'recu';
    public const STATUT_EN_ETUDE = 'en_etude';
    public const STATUT_ENTRETIEN = 'entretien';
    public const STATUT_RETENU = 'retenu';
    public const STATUT_REJETE = 'rejete';

    public function recrutement(): BelongsTo
    {
        return $this->belongsTo(Recrutement::class);
    }

    public function scopeEnCours(Builder $query): Builder
    {
        return $query->whereIn('statut', [
            self::STATUT_RECU,
            self::STATUT_EN_ETUDE,
            self::STATUT_ENTRETIEN,
        ]);
    }

    public function scopeRetenues(Builder $query): Builder
    {
        return $query->where('statut', self::STATUT_RETENU);
    }

    public function estFinalisee(): bool
    {
        return in_array($this->statut, [self::STATUT_RETENU, self::STATUT_REJETE], true);
    }
}
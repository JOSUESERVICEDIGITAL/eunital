<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BienEtreTravail extends Model
{
    protected $table = 'bien_etre_travail';

    protected $guarded = [];

    public const OUVERT = 'ouvert';
    public const EN_COURS = 'en_cours';
    public const TRAITE = 'traite';
    public const ARCHIVE = 'archive';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function scopeOuverts(Builder $query): Builder
    {
        return $query->whereIn('statut', [self::OUVERT, self::EN_COURS]);
    }

    public function estTraite(): bool
    {
        return in_array($this->statut, [self::TRAITE, self::ARCHIVE], true);
    }
}
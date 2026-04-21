<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresenceRh extends Model
{
    protected $table = 'presences_rh';

    protected $guarded = [];

    protected $casts = [
        'date_presence' => 'date',
        'heure_arrivee' => 'datetime:H:i',
        'heure_depart' => 'datetime:H:i',
    ];

    public const PRESENT = 'present';
    public const ABSENT = 'absent';
    public const RETARD = 'retard';
    public const MISSION = 'mission';
    public const TELETRAVAIL = 'teletravail';
    public const CONGE = 'conge';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function scopeDuJour(Builder $query): Builder
    {
        return $query->whereDate('date_presence', now()->toDateString());
    }

    public function scopeAbsents(Builder $query): Builder
    {
        return $query->where('statut', self::ABSENT);
    }

    public function estPresentPhysiquement(): bool
    {
        return in_array($this->statut, [self::PRESENT, self::RETARD], true);
    }
}
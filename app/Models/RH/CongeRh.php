<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CongeRh extends Model
{
    protected $table = 'conges_rh';

    protected $guarded = [];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public const EN_ATTENTE = 'en_attente';
    public const VALIDE = 'valide';
    public const REFUSE = 'refuse';
    public const ANNULE = 'annule';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function validateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function scopeValides(Builder $query): Builder
    {
        return $query->where('statut', self::VALIDE);
    }

    public function scopeEnAttente(Builder $query): Builder
    {
        return $query->where('statut', self::EN_ATTENTE);
    }

    public function getDureeAttribute(): ?int
    {
        if (!$this->date_debut || !$this->date_fin) {
            return null;
        }

        return Carbon::parse($this->date_debut)->diffInDays(Carbon::parse($this->date_fin)) + 1;
    }
}
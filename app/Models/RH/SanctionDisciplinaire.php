<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SanctionDisciplinaire extends Model
{
    protected $table = 'sanctions_disciplinaires';

    protected $guarded = [];

    protected $casts = [
        'date_sanction' => 'date',
    ];

    public const ACTIVE = 'active';
    public const LEVEE = 'levee';
    public const ARCHIVEE = 'archivee';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function scopeActives(Builder $query): Builder
    {
        return $query->where('statut', self::ACTIVE);
    }
}
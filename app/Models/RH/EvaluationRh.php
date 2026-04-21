<?php

namespace App\Models\RH;

use App\Models\MembreEquipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationRh extends Model
{
    protected $table = 'evaluations_rh';

    protected $guarded = [];

    protected $casts = [
        'date_evaluation' => 'date',
    ];

    public const BROUILLON = 'brouillon';
    public const VALIDEE = 'validee';
    public const ARCHIVEE = 'archivee';

    public function membreEquipe(): BelongsTo
    {
        return $this->belongsTo(MembreEquipe::class, 'membre_equipe_id');
    }

    public function evaluateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluateur_id');
    }

    public function scopeValidees(Builder $query): Builder
    {
        return $query->where('statut', self::VALIDEE);
    }

    public function noteFormatee(): ?string
    {
        return $this->note_globale !== null ? $this->note_globale . '/10' : null;
    }
}
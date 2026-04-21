<?php

namespace App\Models\RH;

use App\Models\Departement;
use App\Models\Poste;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recrutement extends Model
{
    protected $table = 'recrutements';

    protected $guarded = [];

    protected $casts = [
        'date_ouverture' => 'date',
        'date_cloture' => 'date',
    ];

    public const STATUT_BROUILLON = 'brouillon';
    public const STATUT_OUVERT = 'ouvert';
    public const STATUT_EN_COURS = 'en_cours';
    public const STATUT_FERME = 'ferme';
    public const STATUT_ARCHIVE = 'archive';

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    public function poste(): BelongsTo
    {
        return $this->belongsTo(Poste::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }

    public function scopeOuverts(Builder $query): Builder
    {
        return $query->where('statut', self::STATUT_OUVERT);
    }

    public function scopeActifs(Builder $query): Builder
    {
        return $query->whereIn('statut', [self::STATUT_OUVERT, self::STATUT_EN_COURS]);
    }

    public function estActif(): bool
    {
        return in_array($this->statut, [self::STATUT_OUVERT, self::STATUT_EN_COURS], true);
    }
}
<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Experimentation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'experimentations';

    protected $fillable = [
        'innovation_id',
        'titre',
        'description',
        'hypothese',
        'protocole',
        'responsable_id',
        'date_debut',
        'date_fin',
        'statut',
        'resultat_global',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function sites(): HasMany
    {
        return $this->hasMany(ExperimentationSite::class, 'experimentation_id');
    }

    public function resultats(): HasMany
    {
        return $this->hasMany(ExperimentationResultat::class, 'experimentation_id');
    }

    public function decisions(): HasMany
    {
        return $this->hasMany(ExperimentationDecision::class, 'experimentation_id');
    }

    public function capitalisations(): HasMany
    {
        return $this->hasMany(CapitalisationInnovation::class, 'experimentation_id');
    }

    public function satisfactions(): HasMany
    {
        return $this->hasMany(SatisfactionInnovation::class, 'experimentation_id');
    }
}

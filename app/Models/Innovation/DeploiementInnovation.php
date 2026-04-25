<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeploiementInnovation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deploiements_innovation';

    protected $fillable = [
        'innovation_id',
        'titre',
        'description',
        'mode_deploiement',
        'date_debut',
        'date_fin_previsionnelle',
        'date_fin_reelle',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin_previsionnelle' => 'date',
        'date_fin_reelle' => 'date',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }

    public function zones(): HasMany
    {
        return $this->hasMany(DeploiementZone::class, 'deploiement_innovation_id');
    }

    public function incidents(): HasMany
    {
        return $this->hasMany(DeploiementIncident::class, 'deploiement_innovation_id');
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(DeploiementAdoption::class, 'deploiement_innovation_id');
    }

    public function couvertures(): HasMany
    {
        return $this->hasMany(DeploiementCouverture::class, 'deploiement_innovation_id');
    }

    public function formations(): HasMany
    {
        return $this->hasMany(FormationInnovation::class, 'deploiement_innovation_id');
    }

    public function signalements(): HasMany
    {
        return $this->hasMany(SignalementInnovation::class, 'deploiement_innovation_id');
    }
}

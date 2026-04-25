<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Innovation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'innovations';

    protected $fillable = [
        'innovation_portefeuille_id',
        'code',
        'titre',
        'slug',
        'description',
        'type_innovation',
        'niveau_maturite',
        'portee_geographique',
        'responsable_id',
        'sponsor_id',
        'ministere_id',
        'region_id',
        'province_id',
        'commune_id',
        'secteur',
        'date_lancement',
        'date_fin_previsionnelle',
        'date_fin_reelle',
        'budget_previsionnel',
        'budget_consomme',
        'statut',
        'niveau_priorite',
    ];

    protected $casts = [
        'date_lancement' => 'date',
        'date_fin_previsionnelle' => 'date',
        'date_fin_reelle' => 'date',
        'budget_previsionnel' => 'decimal:2',
        'budget_consomme' => 'decimal:2',
    ];

    public function portefeuille(): BelongsTo
    {
        return $this->belongsTo(InnovationPortefeuille::class, 'innovation_portefeuille_id');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function alertes(): HasMany
    {
        return $this->hasMany(InnovationAlerte::class, 'innovation_id');
    }

    public function objectifs(): HasMany
    {
        return $this->hasMany(InnovationObjectif::class, 'innovation_id');
    }

    public function indicateurs(): HasMany
    {
        return $this->hasMany(InnovationIndicateur::class, 'innovation_id');
    }

    public function partiesPrenantes(): HasMany
    {
        return $this->hasMany(InnovationPartiePrenante::class, 'innovation_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(InnovationDocument::class, 'innovation_id');
    }

    public function experimentations(): HasMany
    {
        return $this->hasMany(Experimentation::class, 'innovation_id');
    }

    public function prototypes(): HasMany
    {
        return $this->hasMany(PrototypeInnovation::class, 'innovation_id');
    }

    public function deploiements(): HasMany
    {
        return $this->hasMany(DeploiementInnovation::class, 'innovation_id');
    }

    public function suivis(): HasMany
    {
        return $this->hasMany(SuiviInnovation::class, 'innovation_id');
    }

    public function impacts(): HasMany
    {
        return $this->hasMany(ImpactInnovation::class, 'innovation_id');
    }

    public function financements(): HasMany
    {
        return $this->hasMany(FinancementInnovation::class, 'innovation_id');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(BudgetInnovation::class, 'innovation_id');
    }

    public function depenses(): HasMany
    {
        return $this->hasMany(DepenseInnovation::class, 'innovation_id');
    }

    public function partenaires(): HasMany
    {
        return $this->hasMany(PartenaireInnovation::class, 'innovation_id');
    }

    public function zones(): BelongsToMany
    {
        return $this->belongsToMany(
            ZoneInnovation::class,
            'innovation_zones',
            'innovation_id',
            'zone_innovation_id'
        )->withPivot('role_zone')->withTimestamps();
    }

    public function audits(): HasMany
    {
        return $this->hasMany(AuditInnovation::class, 'innovation_id');
    }

    public function roi(): HasOne
    {
        return $this->hasOne(InnovationRoi::class, 'innovation_id');
    }

    public function replicabilite(): HasOne
    {
        return $this->hasOne(ReplicabiliteInnovation::class, 'innovation_id');
    }

    public function gestionChangements(): HasMany
    {
        return $this->hasMany(GestionChangement::class, 'innovation_id');
    }

    public function formations(): HasMany
    {
        return $this->hasMany(FormationInnovation::class, 'innovation_id');
    }

    public function satisfactions(): HasMany
    {
        return $this->hasMany(SatisfactionInnovation::class, 'innovation_id');
    }

    public function signalements(): HasMany
    {
        return $this->hasMany(SignalementInnovation::class, 'innovation_id');
    }

    public function benchmarks(): HasMany
    {
        return $this->hasMany(BenchmarkInnovation::class, 'innovation_id');
    }

    public function capitalisations(): HasMany
    {
        return $this->hasMany(CapitalisationInnovation::class, 'innovation_id');
    }

    public function scores(): MorphMany
    {
        return $this->morphMany(InnovationScore::class, 'scorable');
    }
}

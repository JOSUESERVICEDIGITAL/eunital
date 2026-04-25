<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImpactInnovation extends Model
{
    use HasFactory;

    protected $table = 'impacts_innovation';

    protected $fillable = [
        'innovation_id',
        'type_impact',
        'description',
        'periode_mesure',
        'valeur_avant',
        'valeur_apres',
        'variation',
    ];

    protected $casts = [
        'valeur_avant' => 'decimal:2',
        'valeur_apres' => 'decimal:2',
        'variation' => 'decimal:2',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }

    public function mesures(): HasMany
    {
        return $this->hasMany(ImpactMesure::class, 'impact_innovation_id');
    }

    public function beneficiaires(): HasMany
    {
        return $this->hasMany(ImpactBeneficiaire::class, 'impact_innovation_id');
    }

    public function rapports(): HasMany
    {
        return $this->hasMany(ImpactRapport::class, 'impact_innovation_id');
    }
}

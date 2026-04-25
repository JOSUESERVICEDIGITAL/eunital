<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionDetail extends Model
{
    use HasFactory;

    protected $table = 'adoption_details';

    protected $fillable = [
        'deploiement_adoption_id',
        'segment',
        'categorie',
        'population_cible',
        'population_active',
        'taux_adoption',
        'date_mesure',
        'observation',
    ];

    protected $casts = [
        'population_cible' => 'integer',
        'population_active' => 'integer',
        'taux_adoption' => 'decimal:2',
        'date_mesure' => 'date',
    ];

    public function adoption(): BelongsTo
    {
        return $this->belongsTo(DeploiementAdoption::class, 'deploiement_adoption_id');
    }
}
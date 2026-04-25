<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactMesure extends Model
{
    use HasFactory;

    protected $table = 'impact_mesures';

    protected $fillable = [
        'impact_innovation_id',
        'indicateur',
        'unite',
        'valeur',
        'date_mesure',
    ];

    protected $casts = [
        'valeur' => 'decimal:2',
        'date_mesure' => 'date',
    ];

    public function impact(): BelongsTo
    {
        return $this->belongsTo(ImpactInnovation::class, 'impact_innovation_id');
    }
}
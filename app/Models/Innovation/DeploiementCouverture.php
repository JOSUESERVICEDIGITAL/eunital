<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeploiementCouverture extends Model
{
    use HasFactory;

    protected $table = 'deploiement_couvertures';

    protected $fillable = [
        'deploiement_innovation_id',
        'niveau_couverture',
        'structures_cibles',
        'structures_couvertes',
        'taux_couverture',
        'date_mesure',
        'observation',
    ];

    protected $casts = [
        'taux_couverture' => 'decimal:2',
        'date_mesure' => 'date',
    ];

    public function deploiement(): BelongsTo
    {
        return $this->belongsTo(DeploiementInnovation::class, 'deploiement_innovation_id');
    }
}
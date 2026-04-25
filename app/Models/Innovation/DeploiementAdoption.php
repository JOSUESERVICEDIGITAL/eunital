<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeploiementAdoption extends Model
{
    use HasFactory;

    protected $table = 'deploiement_adoptions';

    protected $fillable = [
        'deploiement_innovation_id',
        'zone',
        'beneficiaires_cibles',
        'beneficiaires_actifs',
        'taux_adoption',
        'date_mesure',
    ];

    protected $casts = [
        'taux_adoption' => 'decimal:2',
        'date_mesure' => 'date',
    ];

    public function deploiement(): BelongsTo
    {
        return $this->belongsTo(DeploiementInnovation::class, 'deploiement_innovation_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(AdoptionDetail::class, 'deploiement_adoption_id');
    }
}
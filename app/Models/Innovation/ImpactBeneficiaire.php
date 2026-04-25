<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactBeneficiaire extends Model
{
    use HasFactory;

    protected $table = 'impact_beneficiaires';

    protected $fillable = [
        'impact_innovation_id',
        'categorie_beneficiaire',
        'nombre',
        'observation',
    ];

    public function impact(): BelongsTo
    {
        return $this->belongsTo(ImpactInnovation::class, 'impact_innovation_id');
    }
}
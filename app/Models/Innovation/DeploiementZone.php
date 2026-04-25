<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeploiementZone extends Model
{
    use HasFactory;

    protected $table = 'deploiement_zones';

    protected $fillable = [
        'deploiement_innovation_id',
        'region_id',
        'province_id',
        'commune_id',
        'statut',
        'date_deploiement',
    ];

    protected $casts = [
        'date_deploiement' => 'date',
    ];

    public function deploiement(): BelongsTo
    {
        return $this->belongsTo(DeploiementInnovation::class, 'deploiement_innovation_id');
    }
}
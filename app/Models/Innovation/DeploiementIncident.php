<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeploiementIncident extends Model
{
    use HasFactory;

    protected $table = 'deploiement_incidents';

    protected $fillable = [
        'deploiement_innovation_id',
        'titre',
        'description',
        'criticite',
        'statut',
    ];

    public function deploiement(): BelongsTo
    {
        return $this->belongsTo(DeploiementInnovation::class, 'deploiement_innovation_id');
    }
}
<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactRapport extends Model
{
    use HasFactory;

    protected $table = 'impact_rapports';

    protected $fillable = [
        'impact_innovation_id',
        'titre',
        'fichier',
        'resume',
        'redige_par',
    ];

    public function impact(): BelongsTo
    {
        return $this->belongsTo(ImpactInnovation::class, 'impact_innovation_id');
    }

    public function redacteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'redige_par');
    }
}
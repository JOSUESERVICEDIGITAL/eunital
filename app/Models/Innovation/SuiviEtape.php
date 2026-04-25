<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuiviEtape extends Model
{
    use HasFactory;

    protected $table = 'suivi_etapes';

    protected $fillable = [
        'suivi_innovation_id',
        'titre',
        'description',
        'statut',
        'date_echeance',
    ];

    protected $casts = [
        'date_echeance' => 'date',
    ];

    public function suivi(): BelongsTo
    {
        return $this->belongsTo(SuiviInnovation::class, 'suivi_innovation_id');
    }
}
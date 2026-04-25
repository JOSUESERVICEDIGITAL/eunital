<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperimentationResultat extends Model
{
    use HasFactory;

    protected $table = 'experimentation_resultats';

    protected $fillable = [
        'experimentation_id',
        'indicateur',
        'unite',
        'valeur_reference',
        'valeur_obtenue',
        'observation',
    ];

    protected $casts = [
        'valeur_reference' => 'decimal:2',
        'valeur_obtenue' => 'decimal:2',
    ];

    public function experimentation(): BelongsTo
    {
        return $this->belongsTo(Experimentation::class, 'experimentation_id');
    }
}
<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;


class FinancementInnovation extends Model
{
    use HasFactory;

    protected $table = 'financements_innovation';

    protected $fillable = [
        'innovation_id',
        'source_financement',
        'type_financement',
        'montant_prevu',
        'montant_obtenu',
        'date_approbation',
        'statut',
    ];

    protected $casts = [
        'montant_prevu' => 'decimal:2',
        'montant_obtenu' => 'decimal:2',
        'date_approbation' => 'date',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }
}

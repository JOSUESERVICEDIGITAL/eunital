<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuiviBlocage extends Model
{
    use HasFactory;

    protected $table = 'suivi_blocages';

    protected $fillable = [
        'suivi_innovation_id',
        'titre',
        'description',
        'niveau_criticite',
        'statut',
    ];

    public function suivi(): BelongsTo
    {
        return $this->belongsTo(SuiviInnovation::class, 'suivi_innovation_id');
    }
}
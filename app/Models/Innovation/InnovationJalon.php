<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationJalon extends Model
{
    use HasFactory;

    protected $table = 'innovation_jalons';

    protected $fillable = [
        'innovation_feuille_route_id',
        'titre',
        'description',
        'date_prevue',
        'date_realisation',
        'statut',
        'ordre_affichage',
    ];

    protected $casts = [
        'date_prevue' => 'date',
        'date_realisation' => 'date',
        'ordre_affichage' => 'integer',
    ];

    public function feuilleRoute(): BelongsTo
    {
        return $this->belongsTo(InnovationFeuilleRoute::class, 'innovation_feuille_route_id');
    }
}
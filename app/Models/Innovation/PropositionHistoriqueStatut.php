<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionHistoriqueStatut extends Model
{
    use HasFactory;

    protected $table = 'proposition_historiques_statuts';

    protected $fillable = [
        'proposition_amelioration_id',
        'ancien_statut',
        'nouveau_statut',
        'motif',
        'changed_by'
    ];
}

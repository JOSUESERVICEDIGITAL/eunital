<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationObjectif extends Model
{
    use HasFactory;

    protected $table = 'innovation_objectifs';

    protected $fillable = [
        'innovation_id',
        'titre',
        'description',
        'valeur_cible',
        'valeur_actuelle',
        'statut'
    ];

    public function innovation()
    {
        return $this->belongsTo(Innovation::class);
    }
}

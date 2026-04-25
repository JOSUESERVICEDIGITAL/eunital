<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComiteSession extends Model
{
    use HasFactory;

    protected $table = 'comite_sessions';

    protected $fillable = [
        'comite_innovation_id',
        'titre',
        'date_session',
        'lieu',
        'ordre_du_jour',
    ];

    protected $casts = [
        'date_session' => 'datetime',
    ];

    public function comite(): BelongsTo
    {
        return $this->belongsTo(ComiteInnovation::class, 'comite_innovation_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(ComiteParticipant::class, 'comite_session_id');
    }

    public function decisions(): HasMany
    {
        return $this->hasMany(ComiteDecision::class, 'comite_session_id');
    }

    public function references(): HasMany
    {
        return $this->hasMany(ComiteReference::class, 'comite_session_id');
    }
}
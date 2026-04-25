<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteDecision extends Model
{
    use HasFactory;

    protected $table = 'comite_decisions';

    protected $fillable = [
        'comite_session_id',
        'titre',
        'decision',
        'statut',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(ComiteSession::class, 'comite_session_id');
    }
}
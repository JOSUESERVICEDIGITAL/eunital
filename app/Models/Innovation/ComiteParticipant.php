<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteParticipant extends Model
{
    use HasFactory;

    protected $table = 'comite_participants';

    protected $fillable = [
        'comite_session_id',
        'user_id',
        'nom',
        'role',
        'present',
    ];

    protected $casts = [
        'present' => 'boolean',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(ComiteSession::class, 'comite_session_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
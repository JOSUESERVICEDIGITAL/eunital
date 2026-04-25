<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuiviNotification extends Model
{
    use HasFactory;

    protected $table = 'suivi_notifications';

    protected $fillable = [
        'suivi_innovation_id',
        'destinataire_id',
        'titre',
        'message',
        'lu',
    ];

    protected $casts = [
        'lu' => 'boolean',
    ];

    public function suivi(): BelongsTo
    {
        return $this->belongsTo(SuiviInnovation::class, 'suivi_innovation_id');
    }

    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
}
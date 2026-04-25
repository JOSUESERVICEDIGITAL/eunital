<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReformeDecision extends Model
{
    use HasFactory;

    protected $table = 'reforme_decisions';

    protected $fillable = [
        'reforme_interne_id',
        'titre',
        'decision',
        'date_decision',
        'prise_par',
    ];

    protected $casts = [
        'date_decision' => 'date',
    ];

    public function reforme(): BelongsTo
    {
        return $this->belongsTo(ReformeInterne::class, 'reforme_interne_id');
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prise_par');
    }
}
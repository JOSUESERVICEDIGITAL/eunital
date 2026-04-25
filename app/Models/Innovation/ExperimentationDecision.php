<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperimentationDecision extends Model
{
    use HasFactory;

    protected $table = 'experimentation_decisions';

    protected $fillable = [
        'experimentation_id',
        'decision',
        'motif',
        'date_decision',
        'prise_par',
    ];

    protected $casts = [
        'date_decision' => 'date',
    ];

    public function experimentation(): BelongsTo
    {
        return $this->belongsTo(Experimentation::class, 'experimentation_id');
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prise_par');
    }
}
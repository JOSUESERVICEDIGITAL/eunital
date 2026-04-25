<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteReference extends Model
{
    use HasFactory;

    protected $table = 'comite_references';

    protected $fillable = [
        'comite_session_id',
        'reference_type',
        'reference_id',
        'objet',
        'observation',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(ComiteSession::class, 'comite_session_id');
    }

    public function reference()
    {
        return $this->morphTo(null, 'reference_type', 'reference_id');
    }
}
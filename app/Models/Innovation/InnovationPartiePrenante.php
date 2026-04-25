<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationPartiePrenante extends Model
{
    use HasFactory;

    protected $table = 'innovation_parties_prenantes';

    protected $fillable = [
        'innovation_id',
        'nom',
        'type_acteur',
        'contact',
        'role',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }
}
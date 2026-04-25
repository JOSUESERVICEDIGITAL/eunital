<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteInnovation extends Model
{
    use HasFactory;

    protected $table = 'comites_innovation';

    protected $fillable = [
        'nom',
        'description',
        'type_comite',
        'statut',
    ];

    public function sessions(): HasMany
    {
        return $this->hasMany(ComiteSession::class, 'comite_innovation_id');
    }
}

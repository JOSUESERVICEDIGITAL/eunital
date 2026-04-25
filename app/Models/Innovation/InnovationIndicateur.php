<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationIndicateur extends Model
{
    use HasFactory;

    protected $table = 'innovation_indicateurs';

    protected $fillable = [
        'innovation_id',
        'nom',
        'description',
        'unite',
        'valeur_reference',
        'valeur_cible',
        'valeur_actuelle'
    ];

    public function innovation()
    {
        return $this->belongsTo(Innovation::class);
    }
}

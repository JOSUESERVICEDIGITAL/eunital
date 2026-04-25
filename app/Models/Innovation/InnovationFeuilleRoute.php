<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationFeuilleRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'innovation_feuilles_routes';

    protected $fillable = [
        'innovation_portefeuille_id',
        'titre',
        'description',
        'periode_debut',
        'periode_fin',
        'statut',
        'responsable_id'
    ];

    protected $casts = [
        'periode_debut' => 'date',
        'periode_fin' => 'date',
    ];

    public function portefeuille()
    {
        return $this->belongsTo(InnovationPortefeuille::class);
    }

    public function jalons()
    {
        return $this->hasMany(InnovationJalon::class);
    }
}

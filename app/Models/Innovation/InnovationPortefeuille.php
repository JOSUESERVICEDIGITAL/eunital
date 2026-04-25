<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InnovationPortefeuille extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'innovation_portefeuilles';

    protected $fillable = [
        'code',
        'nom',
        'description',
        'type_portefeuille',
        'statut',
        'responsable_id',
        'date_lancement',
        'date_fin_previsionnelle',
        'budget_previsionnel',
        'budget_consomme',
        'niveau_priorite',
    ];

    protected $casts = [
        'date_lancement' => 'date',
        'date_fin_previsionnelle' => 'date',
        'budget_previsionnel' => 'decimal:2',
        'budget_consomme' => 'decimal:2',
    ];

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function feuillesRoutes(): HasMany
    {
        return $this->hasMany(InnovationFeuilleRoute::class, 'innovation_portefeuille_id');
    }

    public function innovations(): HasMany
    {
        return $this->hasMany(Innovation::class, 'innovation_portefeuille_id');
    }

    public function alertes(): HasMany
    {
        return $this->hasMany(InnovationAlerte::class, 'innovation_portefeuille_id');
    }
}

<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReformeInterne extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reformes_internes';

    protected $fillable = [
        'code',
        'titre',
        'description',
        'domaine',
        'objectif',
        'responsable_id',
        'statut',
        'date_debut',
        'date_fin_previsionnelle',
        'date_fin_reelle',
        'niveau_priorite',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin_previsionnelle' => 'date',
        'date_fin_reelle' => 'date',
    ];

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ReformeAction::class, 'reforme_interne_id');
    }

    public function risques(): HasMany
    {
        return $this->hasMany(ReformeRisque::class, 'reforme_interne_id');
    }

    public function decisions(): HasMany
    {
        return $this->hasMany(ReformeDecision::class, 'reforme_interne_id');
    }

    public function gestionChangements(): HasMany
    {
        return $this->hasMany(GestionChangement::class, 'reforme_interne_id');
    }
}

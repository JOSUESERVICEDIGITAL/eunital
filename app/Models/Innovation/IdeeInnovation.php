<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class IdeeInnovation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'idees_innovation';

    protected $fillable = [
        'titre',
        'description',
        'categorie',
        'origine',
        'auteur_id',
        'anonyme',
        'niveau_maturite',
        'impact_potentiel',
        'faisabilite',
        'statut',
    ];

    protected $casts = [
        'anonyme' => 'boolean',
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(IdeeCommentaire::class, 'idee_innovation_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(IdeeVote::class, 'idee_innovation_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            IdeeTag::class,
            'idee_tag_pivot',
            'idee_innovation_id',
            'idee_tag_id'
        );
    }
}

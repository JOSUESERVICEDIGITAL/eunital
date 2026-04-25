<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropositionAmelioration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'propositions_amelioration';

    protected $fillable = [
        'code',
        'titre',
        'description',
        'origine',
        'auteur_id',
        'porteur_nom',
        'porteur_email',
        'institution_source',
        'service_concerne',
        'probleme_identifie',
        'solution_proposee',
        'impact_attendu',
        'cout_estime',
        'faisabilite',
        'niveau_priorite',
        'statut',
        'date_soumission',
        'date_decision',
        'decideur_id',
    ];

    protected $casts = [
        'date_soumission' => 'date',
        'date_decision' => 'date',
        'cout_estime' => 'decimal:2',
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function decideur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'decideur_id');
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(PropositionCommentaire::class, 'proposition_amelioration_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PropositionVote::class, 'proposition_amelioration_id');
    }

    public function piecesJointes(): HasMany
    {
        return $this->hasMany(PropositionPieceJointe::class, 'proposition_amelioration_id');
    }

    public function historiquesStatuts(): HasMany
    {
        return $this->hasMany(PropositionHistoriqueStatut::class, 'proposition_amelioration_id');
    }
}

<?php

namespace App\Models\Juridique;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;

class Conformite extends Model
{
    protected $table = 'conformites';

    protected $fillable = [
        'legalite_id',
        'entreprise_id',
        'statut',
        'evaluations',
        'actions_correctives',
        'preuves',
        'date_controle',
        'date_prochaine_evaluation',
        'commentaires',
        'score_conformite'
    ];

    protected $casts = [
        'evaluations' => 'array',
        'actions_correctives' => 'array',
        'preuves' => 'array',
        'date_controle' => 'date',
        'date_prochaine_evaluation' => 'date',
        'score_conformite' => 'float'
    ];

    // Relations
    public function legalite()
    {
        return $this->belongsTo(Legalite::class, 'legalite_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    // Scopes
    public function scopeConformes($query)
    {
        return $query->where('statut', 'conforme');
    }

    public function scopeNonConformes($query)
    {
        return $query->where('statut', 'non_conforme');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    // Accesseurs
    public function getStatutLabelAttribute()
    {
        $labels = [
            'conforme' => 'Conforme',
            'non_conforme' => 'Non conforme',
            'partiellement_conforme' => 'Partiellement conforme',
            'en_cours' => 'En cours d\'évaluation'
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getStatutBadgeAttribute()
    {
        $badges = [
            'conforme' => 'success',
            'non_conforme' => 'danger',
            'partiellement_conforme' => 'warning',
            'en_cours' => 'info'
        ];
        return $badges[$this->statut] ?? 'secondary';
    }

    // Méthodes
    public function evaluer($score)
    {
        $this->score_conformite = $score;

        if ($score >= 90) {
            $this->statut = 'conforme';
        } elseif ($score >= 60) {
            $this->statut = 'partiellement_conforme';
        } else {
            $this->statut = 'non_conforme';
        }

        $this->save();

        return $this;
    }
}

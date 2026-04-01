<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;

class Litige extends Model
{
    protected $table = 'litiges';

    protected $fillable = [
        'reference',
        'titre',
        'type',
        'statut',
        'date_ouverture',
        'date_cloture',
        'montant_en_jeu',
        'parties',
        'avocats',
        'description',
        'pieces_jointes',
        'historique',
        'conclusion',
        'cout_total'
    ];

    protected $casts = [
        'date_ouverture' => 'date',
        'date_cloture' => 'date',
        'montant_en_jeu' => 'decimal:2',
        'cout_total' => 'decimal:2',
        'parties' => 'array',
        'avocats' => 'array',
        'pieces_jointes' => 'array',
        'historique' => 'array'
    ];

    // Scopes
    public function scopeOuverts($query)
    {
        return $query->whereIn('statut', ['ouvert', 'instruction', 'mediation', 'arbitrage', 'judiciaire']);
    }

    public function scopeClos($query)
    {
        return $query->where('statut', 'clos');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'commercial' => 'Commercial',
            'social' => 'Social',
            'civil' => 'Civil',
            'administratif' => 'Administratif',
            'penal' => 'Pénal',
            'fiscal' => 'Fiscal',
            'propriete_intellectuelle' => 'Propriété intellectuelle'
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getStatutLabelAttribute()
    {
        $labels = [
            'ouvert' => 'Ouvert',
            'instruction' => 'En instruction',
            'mediation' => 'Médiation',
            'arbitrage' => 'Arbitrage',
            'judiciaire' => 'Judiciaire',
            'clos' => 'Clos',
            'abandonne' => 'Abandonné'
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getDureeAttribute()
    {
        if (!$this->date_cloture) {
            return $this->date_ouverture->diffInDays(now()) . ' jours en cours';
        }

        return $this->date_ouverture->diffInDays($this->date_cloture) . ' jours';
    }

    // Méthodes
    public function ajouterHistorique($action, $commentaire = null)
    {
        $historique = $this->historique ?? [];

        $historique[] = [
            'date' => now(),
            'action' => $action,
            'commentaire' => $commentaire,
            'utilisateur' => auth()->id()
        ];

        $this->historique = $historique;
        $this->save();

        return $this;
    }
}

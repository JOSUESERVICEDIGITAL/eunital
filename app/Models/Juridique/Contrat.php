<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $table = 'contrats';

    protected $fillable = [
        'document_id',
        'reference',
        'type_contrat',
        'date_debut',
        'date_fin',
        'montant',
        'devise',
        'conditions',
        'clauses',
        'penalites',
        'duree_preavis',
        'renouvellement_auto',
        'duree_renouvellement',
        'objet',
        'parties'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'montant' => 'decimal:2',
        'conditions' => 'array',
        'clauses' => 'array',
        'penalites' => 'array',
        'parties' => 'array',
        'renouvellement_auto' => 'boolean',
        'duree_preavis' => 'integer',
        'duree_renouvellement' => 'integer'
    ];

    // Relations
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('date_debut', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('date_fin')
                           ->orWhere('date_fin', '>=', now());
                     });
    }

    public function scopeExpires($query)
    {
        return $query->where('date_fin', '<', now());
    }

    public function scopeBientotExpires($query, $jours = 30)
    {
        return $query->where('date_fin', '<=', now()->addDays($jours))
                     ->where('date_fin', '>', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type_contrat', $type);
    }

    // Accesseurs
    public function getTypeContratLabelAttribute()
    {
        $labels = [
            'cdi' => 'CDI',
            'cdd' => 'CDD',
            'freelance' => 'Freelance',
            'prestation' => 'Prestation de services',
            'partenariat' => 'Partenariat',
            'location' => 'Location',
            'vente' => 'Vente',
            'licence' => 'Licence',
            'niveau_service' => 'SLA',
            'confidentialite' => 'Confidentialité'
        ];
        return $labels[$this->type_contrat] ?? $this->type_contrat;
    }

    public function getDureeContratAttribute()
    {
        if (!$this->date_fin) return 'Durée indéterminée';

        $debut = $this->date_debut;
        $fin = $this->date_fin;
        $diff = $debut->diff($fin);

        if ($diff->y > 0) return $diff->y . ' an(s)';
        if ($diff->m > 0) return $diff->m . ' mois';
        return $diff->d . ' jour(s)';
    }

    public function getEstRenouvelableAttribute()
    {
        return $this->renouvellement_auto;
    }

    // Méthodes
    public function renouveler()
    {
        if (!$this->renouvellement_auto) return false;

        $nouvelleDateFin = $this->date_fin
            ? $this->date_fin->addDays($this->duree_renouvellement)
            : now()->addDays($this->duree_renouvellement);

        $this->update(['date_fin' => $nouvelleDateFin]);

        return true;
    }
}

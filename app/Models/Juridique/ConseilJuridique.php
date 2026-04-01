<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ConseilJuridique extends Model
{
    protected $table = 'conseils_juridiques';

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'categorie',
        'tags',
        'faq',
        'exemples',
        'references_legales',
        'vues',
        'is_published',
        'created_by'
    ];

    protected $casts = [
        'tags' => 'array',
        'faq' => 'array',
        'exemples' => 'array',
        'references_legales' => 'array',
        'vues' => 'integer',
        'is_published' => 'boolean'
    ];

    // Relations
    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopePublies($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    public function scopeRecherche($query, $search)
    {
        return $query->where('titre', 'LIKE', "%{$search}%")
                     ->orWhere('contenu', 'LIKE', "%{$search}%");
    }

    // Accesseurs
    public function getCategorieLabelAttribute()
    {
        $labels = [
            'entreprise' => 'Entreprise',
            'rh' => 'Ressources Humaines',
            'fiscal' => 'Fiscal',
            'social' => 'Social',
            'commercial' => 'Commercial',
            'international' => 'International',
            'propriete_intellectuelle' => 'Propriété intellectuelle',
            'numerique' => 'Numérique',
            'rgpd' => 'RGPD'
        ];
        return $labels[$this->categorie] ?? $this->categorie;
    }

    // Méthodes
    public function incrementerVues()
    {
        $this->increment('vues');
    }
}

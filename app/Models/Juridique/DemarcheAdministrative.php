<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;

class DemarcheAdministrative extends Model
{
    protected $table = 'demarches_administratives';

    protected $fillable = [
        'titre',
        'slug',
        'categorie',
        'description',
        'etapes',
        'documents_requis',
        'intervenants',
        'delai_estime',
        'cout_estime',
        'organismes',
        'url_officielle',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'etapes' => 'array',
        'documents_requis' => 'array',
        'intervenants' => 'array',
        'organismes' => 'array',
        'delai_estime' => 'integer',
        'cout_estime' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    // Accesseurs
    public function getCategorieLabelAttribute()
    {
        $labels = [
            'creation' => 'Création',
            'modification' => 'Modification',
            'autorisation' => 'Autorisation',
            'declaration' => 'Déclaration',
            'agrement' => 'Agrément',
            'certification' => 'Certification',
            'enregistrement' => 'Enregistrement',
            'radiation' => 'Radiation'
        ];
        return $labels[$this->categorie] ?? $this->categorie;
    }

    public function getDelaiFormateAttribute()
    {
        if (!$this->delai_estime) return 'Non défini';

        $jours = $this->delai_estime;
        if ($jours >= 30) return floor($jours / 30) . ' mois';
        return $jours . ' jour(s)';
    }
}

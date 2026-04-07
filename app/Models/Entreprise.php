<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Juridique\Document;
use App\Models\Juridique\Conformite;

class Entreprise extends Model
{
    use SoftDeletes;

    protected $table = 'entreprises';

    protected $fillable = [
        'nom',
        'siret',
        'siren',
        'ape',
        'forme_juridique',
        'capital_social',
        'adresse',
        'code_postal',
        'ville',
        'pays',
        'telephone',
        'email',
        'site_web',
        'date_creation',
        'metadatas'
    ];

    protected $casts = [
        'date_creation' => 'date',
        'metadatas' => 'array'
    ];

    // Relations
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_entreprise', 'entreprise_id', 'document_id')
                    ->withPivot('role', 'metadatas')
                    ->withTimestamps();
    }

    public function conformites()
    {
        return $this->hasMany(Conformite::class, 'entreprise_id');
    }

    // Accesseurs
    public function getAdresseCompleteAttribute()
    {
        $parts = array_filter([
            $this->adresse,
            $this->code_postal,
            $this->ville,
            $this->pays
        ]);
        
        return implode(', ', $parts);
    }

    public function getFormeJuridiqueLabelAttribute()
    {
        $labels = [
            'sa' => 'SA',
            'sas' => 'SAS',
            'sarl' => 'SARL',
            'ei' => 'Entreprise individuelle',
            'eurl' => 'EURL',
            'snc' => 'SNC',
            'sc' => 'SC',
            'autres' => 'Autre'
        ];
        
        return $labels[$this->forme_juridique] ?? $this->forme_juridique;
    }

    public function getSiretFormateAttribute()
    {
        if (!$this->siret) return null;
        
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{5})/', '$1 $2 $3 $4', $this->siret);
    }

    // Scopes
    public function scopeSearch($query, $search)
    {
        return $query->where('nom', 'LIKE', "%{$search}%")
                     ->orWhere('siret', 'LIKE', "%{$search}%")
                     ->orWhere('siren', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%");
    }

    public function scopeByPays($query, $pays)
    {
        return $query->where('pays', $pays);
    }

    public function scopeByVille($query, $ville)
    {
        return $query->where('ville', 'LIKE', "%{$ville}%");
    }

    // Méthodes
    public function getNombreDocuments()
    {
        return $this->documents()->count();
    }

    public function getNombreContrats()
    {
        return $this->documents()->whereHas('contrat')->count();
    }

    public function getTauxConformite()
    {
        $total = $this->conformites()->count();
        $conformes = $this->conformites()->where('statut', 'conforme')->count();
        
        return $total > 0 ? round(($conformes / $total) * 100, 2) : 0;
    }
}
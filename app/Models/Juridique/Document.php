<?php

namespace App\Models\Juridique;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'numero_unique',
        'titre',
        'description',
        'type_document_id',
        'modele_document_id',
        'statut',
        'contenu',
        'metadatas',
        'variables_utilisees',
        'fichier_path',
        'version',
        'date_effet',
        'date_expiration',
        'date_signature',
        'soumis_le',
        'valide_le',
        'cree_par',
        'valide_par'
    ];

    protected $casts = [
        'contenu' => 'array',
        'metadatas' => 'array',
        'variables_utilisees' => 'array',
        'date_effet' => 'date',
        'date_expiration' => 'date',
        'date_signature' => 'date',
        'soumis_le' => 'datetime',
        'valide_le' => 'datetime',
        'version' => 'integer'
    ];

    // Relations
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    public function modeleDocument()
    {
        return $this->belongsTo(ModeleDocument::class, 'modele_document_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    public function valideur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class, 'document_id');
    }

    public function contrat()
    {
        return $this->hasOne(Contrat::class, 'document_id');
    }

    public function engagement()
    {
        return $this->hasOne(Engagement::class, 'document_id');
    }

    public function utilisateurs()
    {
        return $this->belongsToMany(User::class, 'document_utilisateur', 'document_id', 'user_id')
                    ->withPivot('role', 'metadatas')
                    ->withTimestamps();
    }

    public function entreprises()
    {
        return $this->belongsToMany(Entreprise::class, 'document_entreprise', 'document_id', 'entreprise_id')
                    ->withPivot('role', 'metadatas')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeBrouillons($query)
    {
        return $query->where('statut', 'brouillon');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeSignes($query)
    {
        return $query->where('statut', 'signe');
    }

    public function scopeValides($query)
    {
        return $query->where('statut', 'valide');
    }

    public function scopeExpirants($query, $jours = 30)
    {
        return $query->where('date_expiration', '<=', now()->addDays($jours))
                     ->where('date_expiration', '>', now());
    }

    // Accesseurs
    public function getStatutLabelAttribute()
    {
        $labels = [
            'brouillon' => 'Brouillon',
            'en_attente' => 'En attente',
            'signature_attendue' => 'Signature attendue',
            'signe' => 'Signé',
            'valide' => 'Validé',
            'expire' => 'Expiré',
            'annule' => 'Annulé',
            'archive' => 'Archivé'
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getStatutBadgeAttribute()
    {
        $badges = [
            'brouillon' => 'secondary',
            'en_attente' => 'warning',
            'signature_attendue' => 'info',
            'signe' => 'primary',
            'valide' => 'success',
            'expire' => 'danger',
            'annule' => 'dark',
            'archive' => 'secondary'
        ];
        return $badges[$this->statut] ?? 'secondary';
    }

    public function getUrlPdfAttribute()
    {
        return $this->fichier_path ? asset('storage/' . $this->fichier_path) : null;
    }

    public function getEstExpireAttribute()
    {
        return $this->date_expiration && $this->date_expiration < now();
    }

    public function getEstSigneAttribute()
    {
        return $this->statut === 'signe' || $this->statut === 'valide';
    }

    // Méthodes
    public function genererNumeroUnique()
    {
        $prefix = strtoupper(substr($this->typeDocument->code, 0, 3));
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(uniqid(), -6));

        return "{$prefix}-{$year}{$month}-{$random}";
    }
}

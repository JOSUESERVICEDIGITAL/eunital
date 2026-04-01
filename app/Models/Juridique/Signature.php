<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $table = 'signatures';

    protected $fillable = [
        'document_id',
        'user_id',
        'type_signataire',
        'ordre',
        'statut',
        'email',
        'nom_complet',
        'fonction',
        'adresse_ip',
        'signature_base64',
        'certificat_digital',
        'date_signature',
        'commentaire',
        'metadatas'
    ];

    protected $casts = [
        'ordre' => 'integer',
        'date_signature' => 'datetime',
        'metadatas' => 'array'
    ];

    // Relations
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function utilisateursSignataires()
    {
        return $this->belongsToMany(User::class, 'signature_utilisateur', 'signature_id', 'user_id')
                    ->withPivot('statut', 'token', 'expire_le', 'signe_le', 'commentaire')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeSignes($query)
    {
        return $query->where('statut', 'signe');
    }

    public function scopeParOrdre($query)
    {
        return $query->orderBy('ordre');
    }

    // Accesseurs
    public function getStatutLabelAttribute()
    {
        $labels = [
            'en_attente' => 'En attente',
            'signe' => 'Signé',
            'refuse' => 'Refusé',
            'expire' => 'Expiré'
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    public function getTypeSignataireLabelAttribute()
    {
        $labels = [
            'signataire' => 'Signataire',
            'temoin' => 'Témoin',
            'representant' => 'Représentant',
            'garant' => 'Garant'
        ];
        return $labels[$this->type_signataire] ?? $this->type_signataire;
    }

    // Méthodes
    public function signer($signature_base64, $ip = null)
    {
        $this->update([
            'signature_base64' => $signature_base64,
            'adresse_ip' => $ip,
            'date_signature' => now(),
            'statut' => 'signe'
        ]);

        // Vérifier si toutes les signatures sont complétées
        $this->document->verifierSignatures();

        return $this;
    }
}

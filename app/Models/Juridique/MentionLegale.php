<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MentionLegale extends Model
{
    protected $table = 'mentions_legales';

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'type',
        'version',
        'date_effet',
        'date_fin',
        'is_active',
        'metadatas',
        'cree_par'
    ];

    protected $casts = [
        'date_effet' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean',
        'metadatas' => 'array'
    ];

    // Relations
    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('is_active', true)
                     ->where('date_effet', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('date_fin')
                           ->orWhere('date_fin', '>=', now());
                     });
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'mentions_legales' => 'Mentions légales',
            'politique_confidentialite' => 'Politique de confidentialité',
            'cgu' => 'Conditions générales d\'utilisation',
            'cgv' => 'Conditions générales de vente',
            'politique_cookies' => 'Politique des cookies',
            'charte_utilisation' => 'Charte d\'utilisation',
            'conditions_vente' => 'Conditions de vente'
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getVersionCourteAttribute()
    {
        return 'v' . $this->version;
    }
}

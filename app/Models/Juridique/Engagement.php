<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    protected $table = 'engagements';

    protected $fillable = [
        'document_id',
        'reference',
        'type_engagement',
        'contenu',
        'principes',
        'obligations',
        'date_adhesion',
        'date_fin',
        'est_public'
    ];

    protected $casts = [
        'principes' => 'array',
        'obligations' => 'array',
        'date_adhesion' => 'date',
        'date_fin' => 'date',
        'est_public' => 'boolean'
    ];

    // Relations
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('date_adhesion', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('date_fin')
                           ->orWhere('date_fin', '>=', now());
                     });
    }

    public function scopePublics($query)
    {
        return $query->where('est_public', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type_engagement', $type);
    }

    // Accesseurs
    public function getTypeEngagementLabelAttribute()
    {
        $labels = [
            'charte' => 'Charte',
            'ethique' => 'Éthique',
            'confidentialite' => 'Confidentialité',
            'conformite' => 'Conformité',
            'qualite' => 'Qualité',
            'securite' => 'Sécurité',
            'environnement' => 'Environnement',
            'social' => 'Social'
        ];
        return $labels[$this->type_engagement] ?? $this->type_engagement;
    }
}

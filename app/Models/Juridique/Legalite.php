<?php

namespace App\Models\Juridique;

use Illuminate\Database\Eloquent\Model;
use App\Models\Juridique\Conformite;

class Legalite extends Model
{
    protected $table = 'legalites';

    protected $fillable = [
        'titre',
        'slug',
        'type',
        'reference',
        'date_publication',
        'date_application',
        'resume',
        'contenu_complet',
        'articles',
        'champs_application',
        'exceptions',
        'sanctions',
        'obligations',
        'url_officielle',
        'est_en_vigueur'
    ];

    protected $casts = [
        'date_publication' => 'date',
        'date_application' => 'date',
        'articles' => 'array',
        'champs_application' => 'array',
        'exceptions' => 'array',
        'sanctions' => 'array',
        'obligations' => 'array',
        'est_en_vigueur' => 'boolean'
    ];

    // Relations
    public function conformites()
    {
        return $this->hasMany(Conformite::class, 'legalite_id');
    }

    // Scopes
    public function scopeEnVigueur($query)
    {
        return $query->where('est_en_vigueur', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'loi' => 'Loi',
            'decret' => 'Décret',
            'arrete' => 'Arrêté',
            'circulaire' => 'Circulaire',
            'directive' => 'Directive',
            'reglement' => 'Règlement',
            'norme' => 'Norme',
            'standard' => 'Standard',
            'jurisprudence' => 'Jurisprudence'
        ];
        return $labels[$this->type] ?? $this->type;
    }

    public function getDatePublicationFormateeAttribute()
    {
        return $this->date_publication ? $this->date_publication->format('d/m/Y') : 'Non définie';
    }
}

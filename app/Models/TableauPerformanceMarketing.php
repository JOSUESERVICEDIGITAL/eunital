<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableauPerformanceMarketing extends Model
{
    use HasFactory;

    protected $table = 'tableaux_performance_marketing';

    protected $fillable = [
        'auteur_id',
        'campagne_marketing_id',
        'titre',
        'slug',
        'impressions',
        'clics',
        'conversions',
        'leads',
        'ventes',
        'ctr',
        'cpc',
        'cpm',
        'roas',
        'cout_total',
        'revenu_genere',
        'periode_debut',
        'periode_fin',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'impressions' => 'integer',
            'clics' => 'integer',
            'conversions' => 'integer',
            'leads' => 'integer',
            'ventes' => 'integer',
            'ctr' => 'decimal:2',
            'cpc' => 'decimal:2',
            'cpm' => 'decimal:2',
            'roas' => 'decimal:2',
            'cout_total' => 'decimal:2',
            'revenu_genere' => 'decimal:2',
            'periode_debut' => 'date',
            'periode_fin' => 'date',
        ];
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function campagne()
    {
        return $this->belongsTo(CampagneMarketing::class, 'campagne_marketing_id');
    }

    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    public function estPublie()
    {
        return $this->statut === 'publie';
    }

    public function estArchive()
    {
        return $this->statut === 'archive';
    }

    public function tauxClicCalcule()
    {
        if ((int) $this->impressions === 0) {
            return 0;
        }

        return round(((int) $this->clics / (int) $this->impressions) * 100, 2);
    }

    public function tauxConversionCalcule()
    {
        if ((int) $this->clics === 0) {
            return 0;
        }

        return round(((int) $this->conversions / (int) $this->clics) * 100, 2);
    }
}

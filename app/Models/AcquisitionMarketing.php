<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcquisitionMarketing extends Model
{
    use HasFactory;

    protected $table = 'acquisitions_marketing';

    protected $fillable = [
        'auteur_id',
        'campagne_marketing_id',
        'titre',
        'slug',
        'source',
        'canal',
        'visiteurs',
        'leads',
        'cout_acquisition',
        'taux_conversion',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'visiteurs' => 'integer',
            'leads' => 'integer',
            'cout_acquisition' => 'decimal:2',
            'taux_conversion' => 'decimal:2',
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

    public function estActive()
    {
        return $this->statut === 'active';
    }

    public function estEnOptimisation()
    {
        return $this->statut === 'optimisation';
    }

    public function estStoppee()
    {
        return $this->statut === 'stoppee';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }
}

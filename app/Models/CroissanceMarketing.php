<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CroissanceMarketing extends Model
{
    use HasFactory;

    protected $table = 'croissances_marketing';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'objectif',
        'levier',
        'action_prevue',
        'metrique_cible',
        'priorite',
        'statut',
        'date_debut',
        'date_fin',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
        ];
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estPlanifiee()
    {
        return $this->statut === 'planifiee';
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estEnTest()
    {
        return $this->statut === 'test';
    }

    public function estValidee()
    {
        return $this->statut === 'validee';
    }

    public function estAbandonnee()
    {
        return $this->statut === 'abandonnee';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }

    public function estPrioriteCritique()
    {
        return $this->priorite === 'critique';
    }
}

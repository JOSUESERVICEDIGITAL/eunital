<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdeeIngenieurie extends Model
{
    use HasFactory;

    protected $table = 'idees_ingenieurie';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'description',
        'probleme_identifie',
        'solution_proposee',
        'niveau_priorite',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estNouvelle()
    {
        return $this->statut === 'nouvelle';
    }

    public function estEnEtude()
    {
        return $this->statut === 'en_etude';
    }

    public function estRetenue()
    {
        return $this->statut === 'retenue';
    }

    public function estRejetee()
    {
        return $this->statut === 'rejetee';
    }

    public function estRealisee()
    {
        return $this->statut === 'realisee';
    }

    public function estPrioriteCritique()
    {
        return $this->niveau_priorite === 'critique';
    }
}
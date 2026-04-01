<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestTechnique extends Model
{
    use HasFactory;

    protected $table = 'tests_techniques';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'type_test',
        'resultat',
        'environnement_test',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estFonctionnel()
    {
        return $this->type_test === 'fonctionnel';
    }

    public function estUnitaire()
    {
        return $this->type_test === 'unitaire';
    }

    public function estIntegration()
    {
        return $this->type_test === 'integration';
    }

    public function estPerformance()
    {
        return $this->type_test === 'performance';
    }

    public function estSecurite()
    {
        return $this->type_test === 'securite';
    }

    public function estRecette()
    {
        return $this->type_test === 'recette';
    }

    public function estReussi()
    {
        return $this->resultat === 'reussi';
    }

    public function estEchoue()
    {
        return $this->resultat === 'echoue';
    }

    public function estPartiel()
    {
        return $this->resultat === 'partiel';
    }

    public function estNonExecute()
    {
        return $this->resultat === 'non_execute';
    }

    public function estPlanifie()
    {
        return $this->statut === 'planifie';
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estTermine()
    {
        return $this->statut === 'termine';
    }

    public function estAnnule()
    {
        return $this->statut === 'annule';
    }
}
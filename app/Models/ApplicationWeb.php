<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationWeb extends Model
{
    use HasFactory;

    protected $table = 'applications_web';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'description',
        'stack_technique',
        'url_production',
        'url_staging',
        'statut',
        'priorite',
        'version',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estEnConception()
    {
        return $this->statut === 'conception';
    }

    public function estEnDeveloppement()
    {
        return $this->statut === 'en_developpement';
    }

    public function estEnTest()
    {
        return $this->statut === 'en_test';
    }

    public function estEnLigne()
    {
        return $this->statut === 'en_ligne';
    }

    public function estSuspendue()
    {
        return $this->statut === 'suspendue';
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
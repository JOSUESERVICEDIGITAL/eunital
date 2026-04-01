<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArchitectureTechnique extends Model
{
    use HasFactory;

    protected $table = 'architectures_techniques';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'composants',
        'technologies_recommandees',
        'contraintes_techniques',
        'diagramme',
        'version',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    public function estValidee()
    {
        return $this->statut === 'validee';
    }

    public function estObsolete()
    {
        return $this->statut === 'obsolete';
    }
}
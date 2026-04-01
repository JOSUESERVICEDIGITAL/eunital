<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReflexionStrategique extends Model
{
    use HasFactory;

    protected $table = 'reflexions_strategiques';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'contexte',
        'analyse',
        'orientation_recommandee',
        'impact_attendu',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estOuverte()
    {
        return $this->statut === 'ouverte';
    }

    public function estValidee()
    {
        return $this->statut === 'validee';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }
}
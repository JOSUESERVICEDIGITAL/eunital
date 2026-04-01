<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteVitrine extends Model
{
    use HasFactory;

    protected $table = 'sites_vitrines';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'client',
        'url_site',
        'technologies',
        'statut',
        'date_livraison_prevue',
    ];

    protected function casts(): array
    {
        return [
            'date_livraison_prevue' => 'date',
        ];
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estMaquette()
    {
        return $this->statut === 'maquette';
    }

    public function estEnDeveloppement()
    {
        return $this->statut === 'en_developpement';
    }

    public function estEnRevision()
    {
        return $this->statut === 'en_revision';
    }

    public function estLivre()
    {
        return $this->statut === 'livre';
    }

    public function estEnLigne()
    {
        return $this->statut === 'en_ligne';
    }

    public function estArchive()
    {
        return $this->statut === 'archive';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrototypeIngenieurie extends Model
{
    use HasFactory;

    protected $table = 'prototypes_ingenieurie';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'objectif',
        'lien_demo',
        'depot_source',
        'captures',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estTermine()
    {
        return $this->statut === 'termine';
    }

    public function estAbandonne()
    {
        return $this->statut === 'abandonne';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaquetteGraphique extends Model
{
    use HasFactory;

    protected $table = 'maquettes_graphiques';

    protected $fillable = [
        'titre',
        'support',
        'fichier',
        'statut',
    ];
}

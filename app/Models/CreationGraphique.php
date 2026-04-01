<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreationGraphique extends Model
{
    use HasFactory;

    protected $table = 'creations_graphiques';

    protected $fillable = [
        'titre',
        'description',
        'type',
        'statut',
        'fichier',
        'client_studio_id',
        'projet_studio_id',
        'auteur_id',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function projet()
    {
        return $this->belongsTo(ProjetStudio::class, 'projet_studio_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}

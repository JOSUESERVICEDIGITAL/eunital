<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionAudio extends Model
{
    use HasFactory;

    protected $table = 'production_audios';

    protected $fillable = [
        'titre',
        'description',
        'client_studio_id',
        'projet_studio_id',
        'type',
        'statut',
        'duree',
        'fichier_audio',
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
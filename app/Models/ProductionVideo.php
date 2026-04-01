<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionVideo extends Model
{
    use HasFactory;

    protected $table = 'production_videos';

    protected $fillable = [
        'titre',
        'description',
        'client_studio_id',
        'projet_studio_id',
        'type',
        'statut',
        'fichier_video',
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

    public function montages()
    {
        return $this->hasMany(MontageStudio::class, 'production_video_id');
    }
}
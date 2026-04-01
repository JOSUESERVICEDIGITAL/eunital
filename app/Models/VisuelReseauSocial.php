<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisuelReseauSocial extends Model
{
    use HasFactory;

    protected $table = 'visuels_reseaux_sociaux';

    protected $fillable = [
        'titre',
        'plateforme',
        'fichier',
        'statut',
        'date_publication',
        'client_studio_id',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }
}

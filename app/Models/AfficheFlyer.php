<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AfficheFlyer extends Model
{
    use HasFactory;

    protected $table = 'affiches_flyers';

    protected $fillable = [
        'titre',
        'description',
        'type',
        'fichier',
        'statut',
        'client_studio_id',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }
}

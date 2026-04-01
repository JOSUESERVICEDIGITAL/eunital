<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeClientGraphisme extends Model
{
    use HasFactory;

    protected $table = 'demandes_clients_graphisme';

    protected $fillable = [
        'titre',
        'description',
        'type',
        'priorite',
        'statut',
        'client_studio_id',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }
}

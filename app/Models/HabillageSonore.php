<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HabillageSonore extends Model
{
    use HasFactory;

    protected $table = 'habillage_sonores';

    protected $fillable = [
        'titre',
        'type',
        'fichier_audio',
        'statut',
    ];
}
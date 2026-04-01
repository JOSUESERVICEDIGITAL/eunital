<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UiuxDesign extends Model
{
    use HasFactory;

    protected $table = 'uiux_designs';

    protected $fillable = [
        'titre',
        'type',
        'fichier',
        'statut',
        'projet_studio_id',
    ];

    public function projet()
    {
        return $this->belongsTo(ProjetStudio::class, 'projet_studio_id');
    }
}

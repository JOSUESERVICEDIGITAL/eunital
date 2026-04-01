<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CreationGraphique;
use App\Models\UiuxDesign;

class ProjetStudio extends Model
{
    use HasFactory;

    protected $table = 'projet_studios';

    protected $fillable = [
        'titre',
        'client_studio_id',
        'type',
        'statut',
        'date_sortie',
    ];

    protected function casts(): array
    {
        return [
            'date_sortie' => 'date',
        ];
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function videos()
    {
        return $this->hasMany(ProductionVideo::class, 'projet_studio_id');
    }

    public function audios()
    {
        return $this->hasMany(ProductionAudio::class, 'projet_studio_id');
    }
    public function creationsGraphiques()
{
    return $this->hasMany(CreationGraphique::class, 'projet_studio_id');
}

public function uiuxDesigns()
{
    return $this->hasMany(UiuxDesign::class, 'projet_studio_id');
}
}

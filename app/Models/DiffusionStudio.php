<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiffusionStudio extends Model
{
    use HasFactory;

    protected $table = 'diffusion_studios';

    protected $fillable = [
        'titre',
        'evenement_studio_id',
        'plateforme',
        'type',
        'url_diffusion',
        'date_diffusion',
        'statut',
        'vues',
        'responsable_id',
    ];

    protected function casts(): array
    {
        return [
            'date_diffusion' => 'datetime',
        ];
    }

    public function evenement()
    {
        return $this->belongsTo(EvenementStudio::class, 'evenement_studio_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvenementStudio extends Model
{
    use HasFactory;

    protected $table = 'evenement_studios';

    protected $fillable = [
        'titre',
        'client_studio_id',
        'type',
        'date',
        'lieu',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function captations()
    {
        return $this->hasMany(CaptationStudio::class, 'evenement_studio_id');
    }

    public function diffusions()
    {
        return $this->hasMany(DiffusionStudio::class, 'evenement_studio_id');
    }
}
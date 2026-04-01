<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationStudio extends Model
{
    use HasFactory;

    protected $table = 'reservation_studios';

    protected $fillable = [
        'client_studio_id',
        'date_debut',
        'date_fin',
        'salle',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'datetime',
            'date_fin' => 'datetime',
        ];
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }
}
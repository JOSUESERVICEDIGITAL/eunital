<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaptationStudio extends Model
{
    use HasFactory;

    protected $table = 'captation_studios';

    protected $fillable = [
        'titre',
        'evenement_studio_id',
        'date',
        'lieu',
        'type',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function evenement()
    {
        return $this->belongsTo(EvenementStudio::class, 'evenement_studio_id');
    }
}
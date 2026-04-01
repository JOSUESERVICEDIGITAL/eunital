<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MontageStudio extends Model
{
    use HasFactory;

    protected $table = 'montage_studios';

    protected $fillable = [
        'titre',
        'production_video_id',
        'statut',
        'notes',
        'fichier_final',
    ];

    public function video()
    {
        return $this->belongsTo(ProductionVideo::class, 'production_video_id');
    }
}
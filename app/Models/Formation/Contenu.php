<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contenu extends Model
{
    use SoftDeletes;

    protected $table = 'contenus';

    protected $fillable = [
        'titre',
        'type',
        'contenu',
        'fichier',
        'type_fichier',
        'taille_fichier',
        'telechargeable',
        'is_visible',
        'chapitre_id',
        'ordre'
    ];

    protected $casts = [
        'telechargeable' => 'boolean',
        'is_visible' => 'boolean',
        'taille_fichier' => 'integer',
        'ordre' => 'integer'
    ];

    // Relations
    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class, 'chapitre_id');
    }

    // Accesseurs
    public function getUrlAttribute()
    {
        return $this->fichier ? asset('storage/' . $this->fichier) : null;
    }

    public function getTailleFormateeAttribute()
    {
        if (!$this->taille_fichier) return null;
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $power = $this->taille_fichier > 0 ? floor(log($this->taille_fichier, 1024)) : 0;
        return number_format($this->taille_fichier / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
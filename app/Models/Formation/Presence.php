<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $table = 'presences';

    protected $fillable = [
        'inscription_id',
        'cour_id',
        'date_debut',
        'date_fin',
        'duree_connexion',
        'present',
        'statut',
        'code_acces'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'duree_connexion' => 'integer',
        'present' => 'boolean'
    ];

    // Relations
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    // Scopes
    public function scopePresent($query)
    {
        return $query->where('present', true);
    }

    public function scopeAbsent($query)
    {
        return $query->where('present', false);
    }

    // Accesseurs
    public function getDureeFormateeAttribute()
    {
        if (!$this->duree_connexion) return '0 min';
        
        $minutes = floor($this->duree_connexion / 60);
        $secondes = $this->duree_connexion % 60;
        
        return $minutes > 0 ? "{$minutes} min {$secondes} sec" : "{$secondes} sec";
    }
}
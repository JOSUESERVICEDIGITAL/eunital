<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscriptions';

    protected $fillable = [
        'user_id',
        'module_id',
        'statut',
        'date_debut',
        'date_fin',
        'progression',
        'derniere_activite',
        'metadatas'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'derniere_activite' => 'date',
        'progression' => 'integer',
        'metadatas' => 'array'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'inscription_id');
    }

    // Scopes
    public function scopeValidees($query)
    {
        return $query->where('statut', 'valide');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeTerminees($query)
    {
        return $query->where('statut', 'termine');
    }

    // Accesseurs
    public function getTauxPresenceAttribute()
    {
        $totalPresences = $this->module->cours()->count();
        $presencesReelles = $this->presences()->where('present', true)->count();
        
        return $totalPresences > 0 ? ($presencesReelles / $totalPresences) * 100 : 0;
    }
}
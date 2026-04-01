<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;

class AccesSalle extends Model
{
    protected $table = 'acces_salles';

    protected $fillable = [
        'cour_id',
        'code_acces',
        'generated_at',
        'expires_at',
        'is_active',
        'max_utilisateurs',
        'utilisateurs_actifs'
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'max_utilisateurs' => 'integer',
        'utilisateurs_actifs' => 'array'
    ];

    // Relations
    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('is_active', true)
                     ->where('expires_at', '>', now());
    }

    public function scopeExpires($query)
    {
        return $query->where('expires_at', '<=', now());
    }

    // Accesseurs
    public function getEstValideAttribute()
    {
        return $this->is_active && $this->expires_at > now();
    }

    public function getNbUtilisateursActifsAttribute()
    {
        return count($this->utilisateurs_actifs ?? []);
    }

    // Méthodes
    public function ajouterUtilisateur($userId)
    {
        $utilisateurs = $this->utilisateurs_actifs ?? [];
        
        if (!in_array($userId, $utilisateurs)) {
            $utilisateurs[] = $userId;
            $this->utilisateurs_actifs = $utilisateurs;
            $this->save();
        }
        
        return $this;
    }
    
    public function retirerUtilisateur($userId)
    {
        $utilisateurs = $this->utilisateurs_actifs ?? [];
        $utilisateurs = array_filter($utilisateurs, fn($id) => $id != $userId);
        $this->utilisateurs_actifs = array_values($utilisateurs);
        $this->save();
        
        return $this;
    }
}
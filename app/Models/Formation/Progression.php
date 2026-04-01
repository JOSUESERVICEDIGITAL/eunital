<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    protected $table = 'progressions';

    protected $fillable = [
        'user_id',
        'cour_id',
        'chapitre_id',
        'progression',
        'termine',
        'dernier_acces',
        'metadatas'
    ];

    protected $casts = [
        'progression' => 'integer',
        'termine' => 'boolean',
        'dernier_acces' => 'datetime',
        'metadatas' => 'array'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class, 'chapitre_id');
    }

    // Scopes
    public function scopeTermines($query)
    {
        return $query->where('termine', true);
    }

    public function scopeEnCours($query)
    {
        return $query->where('termine', false)->where('progression', '>', 0);
    }

    public function scopeNonDebutes($query)
    {
        return $query->where('progression', 0);
    }

    // Accesseurs
    public function getEstTermineAttribute()
    {
        return $this->termine;
    }

    public function getPourcentageAttribute()
    {
        return $this->progression;
    }

    // Méthodes
    public function avancer($pourcentage)
    {
        $this->progression = min(100, $this->progression + $pourcentage);
        
        if ($this->progression >= 100) {
            $this->termine = true;
        }
        
        $this->dernier_acces = now();
        $this->save();
        
        return $this;
    }
}
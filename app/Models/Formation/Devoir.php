<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devoir extends Model
{
    use SoftDeletes;

    protected $table = 'devoirs';

    protected $fillable = [
        'titre',
        'description',
        'cour_id',
        'type',
        'date_limite',
        'duree_limite',
        'note_maximale',
        'is_published',
        'visible',
        'resources'
    ];

    protected $casts = [
        'date_limite' => 'datetime',
        'duree_limite' => 'integer',
        'note_maximale' => 'integer',
        'is_published' => 'boolean',
        'visible' => 'boolean',
        'resources' => 'array'
    ];

    // Relations
    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    public function soumissions()
    {
        return $this->hasMany(SoumissionDevoir::class, 'devoir_id');
    }

    // Scopes
    public function scopePublies($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeVisibles($query)
    {
        return $query->where('visible', true);
    }

    public function scopeNonExpires($query)
    {
        return $query->where('date_limite', '>', now());
    }

    public function scopeExpires($query)
    {
        return $query->where('date_limite', '<=', now());
    }

    // Accesseurs
    public function getNbSoumissionsAttribute()
    {
        return $this->soumissions()->count();
    }

    public function getNbSoumissionsNonCorrigeesAttribute()
    {
        return $this->soumissions()->whereNull('note')->count();
    }

    public function getMoyenneAttribute()
    {
        return $this->soumissions()->whereNotNull('note')->avg('note');
    }

    public function getEstExpireAttribute()
    {
        return $this->date_limite && $this->date_limite <= now();
    }
}
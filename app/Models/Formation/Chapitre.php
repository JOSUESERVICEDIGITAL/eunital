<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapitre extends Model
{
    use SoftDeletes;

    protected $table = 'chapitres';

    protected $fillable = [
        'titre',
        'description',
        'cour_id',
        'ordre',
        'duree_estimee',
        'is_free'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'duree_estimee' => 'integer',
        'ordre' => 'integer'
    ];

    // Relations
    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'chapitre_id')->orderBy('ordre');
    }

    // Accesseurs
    public function getNbContenusAttribute()
    {
        return $this->contenus()->count();
    }

    public function getDureeTotaleAttribute()
    {
        return $this->contenus()->sum('duree_estimee') ?? $this->duree_estimee;
    }
}
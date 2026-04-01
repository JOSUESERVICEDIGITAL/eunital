<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $table = 'modules';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'categorie_module_id',
        'niveau',
        'duree_estimee',
        'image_couverture',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duree_estimee' => 'integer'
    ];

    // Relations
    public function categorie()
    {
        return $this->belongsTo(CategorieModule::class, 'categorie_module_id');
    }

    public function cours()
    {
        return $this->hasMany(Cour::class, 'module_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'module_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByNiveau($query, $niveau)
    {
        return $query->where('niveau', $niveau);
    }

    // Accesseurs
    public function getNbCoursAttribute()
    {
        return $this->cours()->count();
    }

    public function getNbInscritsAttribute()
    {
        return $this->inscriptions()->where('statut', 'valide')->count();
    }

    public function getDureeTotaleAttribute()
    {
        return $this->cours()->sum('duree_estimee');
    }
}
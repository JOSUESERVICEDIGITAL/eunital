<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cour extends Model
{
    use SoftDeletes;

    protected $table = 'cours';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'objectifs',
        'pre_requis',
        'module_id',
        'ordre',
        'niveau_difficulte',
        'duree_estimee',
        'image_couverture',
        'video_intro',
        'is_published',
        'is_visible',
        'commentable',
        'published_at',
        'created_by'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_visible' => 'boolean',
        'commentable' => 'boolean',
        'duree_estimee' => 'integer',
        'published_at' => 'datetime',
        'ordre' => 'integer'
    ];

    // Relations
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class, 'cour_id')->orderBy('ordre');
    }

    public function devoirs()
    {
        return $this->hasMany(Devoir::class, 'cour_id');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'cour_id');
    }

    public function accesSalles()
    {
        return $this->hasMany(AccesSalle::class, 'cour_id');
    }

    public function commentaires()
    {
        return $this->hasMany(CommentaireCours::class, 'cour_id');
    }

    public function progressions()
    {
        return $this->hasMany(Progression::class, 'cour_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function enseignants()
    {
        return $this->belongsToMany(User::class, 'cours_enseignant', 'cour_id', 'user_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function utilisateurs()
    {
        return $this->belongsToMany(User::class, 'cours_utilisateur', 'cour_id', 'user_id')
                    ->withPivot('termine', 'progression', 'dernier_acces')
                    ->withTimestamps();
    }

    // Scopes
    public function scopePublies($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeBrouillons($query)
    {
        return $query->where('is_published', false);
    }

    public function scopeVisibles($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeByDifficulte($query, $niveau)
    {
        return $query->where('niveau_difficulte', $niveau);
    }

    // Accesseurs
    public function getDureeTotaleAttribute()
    {
        return $this->chapitres()->sum('duree_estimee');
    }

    public function getNbChapitresAttribute()
    {
        return $this->chapitres()->count();
    }

    public function getProgressionMoyenneAttribute()
    {
        return $this->progressions()->avg('progression') ?? 0;
    }

    public function getNbCommentairesAttribute()
    {
        return $this->commentaires()->count();
    }
}
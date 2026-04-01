<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentaireCours extends Model
{
    use SoftDeletes;

    protected $table = 'commentaires_cours';

    protected $fillable = [
        'user_id',
        'cour_id',
        'parent_id',
        'contenu',
        'likes',
        'is_approved'
    ];

    protected $casts = [
        'likes' => 'integer',
        'is_approved' => 'boolean'
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

    public function parent()
    {
        return $this->belongsTo(CommentaireCours::class, 'parent_id');
    }

    public function reponses()
    {
        return $this->hasMany(CommentaireCours::class, 'parent_id')->orderBy('created_at');
    }

    // Scopes
    public function scopeApprouves($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('is_approved', false);
    }

    // Accesseurs
    public function getNbReponsesAttribute()
    {
        return $this->reponses()->count();
    }
}
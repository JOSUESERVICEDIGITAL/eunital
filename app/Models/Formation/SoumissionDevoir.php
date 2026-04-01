<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SoumissionDevoir extends Model
{
    protected $table = 'soumissions_devoirs';

    protected $fillable = [
        'devoir_id',
        'user_id',
        'contenu',
        'fichiers',
        'note',
        'commentaire_enseignant',
        'soumis_le',
        'note_le'
    ];

    protected $casts = [
        'fichiers' => 'array',
        'note' => 'float',
        'soumis_le' => 'datetime',
        'note_le' => 'datetime'
    ];

    // Relations
    public function devoir()
    {
        return $this->belongsTo(Devoir::class, 'devoir_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeNonCorrigees($query)
    {
        return $query->whereNull('note');
    }

    public function scopeCorrigees($query)
    {
        return $query->whereNotNull('note');
    }

    // Accesseurs
    public function getNoteSur20Attribute()
    {
        if (!$this->note) return null;
        
        $maxNote = $this->devoir->note_maximale;
        return ($this->note / $maxNote) * 20;
    }

    public function getEstCorrigeAttribute()
    {
        return !is_null($this->note);
    }

    public function getEstEnRetardAttribute()
    {
        return $this->soumis_le > $this->devoir->date_limite;
    }
}
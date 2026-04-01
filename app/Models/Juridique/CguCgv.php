<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CguCgv extends Model
{
    protected $table = 'cgu_cgv';

    protected $fillable = [
        'titre',
        'type',
        'contenu',
        'version',
        'date_effet',
        'date_fin',
        'articles',
        'annexes',
        'is_active',
        'cree_par'
    ];

    protected $casts = [
        'date_effet' => 'date',
        'date_fin' => 'date',
        'articles' => 'array',
        'annexes' => 'array',
        'is_active' => 'boolean'
    ];

    // Relations
    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('is_active', true)
                     ->where('date_effet', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('date_fin')
                           ->orWhere('date_fin', '>=', now());
                     });
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        return $this->type === 'cgu' ? 'CGU' : 'CGV';
    }

    public function getVersionCourteAttribute()
    {
        return 'v' . $this->version;
    }
}

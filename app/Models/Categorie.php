<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'categorie_parente_id',
        'est_active',
    ];

    public function categorieParente()
    {
        return $this->belongsTo(Categorie::class, 'categorie_parente_id');
    }

    public function sousCategories()
    {
        return $this->hasMany(Categorie::class, 'categorie_parente_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etiquette extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_etiquette');
    }
}

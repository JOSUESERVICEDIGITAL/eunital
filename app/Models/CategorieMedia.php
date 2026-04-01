<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategorieMedia extends Model
{
    use HasFactory;

    protected $table = 'categories_medias';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'est_actif',
    ];

    protected function casts(): array
    {
        return [
            'est_actif' => 'boolean',
        ];
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'categorie_media_id');
    }

    public function estActive()
    {
        return $this->est_actif === true;
    }
}
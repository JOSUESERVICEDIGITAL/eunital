<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categorie_id',
        'titre',
        'slug',
        'resume',
        'contenu',
        'image_principale',
        'statut',
        'commentaires_actives',
        'date_publication',
        'nombre_vues',
        'est_mis_en_avant',
    ];

    protected $casts = [
        'commentaires_actives' => 'boolean',
        'date_publication' => 'datetime',
        'est_mis_en_avant' => 'boolean',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function etiquettes()
    {
        return $this->belongsToMany(Etiquette::class, 'article_etiquette');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}

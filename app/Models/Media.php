<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = [
        'categorie_media_id',
        'user_id',
        'titre',
        'slug',
        'description',
        'fichier',
        'miniature',
        'type_media',
        'mime_type',
        'taille',
        'extension',
        'url_externe',
        'alt_text',
        'est_public',
        'est_en_avant',
    ];

    protected function casts(): array
    {
        return [
            'taille' => 'integer',
            'est_public' => 'boolean',
            'est_en_avant' => 'boolean',
        ];
    }

    public function categorie()
    {
        return $this->belongsTo(CategorieMedia::class, 'categorie_media_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estImage()
    {
        return $this->type_media === 'image';
    }

    public function estVideo()
    {
        return $this->type_media === 'video';
    }

    public function estDocument()
    {
        return $this->type_media === 'document';
    }

    public function estAudio()
    {
        return $this->type_media === 'audio';
    }

    public function estLien()
    {
        return $this->type_media === 'lien';
    }

    public function estPublic()
    {
        return $this->est_public === true;
    }

    public function estEnAvant()
    {
        return $this->est_en_avant === true;
    }

    public function sourcePrincipale()
    {
        return $this->url_externe ?: $this->fichier;
    }
}
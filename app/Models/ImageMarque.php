<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageMarque extends Model
{
    use HasFactory;

    protected $table = 'images_marque';

    protected $fillable = [
        'auteur_id',
        'nom_marque',
        'slug',
        'slogan',
        'ton_marque',
        'identite_visuelle',
        'palette_couleurs',
        'elements_langage',
        'ligne_editoriale',
        'logo',
        'charte_graphique',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    public function estActive()
    {
        return $this->statut === 'active';
    }

    public function estObsolete()
    {
        return $this->statut === 'obsolete';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }
}

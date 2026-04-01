<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PositionnementMarketing extends Model
{
    use HasFactory;

    protected $table = 'positionnements_marketing';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'segment_cible',
        'probleme_adresse',
        'promesse',
        'differenciation',
        'message_central',
        'canal_principal',
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

    public function estActif()
    {
        return $this->statut === 'actif';
    }

    public function estARevoir()
    {
        return $this->statut === 'a_revoir';
    }

    public function estArchive()
    {
        return $this->statut === 'archive';
    }
}

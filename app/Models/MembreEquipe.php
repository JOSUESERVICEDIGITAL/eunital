<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembreEquipe extends Model
{
    use HasFactory;

    protected $table = 'membres_equipe';

    protected $fillable = [
        'user_id',
        'departement_id',
        'poste_id',
        'responsable_id',
        'nom',
        'prenom',
        'email_professionnel',
        'telephone',
        'photo',
        'bio',
        'date_integration',
        'statut',
        'ordre_organigramme',
        'est_visible_organigramme',
    ];

    protected function casts(): array
    {
        return [
            'date_integration' => 'date',
            'est_visible_organigramme' => 'boolean',
        ];
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }

    public function responsable()
    {
        return $this->belongsTo(MembreEquipe::class, 'responsable_id');
    }

    public function subordonnes()
    {
        return $this->hasMany(MembreEquipe::class, 'responsable_id');
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(MessageInterne::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(MessageInterne::class, 'destinataire_id');
    }

    public function nomComplet()
    {
        return trim($this->nom . ' ' . $this->prenom);
    }

    public function estActif()
    {
        return $this->statut === 'actif';
    }

    public function estEnPause()
    {
        return $this->statut === 'en_pause';
    }

    public function estInactif()
    {
        return $this->statut === 'inactif';
    }
}

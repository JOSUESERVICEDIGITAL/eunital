<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratJuridique extends Model
{
    protected $table = 'contrats_juridiques';

    protected $fillable = [
        'titre',
        'reference',
        'type_contrat',
        'partie_type',
        'client_studio_id',
        'user_id',
        'projet_studio_id',
        'paiement_id',
        'facture_id',
        'statut',
        'date_debut',
        'date_fin',
        'montant',
        'fichier_pdf',
        'contenu',
        'notes',
        'auteur_id',
        'validateur_id',
        'date_validation',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projet()
    {
        return $this->belongsTo(ProjetStudio::class, 'projet_studio_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'validateur_id');
    }

    public function piecesJointes()
    {
        return $this->hasMany(PieceJointeJuridique::class, 'contrat_juridique_id');
    }
}
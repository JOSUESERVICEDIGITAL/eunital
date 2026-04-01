<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngagementJuridique extends Model
{
    protected $table = 'engagements_juridiques';

    protected $fillable = [
        'nom_complet',
        'email',
        'telephone',
        'type_engagement',
        'service_concerne',
        'chambre_source',
        'description',
        'statut',
        'user_id',
        'client_studio_id',
        'valide_par',
        'date_validation',
        'fichier_formulaire',
        'fichier_contrat',
        'observation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }

    public function piecesJointes()
    {
        return $this->hasMany(PieceJointeJuridique::class, 'engagement_juridique_id');
    }
}
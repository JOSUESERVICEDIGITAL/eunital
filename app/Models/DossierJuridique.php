<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DossierJuridique extends Model
{
    protected $table = 'dossiers_juridiques';

    protected $fillable = [
        'titre',
        'type_dossier',
        'description',
        'statut',
        'priorite',
        'responsable_id',
        'client_studio_id',
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function piecesJointes()
    {
        return $this->hasMany(PieceJointeJuridique::class, 'dossier_juridique_id');
    }
}
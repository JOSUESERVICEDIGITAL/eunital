<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageInterne extends Model
{
    use HasFactory;

    protected $table = 'messages_internes';

    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'departement_id',
        'sujet',
        'contenu',
        'type_message',
        'est_lu',
        'date_envoi',
    ];

    protected function casts(): array
    {
        return [
            'est_lu' => 'boolean',
            'date_envoi' => 'datetime',
        ];
    }

    public function expediteur()
    {
        return $this->belongsTo(MembreEquipe::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(MembreEquipe::class, 'destinataire_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function estMessageDirect()
    {
        return $this->type_message === 'direct';
    }

    public function estAnnonce()
    {
        return $this->type_message === 'annonce';
    }

    public function estMessageService()
    {
        return $this->type_message === 'service';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeStudio extends Model
{
    use HasFactory;

    protected $table = 'commandes_studio';

    protected $fillable = [
        'reference',
        'client_studio_id',
        'montant_total',
        'acompte',
        'statut',
        'date_livraison',
    ];

    protected function casts(): array
    {
        return [
            'montant_total' => 'decimal:2',
            'acompte' => 'decimal:2',
            'date_livraison' => 'date',
        ];
    }

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }

    public function montantRestant()
    {
        return (float) $this->montant_total - (float) $this->acompte;
    }

    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function estConfirmee()
    {
        return $this->statut === 'confirmee';
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estLivree()
    {
        return $this->statut === 'livree';
    }
}
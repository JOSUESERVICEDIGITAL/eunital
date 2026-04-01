<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtudeFaisabilite extends Model
{
    use HasFactory;

    protected $table = 'etudes_faisabilite';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'faisabilite_technique',
        'faisabilite_financiere',
        'faisabilite_humaine',
        'risques',
        'recommandation_finale',
        'decision',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estFavorable()
    {
        return $this->decision === 'favorable';
    }

    public function estReservee()
    {
        return $this->decision === 'reservee';
    }

    public function estDefavorable()
    {
        return $this->decision === 'defavorable';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LienSocial extends Model
{
    use HasFactory;

    protected $table = 'liens_sociaux';

    protected $fillable = [
        'nom',
        'slug',
        'icone',
        'url',
        'emplacement',
        'ordre_affichage',
        'est_actif',
    ];

    protected function casts(): array
    {
        return [
            'ordre_affichage' => 'integer',
            'est_actif' => 'boolean',
        ];
    }

    public function estActif()
    {
        return $this->est_actif === true;
    }

    public function estPourHeader()
    {
        return $this->emplacement === 'header';
    }

    public function estPourFooter()
    {
        return $this->emplacement === 'footer';
    }

    public function estPourPartout()
    {
        return $this->emplacement === 'partout';
    }
}
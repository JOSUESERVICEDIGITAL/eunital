<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'est_actif',
    ];

    protected function casts(): array
    {
        return [
            'est_actif' => 'boolean',
        ];
    }

    public function postes()
    {
        return $this->hasMany(Poste::class, 'departement_id');
    }

    public function membres()
    {
        return $this->hasMany(MembreEquipe::class, 'departement_id');
    }

    public function messagesInternes()
    {
        return $this->hasMany(MessageInterne::class, 'departement_id');
    }
}

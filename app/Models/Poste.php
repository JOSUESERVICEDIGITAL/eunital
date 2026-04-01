<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poste extends Model
{
    use HasFactory;

    protected $table = 'postes';

    protected $fillable = [
        'departement_id',
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

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function membres()
    {
        return $this->hasMany(MembreEquipe::class, 'poste_id');
    }
}

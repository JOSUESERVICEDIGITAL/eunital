<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipementStudio extends Model
{
    use HasFactory;

    protected $table = 'equipements_studio';

    protected $fillable = [
        'nom',
        'type',
        'etat',
    ];

    public function estDisponible()
    {
        return $this->etat === 'disponible';
    }

    public function estReserve()
    {
        return $this->etat === 'reserve';
    }

    public function estEnMaintenance()
    {
        return $this->etat === 'maintenance';
    }
}
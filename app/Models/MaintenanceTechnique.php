<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceTechnique extends Model
{
    use HasFactory;

    protected $table = 'maintenances_techniques';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'description',
        'type_maintenance',
        'niveau_urgence',
        'statut',
        'date_signalement',
        'date_resolution',
    ];

    protected function casts(): array
    {
        return [
            'date_signalement' => 'datetime',
            'date_resolution' => 'datetime',
        ];
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estCorrective()
    {
        return $this->type_maintenance === 'corrective';
    }

    public function estPreventive()
    {
        return $this->type_maintenance === 'preventive';
    }

    public function estEvolutive()
    {
        return $this->type_maintenance === 'evolutive';
    }

    public function estUrgence()
    {
        return $this->type_maintenance === 'urgence';
    }

    public function estSecurite()
    {
        return $this->type_maintenance === 'securite';
    }

    public function estOuverte()
    {
        return $this->statut === 'ouverte';
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estResolue()
    {
        return $this->statut === 'resolue';
    }

    public function estFermee()
    {
        return $this->statut === 'fermee';
    }

    public function estReportee()
    {
        return $this->statut === 'reportee';
    }

    public function estUrgenceCritique()
    {
        return $this->niveau_urgence === 'critique';
    }
}
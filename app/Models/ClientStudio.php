<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProjetStudio;
use App\Models\ReservationStudio;
use App\Models\ProductionVideo;
use App\Models\ProductionAudio;
use App\Models\EvenementStudio;
use App\Models\CreationGraphique;
use App\Models\IdentiteVisuelle;
use App\Models\AfficheFlyer;
use App\Models\VisuelReseauSocial;
use App\Models\DemandeClientGraphisme;



class ClientStudio extends Model
{
    use HasFactory;

    protected $table = 'client_studios';

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'type',
        'adresse',
    ];

    public function projets()
    {
        return $this->hasMany(ProjetStudio::class, 'client_studio_id');
    }

    public function reservations()
    {
        return $this->hasMany(ReservationStudio::class, 'client_studio_id');
    }

    public function productionsVideo()
    {
        return $this->hasMany(ProductionVideo::class, 'client_studio_id');
    }

    public function productionsAudio()
    {
        return $this->hasMany(ProductionAudio::class, 'client_studio_id');
    }

    public function evenements()
    {
        return $this->hasMany(EvenementStudio::class, 'client_studio_id');
    }

    public function creationsGraphiques()
{
    return $this->hasMany(CreationGraphique::class, 'client_studio_id');
}

public function identitesVisuelles()
{
    return $this->hasMany(IdentiteVisuelle::class, 'client_studio_id');
}

public function affichesFlyers()
{
    return $this->hasMany(AfficheFlyer::class, 'client_studio_id');
}

public function visuelsReseauxSociaux()
{
    return $this->hasMany(VisuelReseauSocial::class, 'client_studio_id');
}

public function demandesGraphisme()
{
    return $this->hasMany(DemandeClientGraphisme::class, 'client_studio_id');
}
}

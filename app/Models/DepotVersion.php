<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepotVersion extends Model
{
    use HasFactory;

    protected $table = 'depots_versions';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'url_depot',
        'branche_principale',
        'version_actuelle',
        'type_version',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estVersionMajeure()
    {
        return $this->type_version === 'majeure';
    }

    public function estVersionMineure()
    {
        return $this->type_version === 'mineure';
    }

    public function estVersionCorrective()
    {
        return $this->type_version === 'corrective';
    }

    public function estHotfix()
    {
        return $this->type_version === 'hotfix';
    }

    public function estActif()
    {
        return $this->statut === 'actif';
    }

    public function estEnPreparation()
    {
        return $this->statut === 'en_preparation';
    }

    public function estDeploie()
    {
        return $this->statut === 'deploie';
    }

    public function estGele()
    {
        return $this->statut === 'gele';
    }

    public function estArchive()
    {
        return $this->statut === 'archive';
    }
}
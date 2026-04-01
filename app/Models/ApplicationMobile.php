<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationMobile extends Model
{
    use HasFactory;

    protected $table = 'applications_mobiles';

    protected $fillable = [
        'auteur_id',
        'responsable_id',
        'titre',
        'slug',
        'description',
        'plateforme',
        'stack_mobile',
        'lien_demo',
        'version',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function estAndroid()
    {
        return $this->plateforme === 'android';
    }

    public function estIos()
    {
        return $this->plateforme === 'ios';
    }

    public function estHybride()
    {
        return $this->plateforme === 'hybride';
    }

    public function estPwa()
    {
        return $this->plateforme === 'pwa';
    }

    public function estEnConception()
    {
        return $this->statut === 'conception';
    }

    public function estEnDeveloppement()
    {
        return $this->statut === 'en_developpement';
    }

    public function estEnTest()
    {
        return $this->statut === 'en_test';
    }

    public function estPubliee()
    {
        return $this->statut === 'publiee';
    }

    public function estSuspendue()
    {
        return $this->statut === 'suspendue';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }
}
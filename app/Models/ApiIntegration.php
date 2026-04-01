<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiIntegration extends Model
{
    use HasFactory;

    protected $table = 'apis_integrations';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'description',
        'type_api',
        'methode_authentification',
        'url_base',
        'documentation_url',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estRest()
    {
        return $this->type_api === 'rest';
    }

    public function estGraphql()
    {
        return $this->type_api === 'graphql';
    }

    public function estWebhook()
    {
        return $this->type_api === 'webhook';
    }

    public function estSdk()
    {
        return $this->type_api === 'sdk';
    }

    public function estAutre()
    {
        return $this->type_api === 'autre';
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

    public function estActive()
    {
        return $this->statut === 'active';
    }

    public function estInactive()
    {
        return $this->statut === 'inactive';
    }

    public function estArchivee()
    {
        return $this->statut === 'archivee';
    }
}

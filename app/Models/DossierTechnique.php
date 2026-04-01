<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DossierTechnique extends Model
{
    use HasFactory;

    protected $table = 'dossiers_techniques';

    protected $fillable = [
        'auteur_id',
        'titre',
        'slug',
        'resume',
        'document_principal',
        'version',
        'type_dossier',
        'statut',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    public function estPublie()
    {
        return $this->statut === 'publie';
    }

    public function estArchive()
    {
        return $this->statut === 'archive';
    }

    public function estSpecification()
    {
        return $this->type_dossier === 'specification';
    }

    public function estDocumentation()
    {
        return $this->type_dossier === 'documentation';
    }

    public function estProcedure()
    {
        return $this->type_dossier === 'procedure';
    }

    public function estManuel()
    {
        return $this->type_dossier === 'manuel';
    }

    public function estAnalyse()
    {
        return $this->type_dossier === 'analyse';
    }
}
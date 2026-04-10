<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\MembreEquipe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SiteVitrine;
use App\Models\ApplicationWeb;
use App\Models\ApplicationMobile;
use App\Models\ApiIntegration;
use App\Models\MaintenanceTechnique;
use App\Models\TestTechnique;
use App\Models\DepotVersion;
use App\Models\IdeeIngenieurie;
use App\Models\ReflexionStrategique;
use App\Models\ArchitectureTechnique;
use App\Models\EtudeFaisabilite;
use App\Models\PrototypeIngenieurie;
use App\Models\DossierTechnique;
use App\Models\CreationGraphique;
use App\Models\Formation\Enseignant;
use App\Models\Formation\Progression;
use App\Models\Formation\Inscription;
use App\Models\Formation\Cour;
use App\Models\Media;
use App\Models\CampagneMarketing;
use App\Models\PositionnementMarketing;
use App\Models\ImageMarque;
use App\Models\AcquisitionMarketing;
use App\Models\CroissanceMarketing;
use App\Models\TableauPerformanceMarketing;
use App\Models\ProductionVideo;
use App\Models\ProductionAudio;
use App\Models\DiffusionStudio;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Formation\SoumissionDevoir;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Les attributs assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'photo',
        'statut_compte',
        'est_actif',
        'dernier_acces',
        'bio',
        'is_enseignant'
    ];

    /**
     * Les attributs masqués.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les conversions automatiques.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'est_actif' => 'boolean',
            'dernier_acces' => 'datetime',
            'is_enseignant' => 'boolean',
        ];
    }

    // ===============================
    // MÉTHODES DE VÉRIFICATION DE RÔLES
    // ===============================

    public function estAdministrateur()
    {
        return $this->hasRole('administrateur');
    }

    public function estAuteur()
    {
        return $this->hasRole('auteur');
    }

    public function estResponsable()
    {
        return $this->hasRole('responsable');
    }

    // ===============================
    // RELATIONS PRINCIPALES
    // ===============================

    public function membreEquipe()
    {
        return $this->hasOne(MembreEquipe::class, 'user_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'user_id');
    }

    // ===============================
    // RELATIONS FORMATION
    // ===============================

    /**
     * Relation avec l'enseignant (profil formateur)
     */
    public function enseignant()
    {
        return $this->hasOne(Enseignant::class, 'user_id');
    }

    /**
     * Relation avec les progressions de formation
     */
    public function progressions()
    {
        return $this->hasMany(Progression::class, 'user_id');
    }

    /**
     * Relation avec les inscriptions
     */
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'user_id');
    }

    /**
     * Relation avec les cours suivis
     */
    public function coursSuivis()
    {
        return $this->belongsToMany(Cour::class, 'cours_utilisateur', 'user_id', 'cour_id')
                    ->withPivot('termine', 'progression', 'dernier_acces')
                    ->withTimestamps();
    }

    /**
     * Vérifier si l'utilisateur est un enseignant
     */
    public function isEnseignant()
    {
        return $this->enseignant !== null;
    }

    // ===============================
    // RELATIONS CHAMBRE INGÉNIEURS
    // ===============================

    public function ideesIngenieurie()
    {
        return $this->hasMany(IdeeIngenieurie::class, 'auteur_id');
    }
public function soumissionsDevoirs()
{
    return $this->hasMany(\App\Models\Formation\SoumissionDevoir::class, 'user_id');
}
    public function ideesIngenieurieResponsables()
    {
        return $this->hasMany(IdeeIngenieurie::class, 'responsable_id');
    }

    public function reflexionsStrategiques()
    {
        return $this->hasMany(ReflexionStrategique::class, 'auteur_id');
    }

    public function architecturesTechniques()
    {
        return $this->hasMany(ArchitectureTechnique::class, 'auteur_id');
    }

    public function etudesFaisabilite()
    {
        return $this->hasMany(EtudeFaisabilite::class, 'auteur_id');
    }

    public function prototypesIngenieurie()
    {
        return $this->hasMany(PrototypeIngenieurie::class, 'auteur_id');
    }

    public function dossiersTechniques()
    {
        return $this->hasMany(DossierTechnique::class, 'auteur_id');
    }

    // ===============================
    // RELATIONS CHAMBRE DÉVELOPPEMENT
    // ===============================

    public function applicationsWeb()
    {
        return $this->hasMany(ApplicationWeb::class, 'auteur_id');
    }

    public function applicationsWebResponsables()
    {
        return $this->hasMany(ApplicationWeb::class, 'responsable_id');
    }

    public function applicationsMobiles()
    {
        return $this->hasMany(ApplicationMobile::class, 'auteur_id');
    }

    public function applicationsMobilesResponsables()
    {
        return $this->hasMany(ApplicationMobile::class, 'responsable_id');
    }

    public function sitesVitrines()
    {
        return $this->hasMany(SiteVitrine::class, 'auteur_id');
    }

    public function apisIntegrations()
    {
        return $this->hasMany(ApiIntegration::class, 'auteur_id');
    }

    public function maintenancesTechniques()
    {
        return $this->hasMany(MaintenanceTechnique::class, 'auteur_id');
    }

    public function maintenancesTechniquesResponsables()
    {
        return $this->hasMany(MaintenanceTechnique::class, 'responsable_id');
    }

    public function testsTechniques()
    {
        return $this->hasMany(TestTechnique::class, 'auteur_id');
    }

    public function depotsVersions()
    {
        return $this->hasMany(DepotVersion::class, 'auteur_id');
    }

    // ===============================
    // RELATIONS CHAMBRE MARKETING
    // ===============================

    public function campagnesMarketing()
    {
        return $this->hasMany(CampagneMarketing::class, 'auteur_id');
    }

    public function campagnesMarketingResponsables()
    {
        return $this->hasMany(CampagneMarketing::class, 'responsable_id');
    }

    public function positionnementsMarketing()
    {
        return $this->hasMany(PositionnementMarketing::class, 'auteur_id');
    }

    public function imagesMarque()
    {
        return $this->hasMany(ImageMarque::class, 'auteur_id');
    }

    public function acquisitionsMarketing()
    {
        return $this->hasMany(AcquisitionMarketing::class, 'auteur_id');
    }

    public function croissancesMarketing()
    {
        return $this->hasMany(CroissanceMarketing::class, 'auteur_id');
    }

    public function croissancesMarketingResponsables()
    {
        return $this->hasMany(CroissanceMarketing::class, 'responsable_id');
    }

    public function tableauxPerformanceMarketing()
    {
        return $this->hasMany(TableauPerformanceMarketing::class, 'auteur_id');
    }

    // ===============================
    // RELATIONS CHAMBRE STUDIO
    // ===============================

    /**
     * Vidéos créées
     */
    public function productionsVideo()
    {
        return $this->hasMany(ProductionVideo::class, 'auteur_id');
    }

    /**
     * Audios créés
     */
    public function productionsAudio()
    {
        return $this->hasMany(ProductionAudio::class, 'auteur_id');
    }

    /**
     * Diffusions gérées
     */
    public function diffusions()
    {
        return $this->hasMany(DiffusionStudio::class, 'responsable_id');
    }

    // ===============================
    // RELATIONS CHAMBRE GRAPHISME
    // ===============================

    public function creationsGraphiques()
    {
        return $this->hasMany(CreationGraphique::class, 'auteur_id');
    }
}

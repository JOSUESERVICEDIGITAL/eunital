<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Back\Contenu\ArticleController;
use App\Http\Controllers\Back\Contenu\CategorieController;
use App\Http\Controllers\Back\Contenu\CommentaireController;
use App\Http\Controllers\Back\Contenu\EtiquetteController;

use App\Http\Controllers\Back\Utilisateur\UtilisateurController;
use App\Http\Controllers\Back\Utilisateur\RoleController;
use App\Http\Controllers\Back\Utilisateur\PermissionController;
use App\Http\Controllers\Back\Utilisateur\AttributionRoleController;

use App\Http\Controllers\Back\Equipe\MembreEquipeController;
use App\Http\Controllers\Back\Equipe\DepartementController;
use App\Http\Controllers\Back\Equipe\PosteController;
use App\Http\Controllers\Back\Equipe\MessageInterneController;

use App\Http\Controllers\Back\Media\MediaController;
use App\Http\Controllers\Back\Media\CategorieMediaController;
use App\Http\Controllers\Back\Media\LienSocialController;

use App\Http\Controllers\Back\ChambreIngenieur\IdeeIngenieurieController;
use App\Http\Controllers\Back\ChambreIngenieur\ReflexionStrategiqueController;
use App\Http\Controllers\Back\ChambreIngenieur\ArchitectureTechniqueController;
use App\Http\Controllers\Back\ChambreIngenieur\EtudeFaisabiliteController;
use App\Http\Controllers\Back\ChambreIngenieur\PrototypeIngenieurieController;
use App\Http\Controllers\Back\ChambreIngenieur\DossierTechniqueController;


use App\Http\Controllers\Back\ChambreDeveloppement\ApplicationWebController;
use App\Http\Controllers\Back\ChambreDeveloppement\ApplicationMobileController;
use App\Http\Controllers\Back\ChambreDeveloppement\SiteVitrineController;
use App\Http\Controllers\Back\ChambreDeveloppement\ApiIntegrationController;
use App\Http\Controllers\Back\ChambreDeveloppement\MaintenanceTechniqueController;
use App\Http\Controllers\Back\ChambreDeveloppement\TestTechniqueController;
use App\Http\Controllers\Back\ChambreDeveloppement\DepotVersionController;


use App\Http\Controllers\Back\ChambreMarketing\CampagneMarketingController;
use App\Http\Controllers\Back\ChambreMarketing\PositionnementMarketingController;
use App\Http\Controllers\Back\ChambreMarketing\ImageMarqueController;
use App\Http\Controllers\Back\ChambreMarketing\AcquisitionMarketingController;
use App\Http\Controllers\Back\ChambreMarketing\CroissanceMarketingController;
use App\Http\Controllers\Back\ChambreMarketing\TableauPerformanceMarketingController;


use App\Http\Controllers\Back\ChambreStudio\ProductionAudioController;
use App\Http\Controllers\Back\ChambreStudio\ProductionVideoController;
use App\Http\Controllers\Back\ChambreStudio\MontageStudioController;
use App\Http\Controllers\Back\ChambreStudio\CaptationStudioController;
use App\Http\Controllers\Back\ChambreStudio\HabillageSonoreController;
use App\Http\Controllers\Back\ChambreStudio\DiffusionStudioController;
use App\Http\Controllers\Back\ChambreStudio\ClientStudioController;
use App\Http\Controllers\Back\ChambreStudio\CommandeStudioController;
use App\Http\Controllers\Back\ChambreStudio\ReservationStudioController;
use App\Http\Controllers\Back\ChambreStudio\EquipementStudioController;
use App\Http\Controllers\Back\ChambreStudio\ProjetStudioController;
use App\Http\Controllers\Back\ChambreStudio\EvenementStudioController;




use App\Http\Controllers\Back\ChambreGraphisme\AfficheFlyerController;
use App\Http\Controllers\Back\ChambreGraphisme\CreationGraphiqueController;
use App\Http\Controllers\Back\ChambreGraphisme\DemandeClientGraphismeController;
use App\Http\Controllers\Back\ChambreGraphisme\GraphismeDashboardController;
use App\Http\Controllers\Back\ChambreGraphisme\IdentiteVisuelleController;
use App\Http\Controllers\Back\ChambreGraphisme\MaquetteGraphiqueController;
use App\Http\Controllers\Back\ChambreGraphisme\UiuxDesignController;
use App\Http\Controllers\Back\ChambreGraphisme\VisuelReseauSocialController;


use App\Http\Controllers\Back\ChambreJuridique\ArchiveHubController;
use App\Http\Controllers\Back\ChambreJuridique\ContratJuridiqueController;
use App\Http\Controllers\Back\ChambreJuridique\DocumentJuridiqueController;
use App\Http\Controllers\Back\ChambreJuridique\DossierJuridiqueController;
use App\Http\Controllers\Back\ChambreJuridique\EngagementJuridiqueController;
use App\Http\Controllers\Back\ChambreJuridique\JuridiqueDashboardController;
use App\Http\Controllers\Back\ChambreJuridique\ModeleDocumentJuridiqueController;
use App\Http\Controllers\Back\ChambreJuridique\PieceJointeJuridiqueController;


use App\Http\Controllers\Back\Formation\{
    DashboardFormationController,
    CategorieModuleController,
    ModuleController,
    CourController,
    ChapitreController,
    ContenuController,
    InscriptionController,
    PresenceController,
    AccesSalleController,
    DevoirController,
    SoumissionDevoirController,
    CommentaireCoursController,
    ProgressionController,
    NotificationController,
    ExportFormationController
};




Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('back.dashboard');
    })->name('back.dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('back')->name('back.')->middleware(['auth'])->group(function () {

    // articles
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/tableau-de-bord', [ArticleController::class, 'tableauDeBord'])->name('tableau_de_bord');
        Route::get('/', [ArticleController::class, 'listeTous'])->name('tous');
        Route::get('/publies', [ArticleController::class, 'listePublies'])->name('publies');
        Route::get('/brouillons', [ArticleController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/archives', [ArticleController::class, 'listeArchives'])->name('archives');

        Route::get('/creer', [ArticleController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ArticleController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{article}', [ArticleController::class, 'details'])->name('details');
        Route::get('/{article}/modifier', [ArticleController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{article}/mettre-a-jour', [ArticleController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{article}/publier', [ArticleController::class, 'publier'])->name('publier');
        Route::patch('/{article}/mettre-en-brouillon', [ArticleController::class, 'mettreEnBrouillon'])->name('mettre_en_brouillon');
        Route::patch('/{article}/archiver', [ArticleController::class, 'archiver'])->name('archiver');

        Route::patch('/{article}/mettre-en-avant', [ArticleController::class, 'mettreEnAvant'])->name('mettre_en_avant');
        Route::patch('/{article}/retirer-mise-en-avant', [ArticleController::class, 'retirerDeLaMiseEnAvant'])->name('retirer_mise_en_avant');

        Route::patch('/{article}/activer-commentaires', [ArticleController::class, 'activerCommentaires'])->name('activer_commentaires');
        Route::patch('/{article}/desactiver-commentaires', [ArticleController::class, 'desactiverCommentaires'])->name('desactiver_commentaires');

        Route::delete('/{article}/supprimer-image', [ArticleController::class, 'supprimerImagePrincipale'])->name('supprimer_image');
        Route::delete('/{article}/supprimer', [ArticleController::class, 'supprimer'])->name('supprimer');
    });

    // categories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategorieController::class, 'listeToutes'])->name('toutes');
        Route::get('/actives', [CategorieController::class, 'listeActives'])->name('actives');
        Route::get('/inactives', [CategorieController::class, 'listeInactives'])->name('inactives');
        Route::get('/sous-categories', [CategorieController::class, 'listeSousCategories'])->name('sous_categories');

        Route::get('/creer', [CategorieController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CategorieController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{categorie}', [CategorieController::class, 'details'])->name('details');
        Route::get('/{categorie}/modifier', [CategorieController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{categorie}/mettre-a-jour', [CategorieController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{categorie}/activer', [CategorieController::class, 'activer'])->name('activer');
        Route::patch('/{categorie}/desactiver', [CategorieController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{categorie}/supprimer', [CategorieController::class, 'supprimer'])->name('supprimer');
    });

    // etiquettes
    Route::prefix('etiquettes')->name('etiquettes.')->group(function () {
        Route::get('/', [EtiquetteController::class, 'listeToutes'])->name('toutes');

        Route::get('/creer', [EtiquetteController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [EtiquetteController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{etiquette}', [EtiquetteController::class, 'details'])->name('details');
        Route::get('/{etiquette}/modifier', [EtiquetteController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{etiquette}/mettre-a-jour', [EtiquetteController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::delete('/{etiquette}/supprimer', [EtiquetteController::class, 'supprimer'])->name('supprimer');
    });

    // commentaires
    Route::prefix('commentaires')->name('commentaires.')->group(function () {
        Route::get('/', [CommentaireController::class, 'listeTous'])->name('tous');
        Route::get('/en-attente', [CommentaireController::class, 'listeEnAttente'])->name('en_attente');
        Route::get('/valides', [CommentaireController::class, 'listeValides'])->name('valides');
        Route::get('/rejetes', [CommentaireController::class, 'listeRejetes'])->name('rejetes');

        Route::get('/{commentaire}', [CommentaireController::class, 'details'])->name('details');

        Route::patch('/{commentaire}/valider', [CommentaireController::class, 'valider'])->name('valider');
        Route::patch('/{commentaire}/rejeter', [CommentaireController::class, 'rejeter'])->name('rejeter');
        Route::patch('/{commentaire}/remettre-en-attente', [CommentaireController::class, 'remettreEnAttente'])->name('remettre_en_attente');

        Route::delete('/{commentaire}/supprimer', [CommentaireController::class, 'supprimer'])->name('supprimer');
    });



    /*
        |--------------------------------------------------------------------------
        | UTILISATEURS
        |--------------------------------------------------------------------------
        */
    Route::prefix('utilisateurs')->name('utilisateurs.')->group(function () {

        Route::get('/', [UtilisateurController::class, 'listeTous'])->name('tous');

        Route::get('/administrateurs', [UtilisateurController::class, 'listeAdministrateurs'])->name('administrateurs');
        Route::get('/auteurs', [UtilisateurController::class, 'listeAuteurs'])->name('auteurs');
        Route::get('/responsables', [UtilisateurController::class, 'listeResponsables'])->name('responsables');
        Route::get('/desactives', [UtilisateurController::class, 'listeDesactives'])->name('desactives');

        Route::get('/creer', [UtilisateurController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [UtilisateurController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{utilisateur}', [UtilisateurController::class, 'details'])->name('details');
        Route::get('/{utilisateur}/modifier', [UtilisateurController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{utilisateur}/mettre-a-jour', [UtilisateurController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{utilisateur}/activer', [UtilisateurController::class, 'activer'])->name('activer');
        Route::patch('/{utilisateur}/desactiver', [UtilisateurController::class, 'desactiver'])->name('desactiver');
        Route::patch('/{utilisateur}/suspendre', [UtilisateurController::class, 'suspendre'])->name('suspendre');
        Route::patch('/{utilisateur}/retablir', [UtilisateurController::class, 'retablir'])->name('retablir');

        Route::delete('/{utilisateur}/supprimer', [UtilisateurController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLES
    |--------------------------------------------------------------------------
    */
    Route::prefix('roles')->name('roles.')->group(function () {

        Route::get('/', [RoleController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [RoleController::class, 'listeActifs'])->name('actifs');
        Route::get('/inactifs', [RoleController::class, 'listeInactifs'])->name('inactifs');

        Route::get('/creer', [RoleController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [RoleController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{role}', [RoleController::class, 'details'])->name('details');
        Route::get('/{role}/modifier', [RoleController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{role}/mettre-a-jour', [RoleController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{role}/activer', [RoleController::class, 'activer'])->name('activer');
        Route::patch('/{role}/desactiver', [RoleController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{role}/supprimer', [RoleController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | PERMISSIONS
    |--------------------------------------------------------------------------
    */
    Route::prefix('permissions')->name('permissions.')->group(function () {

        Route::get('/', [PermissionController::class, 'listeToutes'])->name('toutes');
        Route::get('/groupe/{groupe}', [PermissionController::class, 'listeParGroupe'])->name('par_groupe');

        Route::get('/creer', [PermissionController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [PermissionController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{permission}', [PermissionController::class, 'details'])->name('details');
        Route::get('/{permission}/modifier', [PermissionController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{permission}/mettre-a-jour', [PermissionController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::delete('/{permission}/supprimer', [PermissionController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTIONS (ROLES & PERMISSIONS)
    |--------------------------------------------------------------------------
    */
    Route::prefix('attributions')->name('attributions.')->group(function () {

        // rôles utilisateur
        Route::get('/utilisateurs/{utilisateur}/roles', [AttributionRoleController::class, 'formulaireAttributionUtilisateur'])
            ->name('utilisateur.roles');

        Route::put('/utilisateurs/{utilisateur}/attribuer-roles', [AttributionRoleController::class, 'attribuerRolesUtilisateur'])
            ->name('utilisateur.attribuer_roles');

        Route::delete('/utilisateurs/{utilisateur}/roles/{role}/retirer', [AttributionRoleController::class, 'retirerRoleUtilisateur'])
            ->name('utilisateur.retirer_role');

        // permissions rôle
        Route::get('/roles/{role}/permissions', [AttributionRoleController::class, 'formulairePermissionsRole'])
            ->name('role.permissions');

        Route::put('/roles/{role}/attribuer-permissions', [AttributionRoleController::class, 'attribuerPermissionsRole'])
            ->name('role.attribuer_permissions');

        Route::delete('/roles/{role}/permissions/{permission}/retirer', [AttributionRoleController::class, 'retirerPermissionRole'])
            ->name('role.retirer_permission');
    });





    /*
       |--------------------------------------------------------------------------
       | ÉQUIPE - MEMBRES
       |--------------------------------------------------------------------------
       */
    Route::prefix('equipe/membres')->name('equipe.membres.')->group(function () {
        Route::get('/', [MembreEquipeController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [MembreEquipeController::class, 'listeActifs'])->name('actifs');
        Route::get('/inactifs', [MembreEquipeController::class, 'listeInactifs'])->name('inactifs');
        Route::get('/en-pause', [MembreEquipeController::class, 'listeEnPause'])->name('en_pause');
        Route::get('/organigramme', [MembreEquipeController::class, 'organigramme'])->name('organigramme');
        Route::get('/departement/{departement}', [MembreEquipeController::class, 'listeParDepartement'])->name('par_departement');

        Route::get('/creer', [MembreEquipeController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MembreEquipeController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{membreEquipe}', [MembreEquipeController::class, 'details'])->name('details');
        Route::get('/{membreEquipe}/modifier', [MembreEquipeController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{membreEquipe}/mettre-a-jour', [MembreEquipeController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{membreEquipe}/activer', [MembreEquipeController::class, 'activer'])->name('activer');
        Route::patch('/{membreEquipe}/desactiver', [MembreEquipeController::class, 'desactiver'])->name('desactiver');
        Route::patch('/{membreEquipe}/mettre-en-pause', [MembreEquipeController::class, 'mettreEnPause'])->name('mettre_en_pause');

        Route::patch('/{membreEquipe}/afficher-dans-organigramme', [MembreEquipeController::class, 'afficherDansOrganigramme'])->name('afficher_dans_organigramme');
        Route::patch('/{membreEquipe}/masquer-de-organigramme', [MembreEquipeController::class, 'masquerDeOrganigramme'])->name('masquer_de_organigramme');

        Route::delete('/{membreEquipe}/supprimer-photo', [MembreEquipeController::class, 'supprimerPhoto'])->name('supprimer_photo');
        Route::delete('/{membreEquipe}/supprimer', [MembreEquipeController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | ÉQUIPE - DÉPARTEMENTS
    |--------------------------------------------------------------------------
    */
    Route::prefix('equipe/departements')->name('equipe.departements.')->group(function () {
        Route::get('/', [DepartementController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [DepartementController::class, 'listeActifs'])->name('actifs');
        Route::get('/inactifs', [DepartementController::class, 'listeInactifs'])->name('inactifs');

        Route::get('/creer', [DepartementController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DepartementController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{departement}', [DepartementController::class, 'details'])->name('details');
        Route::get('/{departement}/modifier', [DepartementController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{departement}/mettre-a-jour', [DepartementController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{departement}/activer', [DepartementController::class, 'activer'])->name('activer');
        Route::patch('/{departement}/desactiver', [DepartementController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{departement}/supprimer', [DepartementController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | ÉQUIPE - POSTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('equipe/postes')->name('equipe.postes.')->group(function () {
        Route::get('/', [PosteController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [PosteController::class, 'listeActifs'])->name('actifs');
        Route::get('/inactifs', [PosteController::class, 'listeInactifs'])->name('inactifs');

        Route::get('/creer', [PosteController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [PosteController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{poste}', [PosteController::class, 'details'])->name('details');
        Route::get('/{poste}/modifier', [PosteController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{poste}/mettre-a-jour', [PosteController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{poste}/activer', [PosteController::class, 'activer'])->name('activer');
        Route::patch('/{poste}/desactiver', [PosteController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{poste}/supprimer', [PosteController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | ÉQUIPE - MESSAGES INTERNES
    |--------------------------------------------------------------------------
    */
    Route::prefix('equipe/messages')->name('equipe.messages.')->group(function () {
        Route::get('/', [MessageInterneController::class, 'listeTous'])->name('tous');
        Route::get('/recus', [MessageInterneController::class, 'listeRecus'])->name('recus');
        Route::get('/envoyes', [MessageInterneController::class, 'listeEnvoyes'])->name('envoyes');
        Route::get('/annonces', [MessageInterneController::class, 'listeAnnonces'])->name('annonces');

        Route::get('/creer', [MessageInterneController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MessageInterneController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{messageInterne}', [MessageInterneController::class, 'details'])->name('details');
        Route::get('/{messageInterne}/modifier', [MessageInterneController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{messageInterne}/mettre-a-jour', [MessageInterneController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{messageInterne}/marquer-comme-lu', [MessageInterneController::class, 'marquerCommeLu'])->name('marquer_comme_lu');
        Route::patch('/{messageInterne}/marquer-comme-non-lu', [MessageInterneController::class, 'marquerCommeNonLu'])->name('marquer_comme_non_lu');

        Route::delete('/{messageInterne}/supprimer', [MessageInterneController::class, 'supprimer'])->name('supprimer');
    });


    /*
       |--------------------------------------------------------------------------
       | MÉDIAS - FICHIERS
       |--------------------------------------------------------------------------
       */
    Route::prefix('medias/fichiers')->name('medias.fichiers.')->group(function () {
        Route::get('/', [MediaController::class, 'bibliotheque'])->name('bibliotheque');
        Route::get('/images', [MediaController::class, 'listeImages'])->name('images');
        Route::get('/videos', [MediaController::class, 'listeVideos'])->name('videos');
        Route::get('/documents', [MediaController::class, 'listeDocuments'])->name('documents');
        Route::get('/en-avant', [MediaController::class, 'listeEnAvant'])->name('en_avant');

        Route::get('/creer', [MediaController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MediaController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{media}', [MediaController::class, 'details'])->name('details');
        Route::get('/{media}/modifier', [MediaController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{media}/mettre-a-jour', [MediaController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{media}/mettre-en-avant', [MediaController::class, 'mettreEnAvant'])->name('mettre_en_avant');
        Route::patch('/{media}/retirer-mise-en-avant', [MediaController::class, 'retirerDeLaMiseEnAvant'])->name('retirer_mise_en_avant');

        Route::patch('/{media}/rendre-public', [MediaController::class, 'rendrePublic'])->name('rendre_public');
        Route::patch('/{media}/rendre-prive', [MediaController::class, 'rendrePrive'])->name('rendre_prive');

        Route::delete('/{media}/supprimer-fichier', [MediaController::class, 'supprimerFichier'])->name('supprimer_fichier');
        Route::delete('/{media}/supprimer-miniature', [MediaController::class, 'supprimerMiniature'])->name('supprimer_miniature');
        Route::delete('/{media}/supprimer', [MediaController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | MÉDIAS - CATÉGORIES
    |--------------------------------------------------------------------------
    */
    Route::prefix('medias/categories')->name('medias.categories.')->group(function () {
        Route::get('/', [CategorieMediaController::class, 'listeToutes'])->name('toutes');
        Route::get('/actives', [CategorieMediaController::class, 'listeActives'])->name('actives');
        Route::get('/inactives', [CategorieMediaController::class, 'listeInactives'])->name('inactives');

        Route::get('/creer', [CategorieMediaController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CategorieMediaController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{categorieMedia}', [CategorieMediaController::class, 'details'])->name('details');
        Route::get('/{categorieMedia}/modifier', [CategorieMediaController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{categorieMedia}/mettre-a-jour', [CategorieMediaController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{categorieMedia}/activer', [CategorieMediaController::class, 'activer'])->name('activer');
        Route::patch('/{categorieMedia}/desactiver', [CategorieMediaController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{categorieMedia}/supprimer', [CategorieMediaController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | MÉDIAS - LIENS SOCIAUX
    |--------------------------------------------------------------------------
    */
    Route::prefix('medias/liens-sociaux')->name('medias.liens-sociaux.')->group(function () {
        Route::get('/', [LienSocialController::class, 'listeTous'])->name('tous');
        Route::get('/header', [LienSocialController::class, 'listeHeader'])->name('header');
        Route::get('/footer', [LienSocialController::class, 'listeFooter'])->name('footer');
        Route::get('/actifs', [LienSocialController::class, 'listeActifs'])->name('actifs');

        Route::get('/creer', [LienSocialController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [LienSocialController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{lienSocial}', [LienSocialController::class, 'details'])->name('details');
        Route::get('/{lienSocial}/modifier', [LienSocialController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{lienSocial}/mettre-a-jour', [LienSocialController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{lienSocial}/activer', [LienSocialController::class, 'activer'])->name('activer');
        Route::patch('/{lienSocial}/desactiver', [LienSocialController::class, 'desactiver'])->name('desactiver');
        Route::patch('/{lienSocial}/changer-ordre', [LienSocialController::class, 'changerOrdre'])->name('changer_ordre');

        Route::delete('/{lienSocial}/supprimer', [LienSocialController::class, 'supprimer'])->name('supprimer');
    });






    /*
     |--------------------------------------------------------------------------
     | CHAMBRE D’INGÉNIEURS - IDÉES ET PROPOSITIONS
     |--------------------------------------------------------------------------
     */
    Route::prefix('chambre-ingenieur/idees')->name('chambre-ingenieur.idees.')->group(function () {
        Route::get('/', [IdeeIngenieurieController::class, 'listeToutes'])->name('toutes');
        Route::get('/nouvelles', [IdeeIngenieurieController::class, 'listeNouvelles'])->name('nouvelles');
        Route::get('/en-etude', [IdeeIngenieurieController::class, 'listeEnEtude'])->name('en_etude');
        Route::get('/retenues', [IdeeIngenieurieController::class, 'listeRetenues'])->name('retenues');
        Route::get('/critiques', [IdeeIngenieurieController::class, 'listeCritiques'])->name('critiques');

        Route::get('/creer', [IdeeIngenieurieController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [IdeeIngenieurieController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{ideeIngenieurie}', [IdeeIngenieurieController::class, 'details'])->name('details');
        Route::get('/{ideeIngenieurie}/modifier', [IdeeIngenieurieController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{ideeIngenieurie}/mettre-a-jour', [IdeeIngenieurieController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{ideeIngenieurie}/mettre-en-etude', [IdeeIngenieurieController::class, 'mettreEnEtude'])->name('mettre_en_etude');
        Route::patch('/{ideeIngenieurie}/retenir', [IdeeIngenieurieController::class, 'retenir'])->name('retenir');
        Route::patch('/{ideeIngenieurie}/rejeter', [IdeeIngenieurieController::class, 'rejeter'])->name('rejeter');
        Route::patch('/{ideeIngenieurie}/marquer-comme-realisee', [IdeeIngenieurieController::class, 'marquerCommeRealisee'])->name('marquer_comme_realisee');
        Route::patch('/{ideeIngenieurie}/definir-priorite-critique', [IdeeIngenieurieController::class, 'definirPrioriteCritique'])->name('definir_priorite_critique');

        Route::delete('/{ideeIngenieurie}/supprimer', [IdeeIngenieurieController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE D’INGÉNIEURS - RÉFLEXIONS STRATÉGIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-ingenieur/reflexions')->name('chambre-ingenieur.reflexions.')->group(function () {
        Route::get('/', [ReflexionStrategiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/ouvertes', [ReflexionStrategiqueController::class, 'listeOuvertes'])->name('ouvertes');
        Route::get('/validees', [ReflexionStrategiqueController::class, 'listeValidees'])->name('validees');
        Route::get('/archivees', [ReflexionStrategiqueController::class, 'listeArchivees'])->name('archivees');

        Route::get('/creer', [ReflexionStrategiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ReflexionStrategiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{reflexionStrategique}', [ReflexionStrategiqueController::class, 'details'])->name('details');
        Route::get('/{reflexionStrategique}/modifier', [ReflexionStrategiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{reflexionStrategique}/mettre-a-jour', [ReflexionStrategiqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{reflexionStrategique}/valider', [ReflexionStrategiqueController::class, 'valider'])->name('valider');
        Route::patch('/{reflexionStrategique}/archiver', [ReflexionStrategiqueController::class, 'archiver'])->name('archiver');
        Route::patch('/{reflexionStrategique}/rouvrir', [ReflexionStrategiqueController::class, 'rouvrir'])->name('rouvrir');

        Route::delete('/{reflexionStrategique}/supprimer', [ReflexionStrategiqueController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE D’INGÉNIEURS - ARCHITECTURES TECHNIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-ingenieur/architectures')->name('chambre-ingenieur.architectures.')->group(function () {
        Route::get('/', [ArchitectureTechniqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/brouillons', [ArchitectureTechniqueController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/validees', [ArchitectureTechniqueController::class, 'listeValidees'])->name('validees');
        Route::get('/obsoletes', [ArchitectureTechniqueController::class, 'listeObsoletes'])->name('obsoletes');

        Route::get('/creer', [ArchitectureTechniqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ArchitectureTechniqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{architectureTechnique}', [ArchitectureTechniqueController::class, 'details'])->name('details');
        Route::get('/{architectureTechnique}/modifier', [ArchitectureTechniqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{architectureTechnique}/mettre-a-jour', [ArchitectureTechniqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{architectureTechnique}/valider', [ArchitectureTechniqueController::class, 'valider'])->name('valider');
        Route::patch('/{architectureTechnique}/rendre-obsolete', [ArchitectureTechniqueController::class, 'rendreObsolete'])->name('rendre_obsolete');
        Route::patch('/{architectureTechnique}/remettre-en-brouillon', [ArchitectureTechniqueController::class, 'remettreEnBrouillon'])->name('remettre_en_brouillon');

        Route::delete('/{architectureTechnique}/supprimer-diagramme', [ArchitectureTechniqueController::class, 'supprimerDiagramme'])->name('supprimer_diagramme');
        Route::delete('/{architectureTechnique}/supprimer', [ArchitectureTechniqueController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE D’INGÉNIEURS - ÉTUDES DE FAISABILITÉ
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-ingenieur/etudes')->name('chambre-ingenieur.etudes.')->group(function () {
        Route::get('/', [EtudeFaisabiliteController::class, 'listeToutes'])->name('toutes');
        Route::get('/favorables', [EtudeFaisabiliteController::class, 'listeFavorables'])->name('favorables');
        Route::get('/reservees', [EtudeFaisabiliteController::class, 'listeReservees'])->name('reservees');
        Route::get('/defavorables', [EtudeFaisabiliteController::class, 'listeDefavorables'])->name('defavorables');

        Route::get('/creer', [EtudeFaisabiliteController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [EtudeFaisabiliteController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{etudeFaisabilite}', [EtudeFaisabiliteController::class, 'details'])->name('details');
        Route::get('/{etudeFaisabilite}/modifier', [EtudeFaisabiliteController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{etudeFaisabilite}/mettre-a-jour', [EtudeFaisabiliteController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{etudeFaisabilite}/rendre-favorable', [EtudeFaisabiliteController::class, 'rendreFavorable'])->name('rendre_favorable');
        Route::patch('/{etudeFaisabilite}/rendre-reservee', [EtudeFaisabiliteController::class, 'rendreReservee'])->name('rendre_reservee');
        Route::patch('/{etudeFaisabilite}/rendre-defavorable', [EtudeFaisabiliteController::class, 'rendreDefavorable'])->name('rendre_defavorable');

        Route::delete('/{etudeFaisabilite}/supprimer', [EtudeFaisabiliteController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE D’INGÉNIEURS - PROTOTYPES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-ingenieur/prototypes')->name('chambre-ingenieur.prototypes.')->group(function () {
        Route::get('/', [PrototypeIngenieurieController::class, 'listeTous'])->name('tous');
        Route::get('/en-cours', [PrototypeIngenieurieController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/termines', [PrototypeIngenieurieController::class, 'listeTermines'])->name('termines');
        Route::get('/abandonnes', [PrototypeIngenieurieController::class, 'listeAbandonnes'])->name('abandonnes');

        Route::get('/creer', [PrototypeIngenieurieController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [PrototypeIngenieurieController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{prototypeIngenieurie}', [PrototypeIngenieurieController::class, 'details'])->name('details');
        Route::get('/{prototypeIngenieurie}/modifier', [PrototypeIngenieurieController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{prototypeIngenieurie}/mettre-a-jour', [PrototypeIngenieurieController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{prototypeIngenieurie}/terminer', [PrototypeIngenieurieController::class, 'terminer'])->name('terminer');
        Route::patch('/{prototypeIngenieurie}/abandonner', [PrototypeIngenieurieController::class, 'abandonner'])->name('abandonner');
        Route::patch('/{prototypeIngenieurie}/relancer', [PrototypeIngenieurieController::class, 'relancer'])->name('relancer');

        Route::delete('/{prototypeIngenieurie}/supprimer-capture', [PrototypeIngenieurieController::class, 'supprimerCapture'])->name('supprimer_capture');
        Route::delete('/{prototypeIngenieurie}/supprimer', [PrototypeIngenieurieController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE D’INGÉNIEURS - DOSSIERS TECHNIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-ingenieur/dossiers')->name('chambre-ingenieur.dossiers.')->group(function () {
        Route::get('/', [DossierTechniqueController::class, 'listeTous'])->name('tous');
        Route::get('/brouillons', [DossierTechniqueController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/publies', [DossierTechniqueController::class, 'listePublies'])->name('publies');
        Route::get('/archives', [DossierTechniqueController::class, 'listeArchives'])->name('archives');

        Route::get('/creer', [DossierTechniqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DossierTechniqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{dossierTechnique}', [DossierTechniqueController::class, 'details'])->name('details');
        Route::get('/{dossierTechnique}/modifier', [DossierTechniqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{dossierTechnique}/mettre-a-jour', [DossierTechniqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{dossierTechnique}/publier', [DossierTechniqueController::class, 'publier'])->name('publier');
        Route::patch('/{dossierTechnique}/archiver', [DossierTechniqueController::class, 'archiver'])->name('archiver');
        Route::patch('/{dossierTechnique}/remettre-en-brouillon', [DossierTechniqueController::class, 'remettreEnBrouillon'])->name('remettre_en_brouillon');

        Route::delete('/{dossierTechnique}/supprimer-document-principal', [DossierTechniqueController::class, 'supprimerDocumentPrincipal'])->name('supprimer_document_principal');
        Route::delete('/{dossierTechnique}/supprimer', [DossierTechniqueController::class, 'supprimer'])->name('supprimer');
    });


    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - APPLICATIONS WEB
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/applications-web')->name('chambre-developpement.applications-web.')->group(function () {
        Route::get('/', [ApplicationWebController::class, 'listeToutes'])->name('toutes');
        Route::get('/conception', [ApplicationWebController::class, 'listeEnConception'])->name('conception');
        Route::get('/developpement', [ApplicationWebController::class, 'listeEnDeveloppement'])->name('developpement');
        Route::get('/tests', [ApplicationWebController::class, 'listeEnTest'])->name('tests');
        Route::get('/en-ligne', [ApplicationWebController::class, 'listeEnLigne'])->name('en_ligne');
        Route::get('/critiques', [ApplicationWebController::class, 'listeCritiques'])->name('critiques');

        Route::get('/creer', [ApplicationWebController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ApplicationWebController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{applicationWeb}', [ApplicationWebController::class, 'details'])->name('details');
        Route::get('/{applicationWeb}/modifier', [ApplicationWebController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{applicationWeb}/mettre-a-jour', [ApplicationWebController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{applicationWeb}/passer-en-developpement', [ApplicationWebController::class, 'passerEnDeveloppement'])->name('passer_en_developpement');
        Route::patch('/{applicationWeb}/passer-en-test', [ApplicationWebController::class, 'passerEnTest'])->name('passer_en_test');
        Route::patch('/{applicationWeb}/mettre-en-ligne', [ApplicationWebController::class, 'mettreEnLigne'])->name('mettre_en_ligne');
        Route::patch('/{applicationWeb}/suspendre', [ApplicationWebController::class, 'suspendre'])->name('suspendre');
        Route::patch('/{applicationWeb}/archiver', [ApplicationWebController::class, 'archiver'])->name('archiver');
        Route::patch('/{applicationWeb}/definir-priorite-critique', [ApplicationWebController::class, 'definirPrioriteCritique'])->name('definir_priorite_critique');

        Route::delete('/{applicationWeb}/supprimer', [ApplicationWebController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - APPLICATIONS MOBILES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/applications-mobiles')->name('chambre-developpement.applications-mobiles.')->group(function () {
        Route::get('/', [ApplicationMobileController::class, 'listeToutes'])->name('toutes');
        Route::get('/android', [ApplicationMobileController::class, 'listeAndroid'])->name('android');
        Route::get('/ios', [ApplicationMobileController::class, 'listeIos'])->name('ios');
        Route::get('/hybrides', [ApplicationMobileController::class, 'listeHybrides'])->name('hybrides');
        Route::get('/publiees', [ApplicationMobileController::class, 'listePubliees'])->name('publiees');

        Route::get('/creer', [ApplicationMobileController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ApplicationMobileController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{applicationMobile}', [ApplicationMobileController::class, 'details'])->name('details');
        Route::get('/{applicationMobile}/modifier', [ApplicationMobileController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{applicationMobile}/mettre-a-jour', [ApplicationMobileController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{applicationMobile}/passer-en-developpement', [ApplicationMobileController::class, 'passerEnDeveloppement'])->name('passer_en_developpement');
        Route::patch('/{applicationMobile}/passer-en-test', [ApplicationMobileController::class, 'passerEnTest'])->name('passer_en_test');
        Route::patch('/{applicationMobile}/publier', [ApplicationMobileController::class, 'publier'])->name('publier');
        Route::patch('/{applicationMobile}/suspendre', [ApplicationMobileController::class, 'suspendre'])->name('suspendre');
        Route::patch('/{applicationMobile}/archiver', [ApplicationMobileController::class, 'archiver'])->name('archiver');

        Route::delete('/{applicationMobile}/supprimer', [ApplicationMobileController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - SITES VITRINES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/sites-vitrines')->name('chambre-developpement.sites-vitrines.')->group(function () {
        Route::get('/', [SiteVitrineController::class, 'listeTous'])->name('tous');
        Route::get('/maquettes', [SiteVitrineController::class, 'listeMaquettes'])->name('maquettes');
        Route::get('/developpement', [SiteVitrineController::class, 'listeEnDeveloppement'])->name('developpement');
        Route::get('/livres', [SiteVitrineController::class, 'listeLivres'])->name('livres');
        Route::get('/en-ligne', [SiteVitrineController::class, 'listeEnLigne'])->name('en_ligne');

        Route::get('/creer', [SiteVitrineController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [SiteVitrineController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{siteVitrine}', [SiteVitrineController::class, 'details'])->name('details');
        Route::get('/{siteVitrine}/modifier', [SiteVitrineController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{siteVitrine}/mettre-a-jour', [SiteVitrineController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{siteVitrine}/marquer-comme-livre', [SiteVitrineController::class, 'marquerCommeLivre'])->name('marquer_comme_livre');
        Route::patch('/{siteVitrine}/mettre-en-ligne', [SiteVitrineController::class, 'mettreEnLigne'])->name('mettre_en_ligne');
        Route::patch('/{siteVitrine}/archiver', [SiteVitrineController::class, 'archiver'])->name('archiver');

        Route::delete('/{siteVitrine}/supprimer', [SiteVitrineController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - API & INTÉGRATIONS
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/apis-integrations')->name('chambre-developpement.apis-integrations.')->group(function () {
        Route::get('/', [ApiIntegrationController::class, 'listeToutes'])->name('toutes');
        Route::get('/rest', [ApiIntegrationController::class, 'listeRest'])->name('rest');
        Route::get('/graphql', [ApiIntegrationController::class, 'listeGraphql'])->name('graphql');
        Route::get('/actives', [ApiIntegrationController::class, 'listeActives'])->name('actives');

        Route::get('/creer', [ApiIntegrationController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ApiIntegrationController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{apiIntegration}', [ApiIntegrationController::class, 'details'])->name('details');
        Route::get('/{apiIntegration}/modifier', [ApiIntegrationController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{apiIntegration}/mettre-a-jour', [ApiIntegrationController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{apiIntegration}/activer', [ApiIntegrationController::class, 'activer'])->name('activer');
        Route::patch('/{apiIntegration}/desactiver', [ApiIntegrationController::class, 'desactiver'])->name('desactiver');
        Route::patch('/{apiIntegration}/archiver', [ApiIntegrationController::class, 'archiver'])->name('archiver');

        Route::delete('/{apiIntegration}/supprimer', [ApiIntegrationController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - MAINTENANCE
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/maintenances')->name('chambre-developpement.maintenances.')->group(function () {
        Route::get('/', [MaintenanceTechniqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/ouvertes', [MaintenanceTechniqueController::class, 'listeOuvertes'])->name('ouvertes');
        Route::get('/en-cours', [MaintenanceTechniqueController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/critiques', [MaintenanceTechniqueController::class, 'listeCritiques'])->name('critiques');
        Route::get('/resolues', [MaintenanceTechniqueController::class, 'listeResolues'])->name('resolues');

        Route::get('/creer', [MaintenanceTechniqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MaintenanceTechniqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{maintenanceTechnique}', [MaintenanceTechniqueController::class, 'details'])->name('details');
        Route::get('/{maintenanceTechnique}/modifier', [MaintenanceTechniqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{maintenanceTechnique}/mettre-a-jour', [MaintenanceTechniqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{maintenanceTechnique}/prendre-en-charge', [MaintenanceTechniqueController::class, 'prendreEnCharge'])->name('prendre_en_charge');
        Route::patch('/{maintenanceTechnique}/marquer-comme-resolue', [MaintenanceTechniqueController::class, 'marquerCommeResolue'])->name('marquer_comme_resolue');
        Route::patch('/{maintenanceTechnique}/fermer', [MaintenanceTechniqueController::class, 'fermer'])->name('fermer');
        Route::patch('/{maintenanceTechnique}/reporter', [MaintenanceTechniqueController::class, 'reporter'])->name('reporter');
        Route::patch('/{maintenanceTechnique}/definir-urgence-critique', [MaintenanceTechniqueController::class, 'definirUrgenceCritique'])->name('definir_urgence_critique');

        Route::delete('/{maintenanceTechnique}/supprimer', [MaintenanceTechniqueController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - TESTS TECHNIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/tests-techniques')->name('chambre-developpement.tests-techniques.')->group(function () {
        Route::get('/', [TestTechniqueController::class, 'listeTous'])->name('tous');
        Route::get('/planifies', [TestTechniqueController::class, 'listePlanifies'])->name('planifies');
        Route::get('/en-cours', [TestTechniqueController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/reussis', [TestTechniqueController::class, 'listeReussis'])->name('reussis');
        Route::get('/echoues', [TestTechniqueController::class, 'listeEchoues'])->name('echoues');

        Route::get('/creer', [TestTechniqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [TestTechniqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{testTechnique}', [TestTechniqueController::class, 'details'])->name('details');
        Route::get('/{testTechnique}/modifier', [TestTechniqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{testTechnique}/mettre-a-jour', [TestTechniqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{testTechnique}/lancer', [TestTechniqueController::class, 'lancer'])->name('lancer');
        Route::patch('/{testTechnique}/marquer-reussi', [TestTechniqueController::class, 'marquerReussi'])->name('marquer_reussi');
        Route::patch('/{testTechnique}/marquer-echoue', [TestTechniqueController::class, 'marquerEchoue'])->name('marquer_echoue');
        Route::patch('/{testTechnique}/annuler', [TestTechniqueController::class, 'annuler'])->name('annuler');

        Route::delete('/{testTechnique}/supprimer', [TestTechniqueController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE DÉVELOPPEMENT - DÉPÔTS ET VERSIONS
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-developpement/depots-versions')->name('chambre-developpement.depots-versions.')->group(function () {
        Route::get('/', [DepotVersionController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [DepotVersionController::class, 'listeActifs'])->name('actifs');
        Route::get('/deployes', [DepotVersionController::class, 'listeDeployes'])->name('deployes');
        Route::get('/hotfix', [DepotVersionController::class, 'listeHotfix'])->name('hotfix');

        Route::get('/creer', [DepotVersionController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DepotVersionController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{depotVersion}', [DepotVersionController::class, 'details'])->name('details');
        Route::get('/{depotVersion}/modifier', [DepotVersionController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{depotVersion}/mettre-a-jour', [DepotVersionController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{depotVersion}/marquer-comme-deploie', [DepotVersionController::class, 'marquerCommeDeploie'])->name('marquer_comme_deploie');
        Route::patch('/{depotVersion}/geler', [DepotVersionController::class, 'geler'])->name('geler');
        Route::patch('/{depotVersion}/reactiver', [DepotVersionController::class, 'reactiver'])->name('reactiver');
        Route::patch('/{depotVersion}/archiver', [DepotVersionController::class, 'archiver'])->name('archiver');

        Route::delete('/{depotVersion}/supprimer', [DepotVersionController::class, 'supprimer'])->name('supprimer');
    });





    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - CAMPAGNES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/campagnes')->name('chambre-marketing.campagnes.')->group(function () {
        Route::get('/', [CampagneMarketingController::class, 'listeToutes'])->name('toutes');
        Route::get('/actives', [CampagneMarketingController::class, 'listeActives'])->name('actives');
        Route::get('/en-pause', [CampagneMarketingController::class, 'listeEnPause'])->name('en_pause');
        Route::get('/terminees', [CampagneMarketingController::class, 'listeTerminees'])->name('terminees');
        Route::get('/multi-reseaux', [CampagneMarketingController::class, 'listeMultiReseaux'])->name('multi_reseaux');

        Route::get('/creer', [CampagneMarketingController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CampagneMarketingController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{campagneMarketing}', [CampagneMarketingController::class, 'details'])->name('details');
        Route::get('/{campagneMarketing}/modifier', [CampagneMarketingController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{campagneMarketing}/mettre-a-jour', [CampagneMarketingController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{campagneMarketing}/activer', [CampagneMarketingController::class, 'activer'])->name('activer');
        Route::patch('/{campagneMarketing}/mettre-en-pause', [CampagneMarketingController::class, 'mettreEnPause'])->name('mettre_en_pause');
        Route::patch('/{campagneMarketing}/reprendre', [CampagneMarketingController::class, 'reprendre'])->name('reprendre');
        Route::patch('/{campagneMarketing}/terminer', [CampagneMarketingController::class, 'terminer'])->name('terminer');
        Route::patch('/{campagneMarketing}/archiver', [CampagneMarketingController::class, 'archiver'])->name('archiver');
        Route::patch('/{campagneMarketing}/augmenter-budget', [CampagneMarketingController::class, 'augmenterBudget'])->name('augmenter_budget');
        Route::patch('/{campagneMarketing}/diminuer-budget', [CampagneMarketingController::class, 'diminuerBudget'])->name('diminuer_budget');
        Route::post('/{campagneMarketing}/dupliquer', [CampagneMarketingController::class, 'dupliquer'])->name('dupliquer');

        Route::delete('/{campagneMarketing}/supprimer', [CampagneMarketingController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - POSITIONNEMENTS
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/positionnements')->name('chambre-marketing.positionnements.')->group(function () {
        Route::get('/', [PositionnementMarketingController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [PositionnementMarketingController::class, 'listeActifs'])->name('actifs');
        Route::get('/a-revoir', [PositionnementMarketingController::class, 'listeARevoir'])->name('a_revoir');

        Route::get('/creer', [PositionnementMarketingController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [PositionnementMarketingController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{positionnementMarketing}', [PositionnementMarketingController::class, 'details'])->name('details');
        Route::get('/{positionnementMarketing}/modifier', [PositionnementMarketingController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{positionnementMarketing}/mettre-a-jour', [PositionnementMarketingController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{positionnementMarketing}/activer', [PositionnementMarketingController::class, 'activer'])->name('activer');
        Route::patch('/{positionnementMarketing}/marquer-a-revoir', [PositionnementMarketingController::class, 'marquerARevoir'])->name('marquer_a_revoir');
        Route::patch('/{positionnementMarketing}/archiver', [PositionnementMarketingController::class, 'archiver'])->name('archiver');

        Route::delete('/{positionnementMarketing}/supprimer', [PositionnementMarketingController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - IMAGE DE MARQUE
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/images-marque')->name('chambre-marketing.images-marque.')->group(function () {
        Route::get('/', [ImageMarqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/actives', [ImageMarqueController::class, 'listeActives'])->name('actives');
        Route::get('/obsoletes', [ImageMarqueController::class, 'listeObsoletes'])->name('obsoletes');

        Route::get('/creer', [ImageMarqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ImageMarqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{imageMarque}', [ImageMarqueController::class, 'details'])->name('details');
        Route::get('/{imageMarque}/modifier', [ImageMarqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{imageMarque}/mettre-a-jour', [ImageMarqueController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{imageMarque}/activer', [ImageMarqueController::class, 'activer'])->name('activer');
        Route::patch('/{imageMarque}/marquer-obsolete', [ImageMarqueController::class, 'marquerObsolete'])->name('marquer_obsolete');
        Route::patch('/{imageMarque}/archiver', [ImageMarqueController::class, 'archiver'])->name('archiver');

        Route::delete('/{imageMarque}/supprimer', [ImageMarqueController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - ACQUISITIONS
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/acquisitions')->name('chambre-marketing.acquisitions.')->group(function () {
        Route::get('/', [AcquisitionMarketingController::class, 'listeToutes'])->name('toutes');
        Route::get('/actives', [AcquisitionMarketingController::class, 'listeActives'])->name('actives');
        Route::get('/optimisation', [AcquisitionMarketingController::class, 'listeOptimisation'])->name('optimisation');

        Route::get('/creer', [AcquisitionMarketingController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [AcquisitionMarketingController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{acquisitionMarketing}', [AcquisitionMarketingController::class, 'details'])->name('details');
        Route::get('/{acquisitionMarketing}/modifier', [AcquisitionMarketingController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{acquisitionMarketing}/mettre-a-jour', [AcquisitionMarketingController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{acquisitionMarketing}/activer', [AcquisitionMarketingController::class, 'activer'])->name('activer');
        Route::patch('/{acquisitionMarketing}/optimiser', [AcquisitionMarketingController::class, 'optimiser'])->name('optimiser');
        Route::patch('/{acquisitionMarketing}/stopper', [AcquisitionMarketingController::class, 'stopper'])->name('stopper');
        Route::patch('/{acquisitionMarketing}/archiver', [AcquisitionMarketingController::class, 'archiver'])->name('archiver');

        Route::delete('/{acquisitionMarketing}/supprimer', [AcquisitionMarketingController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - CROISSANCES
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/croissances')->name('chambre-marketing.croissances.')->group(function () {
        Route::get('/', [CroissanceMarketingController::class, 'listeToutes'])->name('toutes');
        Route::get('/planifiees', [CroissanceMarketingController::class, 'listePlanifiees'])->name('planifiees');
        Route::get('/en-cours', [CroissanceMarketingController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/critiques', [CroissanceMarketingController::class, 'listeCritiques'])->name('critiques');

        Route::get('/creer', [CroissanceMarketingController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CroissanceMarketingController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{croissanceMarketing}', [CroissanceMarketingController::class, 'details'])->name('details');
        Route::get('/{croissanceMarketing}/modifier', [CroissanceMarketingController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{croissanceMarketing}/mettre-a-jour', [CroissanceMarketingController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{croissanceMarketing}/lancer', [CroissanceMarketingController::class, 'lancer'])->name('lancer');
        Route::patch('/{croissanceMarketing}/passer-en-test', [CroissanceMarketingController::class, 'passerEnTest'])->name('passer_en_test');
        Route::patch('/{croissanceMarketing}/valider', [CroissanceMarketingController::class, 'valider'])->name('valider');
        Route::patch('/{croissanceMarketing}/abandonner', [CroissanceMarketingController::class, 'abandonner'])->name('abandonner');
        Route::patch('/{croissanceMarketing}/archiver', [CroissanceMarketingController::class, 'archiver'])->name('archiver');
        Route::patch('/{croissanceMarketing}/definir-priorite-critique', [CroissanceMarketingController::class, 'definirPrioriteCritique'])->name('definir_priorite_critique');

        Route::delete('/{croissanceMarketing}/supprimer', [CroissanceMarketingController::class, 'supprimer'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAMBRE MARKETING - TABLEAUX DE PERFORMANCE
    |--------------------------------------------------------------------------
    */
    Route::prefix('chambre-marketing/tableaux-performance')->name('chambre-marketing.tableaux-performance.')->group(function () {
        Route::get('/', [TableauPerformanceMarketingController::class, 'listeTous'])->name('tous');
        Route::get('/publies', [TableauPerformanceMarketingController::class, 'listePublies'])->name('publies');
        Route::get('/brouillons', [TableauPerformanceMarketingController::class, 'listeBrouillons'])->name('brouillons');

        Route::get('/creer', [TableauPerformanceMarketingController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [TableauPerformanceMarketingController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{tableauPerformanceMarketing}', [TableauPerformanceMarketingController::class, 'details'])->name('details');
        Route::get('/{tableauPerformanceMarketing}/modifier', [TableauPerformanceMarketingController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{tableauPerformanceMarketing}/mettre-a-jour', [TableauPerformanceMarketingController::class, 'mettreAJour'])->name('mettre_a_jour');

        Route::patch('/{tableauPerformanceMarketing}/publier', [TableauPerformanceMarketingController::class, 'publier'])->name('publier');
        Route::patch('/{tableauPerformanceMarketing}/remettre-en-brouillon', [TableauPerformanceMarketingController::class, 'remettreEnBrouillon'])->name('remettre_en_brouillon');
        Route::patch('/{tableauPerformanceMarketing}/archiver', [TableauPerformanceMarketingController::class, 'archiver'])->name('archiver');

        Route::delete('/{tableauPerformanceMarketing}/supprimer', [TableauPerformanceMarketingController::class, 'supprimer'])->name('supprimer');
    });




    // ______________________________chambre studio_______________________________

Route::prefix('chambre-studio')->name('chambre-studio.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD STUDIO
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('back.chambre-studio.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PRODUCTIONS AUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('productions-audio')->name('productions-audio.')->group(function () {
        Route::get('/', [ProductionAudioController::class, 'listeToutes'])->name('toutes');
        Route::get('/enregistrement', [ProductionAudioController::class, 'listeEnregistrement'])->name('enregistrement');
        Route::get('/mixage', [ProductionAudioController::class, 'listeMixage'])->name('mixage');
        Route::get('/mastering', [ProductionAudioController::class, 'listeMastering'])->name('mastering');
        Route::get('/livrees', [ProductionAudioController::class, 'listeLivrees'])->name('livrees');

        Route::get('/creer', [ProductionAudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ProductionAudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{productionAudio}', [ProductionAudioController::class, 'details'])->name('details');
        Route::get('/{productionAudio}/modifier', [ProductionAudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{productionAudio}/update', [ProductionAudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{productionAudio}/envoyer-en-mixage', [ProductionAudioController::class, 'envoyerEnMixage'])->name('envoyer_en_mixage');
        Route::patch('/{productionAudio}/envoyer-en-mastering', [ProductionAudioController::class, 'envoyerEnMastering'])->name('envoyer_en_mastering');
        Route::patch('/{productionAudio}/livrer', [ProductionAudioController::class, 'marquerCommeLivree'])->name('livrer');
        Route::patch('/{productionAudio}/archiver', [ProductionAudioController::class, 'archiver'])->name('archiver');

        Route::delete('/{productionAudio}/delete', [ProductionAudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | PRODUCTIONS VIDEO
    |--------------------------------------------------------------------------
    */
    Route::prefix('productions-video')->name('productions-video.')->group(function () {
        Route::get('/', [ProductionVideoController::class, 'listeToutes'])->name('toutes');
        Route::get('/tournage', [ProductionVideoController::class, 'listeTournage'])->name('tournage');
        Route::get('/montage', [ProductionVideoController::class, 'listeMontage'])->name('montage');
        Route::get('/validation', [ProductionVideoController::class, 'listeValidation'])->name('validation');
        Route::get('/livrees', [ProductionVideoController::class, 'listeLivrees'])->name('livrees');

        Route::get('/creer', [ProductionVideoController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ProductionVideoController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{productionVideo}', [ProductionVideoController::class, 'details'])->name('details');
        Route::get('/{productionVideo}/modifier', [ProductionVideoController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{productionVideo}/update', [ProductionVideoController::class, 'mettreAJour'])->name('update');

        Route::patch('/{productionVideo}/envoyer-en-montage', [ProductionVideoController::class, 'envoyerEnMontage'])->name('envoyer_en_montage');
        Route::patch('/{productionVideo}/envoyer-en-validation', [ProductionVideoController::class, 'envoyerEnValidation'])->name('envoyer_en_validation');
        Route::patch('/{productionVideo}/livrer', [ProductionVideoController::class, 'marquerCommeLivree'])->name('livrer');
        Route::patch('/{productionVideo}/archiver', [ProductionVideoController::class, 'archiver'])->name('archiver');

        Route::delete('/{productionVideo}/delete', [ProductionVideoController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | COMMANDES STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/', [CommandeStudioController::class, 'listeToutes'])->name('toutes');
        Route::get('/en-attente', [CommandeStudioController::class, 'listeEnAttente'])->name('en_attente');
        Route::get('/en-cours', [CommandeStudioController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/livrees', [CommandeStudioController::class, 'listeLivrees'])->name('livrees');

        Route::get('/creer', [CommandeStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CommandeStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{commandeStudio}', [CommandeStudioController::class, 'details'])->name('details');

        Route::patch('/{commandeStudio}/valider', [CommandeStudioController::class, 'valider'])->name('valider');
        Route::patch('/{commandeStudio}/livrer', [CommandeStudioController::class, 'livrer'])->name('livrer');

        Route::delete('/{commandeStudio}/delete', [CommandeStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationStudioController::class, 'listeToutes'])->name('toutes');
        Route::get('/reservees', [ReservationStudioController::class, 'listeReservees'])->name('reservees');
        Route::get('/confirmees', [ReservationStudioController::class, 'listeConfirmees'])->name('confirmees');
        Route::get('/annulees', [ReservationStudioController::class, 'listeAnnulees'])->name('annulees');
        Route::get('/aujourdhui', [ReservationStudioController::class, 'listeAujourdhui'])->name('aujourdhui');

        Route::get('/creer', [ReservationStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ReservationStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{reservationStudio}', [ReservationStudioController::class, 'details'])->name('details');
        Route::get('/{reservationStudio}/modifier', [ReservationStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{reservationStudio}/update', [ReservationStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{reservationStudio}/confirmer', [ReservationStudioController::class, 'confirmer'])->name('confirmer');
        Route::patch('/{reservationStudio}/annuler', [ReservationStudioController::class, 'annuler'])->name('annuler');

        Route::delete('/{reservationStudio}/delete', [ReservationStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | EVENEMENTS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('evenements')->name('evenements.')->group(function () {
        Route::get('/', [EvenementStudioController::class, 'listeTous'])->name('tous');
        Route::get('/planifies', [EvenementStudioController::class, 'listePlanifies'])->name('planifies');
        Route::get('/realises', [EvenementStudioController::class, 'listeRealises'])->name('realises');
        Route::get('/annules', [EvenementStudioController::class, 'listeAnnules'])->name('annules');
        Route::get('/mariages', [EvenementStudioController::class, 'listeMariages'])->name('mariages');

        Route::get('/creer', [EvenementStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [EvenementStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{evenementStudio}', [EvenementStudioController::class, 'details'])->name('details');
        Route::get('/{evenementStudio}/modifier', [EvenementStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{evenementStudio}/update', [EvenementStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{evenementStudio}/marquer-realise', [EvenementStudioController::class, 'marquerCommeRealise'])->name('marquer_realise');
        Route::patch('/{evenementStudio}/annuler', [EvenementStudioController::class, 'annuler'])->name('annuler');

        Route::delete('/{evenementStudio}/delete', [EvenementStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | CAPTATIONS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('captations')->name('captations.')->group(function () {
        Route::get('/', [CaptationStudioController::class, 'listeToutes'])->name('toutes');
        Route::get('/planifiees', [CaptationStudioController::class, 'listePlanifiees'])->name('planifiees');
        Route::get('/en-cours', [CaptationStudioController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/terminees', [CaptationStudioController::class, 'listeTerminees'])->name('terminees');
        Route::get('/mariages', [CaptationStudioController::class, 'listeMariages'])->name('mariages');
        Route::get('/evenements', [CaptationStudioController::class, 'listeEvenements'])->name('evenements');

        Route::get('/creer', [CaptationStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CaptationStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{captationStudio}', [CaptationStudioController::class, 'details'])->name('details');
        Route::get('/{captationStudio}/modifier', [CaptationStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{captationStudio}/update', [CaptationStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{captationStudio}/demarrer', [CaptationStudioController::class, 'demarrer'])->name('demarrer');
        Route::patch('/{captationStudio}/terminer', [CaptationStudioController::class, 'terminer'])->name('terminer');

        Route::delete('/{captationStudio}/delete', [CaptationStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | MONTAGES STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('montages')->name('montages.')->group(function () {
        Route::get('/', [MontageStudioController::class, 'listeTous'])->name('tous');
        Route::get('/brouillons', [MontageStudioController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/en-cours', [MontageStudioController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/valides', [MontageStudioController::class, 'listeValides'])->name('valides');
        Route::get('/livres', [MontageStudioController::class, 'listeLivres'])->name('livres');

        Route::get('/creer', [MontageStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MontageStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{montageStudio}', [MontageStudioController::class, 'details'])->name('details');
        Route::get('/{montageStudio}/modifier', [MontageStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{montageStudio}/update', [MontageStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{montageStudio}/valider', [MontageStudioController::class, 'valider'])->name('valider');
        Route::patch('/{montageStudio}/livrer', [MontageStudioController::class, 'livrer'])->name('livrer');

        Route::delete('/{montageStudio}/delete', [MontageStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | DIFFUSIONS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('diffusions')->name('diffusions.')->group(function () {
        Route::get('/', [DiffusionStudioController::class, 'listeToutes'])->name('toutes');
        Route::get('/planifiees', [DiffusionStudioController::class, 'listePlanifiees'])->name('planifiees');
        Route::get('/en-cours', [DiffusionStudioController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/terminees', [DiffusionStudioController::class, 'listeTerminees'])->name('terminees');

        Route::get('/creer', [DiffusionStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DiffusionStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{diffusionStudio}', [DiffusionStudioController::class, 'details'])->name('details');
        Route::get('/{diffusionStudio}/modifier', [DiffusionStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{diffusionStudio}/update', [DiffusionStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{diffusionStudio}/demarrer', [DiffusionStudioController::class, 'demarrer'])->name('demarrer');
        Route::patch('/{diffusionStudio}/terminer', [DiffusionStudioController::class, 'terminer'])->name('terminer');

        Route::delete('/{diffusionStudio}/delete', [DiffusionStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | CLIENTS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientStudioController::class, 'listeTous'])->name('tous');
        Route::get('/artistes', [ClientStudioController::class, 'listeArtistes'])->name('artistes');
        Route::get('/entreprises', [ClientStudioController::class, 'listeEntreprises'])->name('entreprises');

        Route::get('/creer', [ClientStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ClientStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{clientStudio}', [ClientStudioController::class, 'details'])->name('details');

        Route::delete('/{clientStudio}/delete', [ClientStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | PROJETS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('projets')->name('projets.')->group(function () {
        Route::get('/', [ProjetStudioController::class, 'listeTous'])->name('tous');
        Route::get('/actifs', [ProjetStudioController::class, 'listeActifs'])->name('actifs');
        Route::get('/termines', [ProjetStudioController::class, 'listeTermines'])->name('termines');
        Route::get('/archives', [ProjetStudioController::class, 'listeArchives'])->name('archives');

        Route::get('/creer', [ProjetStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ProjetStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{projetStudio}', [ProjetStudioController::class, 'details'])->name('details');
        Route::get('/{projetStudio}/modifier', [ProjetStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{projetStudio}/update', [ProjetStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{projetStudio}/terminer', [ProjetStudioController::class, 'terminer'])->name('terminer');
        Route::patch('/{projetStudio}/archiver', [ProjetStudioController::class, 'archiver'])->name('archiver');

        Route::delete('/{projetStudio}/delete', [ProjetStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | EQUIPEMENTS STUDIO
    |--------------------------------------------------------------------------
    */
    Route::prefix('equipements')->name('equipements.')->group(function () {
        Route::get('/', [EquipementStudioController::class, 'listeTous'])->name('tous');
        Route::get('/disponibles', [EquipementStudioController::class, 'listeDisponibles'])->name('disponibles');
        Route::get('/indisponibles', [EquipementStudioController::class, 'listeIndisponibles'])->name('indisponibles');
        Route::get('/maintenance', [EquipementStudioController::class, 'listeMaintenance'])->name('maintenance');

        Route::get('/creer', [EquipementStudioController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [EquipementStudioController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{equipementStudio}', [EquipementStudioController::class, 'details'])->name('details');
        Route::get('/{equipementStudio}/modifier', [EquipementStudioController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{equipementStudio}/update', [EquipementStudioController::class, 'mettreAJour'])->name('update');

        Route::patch('/{equipementStudio}/marquer-indisponible', [EquipementStudioController::class, 'marquerIndisponible'])->name('marquer_indisponible');
        Route::patch('/{equipementStudio}/marquer-disponible', [EquipementStudioController::class, 'marquerDisponible'])->name('marquer_disponible');
        Route::patch('/{equipementStudio}/mettre-en-maintenance', [EquipementStudioController::class, 'mettreEnMaintenance'])->name('mettre_en_maintenance');

        Route::delete('/{equipementStudio}/delete', [EquipementStudioController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | HABILLAGES SONORES
    |--------------------------------------------------------------------------
    */
    Route::prefix('habillages-sonores')->name('habillages-sonores.')->group(function () {
        Route::get('/', [HabillageSonoreController::class, 'listeTous'])->name('tous');
        Route::get('/creations', [HabillageSonoreController::class, 'listeCreations'])->name('creations');
        Route::get('/validations', [HabillageSonoreController::class, 'listeValidations'])->name('validations');
        Route::get('/livres', [HabillageSonoreController::class, 'listeLivres'])->name('livres');

        Route::get('/creer', [HabillageSonoreController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [HabillageSonoreController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{habillageSonore}', [HabillageSonoreController::class, 'details'])->name('details');
        Route::get('/{habillageSonore}/modifier', [HabillageSonoreController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{habillageSonore}/update', [HabillageSonoreController::class, 'mettreAJour'])->name('update');

        Route::patch('/{habillageSonore}/valider', [HabillageSonoreController::class, 'valider'])->name('valider');
        Route::patch('/{habillageSonore}/livrer', [HabillageSonoreController::class, 'livrer'])->name('livrer');

        Route::delete('/{habillageSonore}/delete', [HabillageSonoreController::class, 'supprimer'])->name('delete');
    });

});


//----------------graphisme----------------------------

Route::prefix('chambre-graphisme')->name('chambre-graphisme.')->group(function () {

    Route::get('/dashboard', [GraphismeDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('creations')->name('creations.')->group(function () {
        Route::get('/', [CreationGraphiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/brouillons', [CreationGraphiqueController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/en-cours', [CreationGraphiqueController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/validations', [CreationGraphiqueController::class, 'listeValidations'])->name('validations');
        Route::get('/livrees', [CreationGraphiqueController::class, 'listeLivrees'])->name('livrees');
        Route::get('/creer', [CreationGraphiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [CreationGraphiqueController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{creationGraphique}', [CreationGraphiqueController::class, 'details'])->name('details');
        Route::get('/{creationGraphique}/modifier', [CreationGraphiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{creationGraphique}/update', [CreationGraphiqueController::class, 'mettreAJour'])->name('update');
        Route::patch('/{creationGraphique}/envoyer-en-validation', [CreationGraphiqueController::class, 'envoyerEnValidation'])->name('envoyer_en_validation');
        Route::patch('/{creationGraphique}/livrer', [CreationGraphiqueController::class, 'livrer'])->name('livrer');
        Route::patch('/{creationGraphique}/archiver', [CreationGraphiqueController::class, 'archiver'])->name('archiver');
        Route::delete('/{creationGraphique}/delete', [CreationGraphiqueController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('identites')->name('identites.')->group(function () {
        Route::get('/', [IdentiteVisuelleController::class, 'listeToutes'])->name('toutes');
        Route::get('/creations', [IdentiteVisuelleController::class, 'listeCreations'])->name('creations');
        Route::get('/validations', [IdentiteVisuelleController::class, 'listeValidations'])->name('validations');
        Route::get('/terminees', [IdentiteVisuelleController::class, 'listeTerminees'])->name('terminees');
        Route::get('/creer', [IdentiteVisuelleController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [IdentiteVisuelleController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{identiteVisuelle}', [IdentiteVisuelleController::class, 'details'])->name('details');
        Route::get('/{identiteVisuelle}/modifier', [IdentiteVisuelleController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{identiteVisuelle}/update', [IdentiteVisuelleController::class, 'mettreAJour'])->name('update');
        Route::patch('/{identiteVisuelle}/valider', [IdentiteVisuelleController::class, 'valider'])->name('valider');
        Route::patch('/{identiteVisuelle}/terminer', [IdentiteVisuelleController::class, 'terminer'])->name('terminer');
        Route::delete('/{identiteVisuelle}/delete', [IdentiteVisuelleController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('affiches')->name('affiches.')->group(function () {
        Route::get('/', [AfficheFlyerController::class, 'listeToutes'])->name('toutes');
        Route::get('/affiches', [AfficheFlyerController::class, 'listeAffiches'])->name('affiches');
        Route::get('/flyers', [AfficheFlyerController::class, 'listeFlyers'])->name('flyers');
        Route::get('/livres', [AfficheFlyerController::class, 'listeLivres'])->name('livres');
        Route::get('/creer', [AfficheFlyerController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [AfficheFlyerController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{afficheFlyer}', [AfficheFlyerController::class, 'details'])->name('details');
        Route::get('/{afficheFlyer}/modifier', [AfficheFlyerController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{afficheFlyer}/update', [AfficheFlyerController::class, 'mettreAJour'])->name('update');
        Route::patch('/{afficheFlyer}/livrer', [AfficheFlyerController::class, 'livrer'])->name('livrer');
        Route::delete('/{afficheFlyer}/delete', [AfficheFlyerController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('social')->name('social.')->group(function () {
        Route::get('/', [VisuelReseauSocialController::class, 'listeToutes'])->name('toutes');
        Route::get('/programmes', [VisuelReseauSocialController::class, 'listeProgrammes'])->name('programmes');
        Route::get('/publies', [VisuelReseauSocialController::class, 'listePublies'])->name('publies');
        Route::get('/instagram', [VisuelReseauSocialController::class, 'listeInstagram'])->name('instagram');
        Route::get('/creer', [VisuelReseauSocialController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [VisuelReseauSocialController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{visuelReseauSocial}', [VisuelReseauSocialController::class, 'details'])->name('details');
        Route::get('/{visuelReseauSocial}/modifier', [VisuelReseauSocialController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{visuelReseauSocial}/update', [VisuelReseauSocialController::class, 'mettreAJour'])->name('update');
        Route::patch('/{visuelReseauSocial}/publier', [VisuelReseauSocialController::class, 'publier'])->name('publier');
        Route::delete('/{visuelReseauSocial}/delete', [VisuelReseauSocialController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('uiux')->name('uiux.')->group(function () {
        Route::get('/', [UiuxDesignController::class, 'listeToutes'])->name('toutes');
        Route::get('/wireframes', [UiuxDesignController::class, 'listeWireframes'])->name('wireframes');
        Route::get('/maquettes', [UiuxDesignController::class, 'listeMaquettes'])->name('maquettes');
        Route::get('/prototypes', [UiuxDesignController::class, 'listePrototypes'])->name('prototypes');
        Route::get('/creer', [UiuxDesignController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [UiuxDesignController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{uiuxDesign}', [UiuxDesignController::class, 'details'])->name('details');
        Route::get('/{uiuxDesign}/modifier', [UiuxDesignController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{uiuxDesign}/update', [UiuxDesignController::class, 'mettreAJour'])->name('update');
        Route::patch('/{uiuxDesign}/valider', [UiuxDesignController::class, 'valider'])->name('valider');
        Route::delete('/{uiuxDesign}/delete', [UiuxDesignController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('maquettes')->name('maquettes.')->group(function () {
        Route::get('/', [MaquetteGraphiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/creations', [MaquetteGraphiqueController::class, 'listeCreations'])->name('creations');
        Route::get('/validations', [MaquetteGraphiqueController::class, 'listeValidations'])->name('validations');
        Route::get('/livrees', [MaquetteGraphiqueController::class, 'listeLivrees'])->name('livrees');
        Route::get('/creer', [MaquetteGraphiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [MaquetteGraphiqueController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{maquetteGraphique}', [MaquetteGraphiqueController::class, 'details'])->name('details');
        Route::get('/{maquetteGraphique}/modifier', [MaquetteGraphiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{maquetteGraphique}/update', [MaquetteGraphiqueController::class, 'mettreAJour'])->name('update');
        Route::patch('/{maquetteGraphique}/valider', [MaquetteGraphiqueController::class, 'valider'])->name('valider');
        Route::patch('/{maquetteGraphique}/livrer', [MaquetteGraphiqueController::class, 'livrer'])->name('livrer');
        Route::delete('/{maquetteGraphique}/delete', [MaquetteGraphiqueController::class, 'supprimer'])->name('delete');
    });

    Route::prefix('clients-demandes')->name('clients-demandes.')->group(function () {
        Route::get('/', [DemandeClientGraphismeController::class, 'listeToutes'])->name('toutes');
        Route::get('/en-attente', [DemandeClientGraphismeController::class, 'listeEnAttente'])->name('en_attente');
        Route::get('/en-cours', [DemandeClientGraphismeController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/terminees', [DemandeClientGraphismeController::class, 'listeTerminees'])->name('terminees');
        Route::get('/creer', [DemandeClientGraphismeController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DemandeClientGraphismeController::class, 'enregistrer'])->name('enregistrer');
        Route::get('/{demandeClientGraphisme}', [DemandeClientGraphismeController::class, 'details'])->name('details');
        Route::get('/{demandeClientGraphisme}/modifier', [DemandeClientGraphismeController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{demandeClientGraphisme}/update', [DemandeClientGraphismeController::class, 'mettreAJour'])->name('update');
        Route::patch('/{demandeClientGraphisme}/lancer', [DemandeClientGraphismeController::class, 'lancer'])->name('lancer');
        Route::patch('/{demandeClientGraphisme}/terminer', [DemandeClientGraphismeController::class, 'terminer'])->name('terminer');
        Route::delete('/{demandeClientGraphisme}/delete', [DemandeClientGraphismeController::class, 'supprimer'])->name('delete');
    });

});



//----------------JURIDICTIONS----------------------------




Route::prefix('chambre-juridique')->name('chambre-juridique.')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD JURIDIQUE
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [JuridiqueDashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | CONTRATS JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('contrats')->name('contrats.')->group(function () {
        Route::get('/', [ContratJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/brouillons', [ContratJuridiqueController::class, 'listeBrouillons'])->name('brouillons');
        Route::get('/valides', [ContratJuridiqueController::class, 'listeValides'])->name('valides');
        Route::get('/signes', [ContratJuridiqueController::class, 'listeSignes'])->name('signes');
        Route::get('/archives', [ContratJuridiqueController::class, 'listeArchives'])->name('archives');

        Route::get('/creer', [ContratJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ContratJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{contratJuridique}', [ContratJuridiqueController::class, 'details'])->name('details');
        Route::get('/{contratJuridique}/modifier', [ContratJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{contratJuridique}/update', [ContratJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::patch('/{contratJuridique}/valider', [ContratJuridiqueController::class, 'valider'])->name('valider');
        Route::patch('/{contratJuridique}/signer', [ContratJuridiqueController::class, 'signer'])->name('signer');
        Route::patch('/{contratJuridique}/archiver', [ContratJuridiqueController::class, 'archiver'])->name('archiver');

        Route::delete('/{contratJuridique}/delete', [ContratJuridiqueController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | ENGAGEMENTS JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('engagements')->name('engagements.')->group(function () {
        Route::get('/', [EngagementJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/en-attente', [EngagementJuridiqueController::class, 'listeEnAttente'])->name('en_attente');
        Route::get('/valides', [EngagementJuridiqueController::class, 'listeValides'])->name('valides');
        Route::get('/rejetes', [EngagementJuridiqueController::class, 'listeRejetes'])->name('rejetes');

        Route::get('/creer', [EngagementJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [EngagementJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{engagementJuridique}', [EngagementJuridiqueController::class, 'details'])->name('details');
        Route::get('/{engagementJuridique}/modifier', [EngagementJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{engagementJuridique}/update', [EngagementJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::patch('/{engagementJuridique}/valider', [EngagementJuridiqueController::class, 'valider'])->name('valider');
        Route::patch('/{engagementJuridique}/rejeter', [EngagementJuridiqueController::class, 'rejeter'])->name('rejeter');
        Route::patch('/{engagementJuridique}/archiver', [EngagementJuridiqueController::class, 'archiver'])->name('archiver');

        Route::delete('/{engagementJuridique}/delete', [EngagementJuridiqueController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | MODELES DE DOCUMENTS JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('modeles-documents')->name('modeles-documents.')->group(function () {
        Route::get('/', [ModeleDocumentJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/actifs', [ModeleDocumentJuridiqueController::class, 'listeActifs'])->name('actifs');
        Route::get('/inactifs', [ModeleDocumentJuridiqueController::class, 'listeInactifs'])->name('inactifs');

        Route::get('/creer', [ModeleDocumentJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ModeleDocumentJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{modeleDocumentJuridique}', [ModeleDocumentJuridiqueController::class, 'details'])->name('details');
        Route::get('/{modeleDocumentJuridique}/modifier', [ModeleDocumentJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{modeleDocumentJuridique}/update', [ModeleDocumentJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::patch('/{modeleDocumentJuridique}/activer', [ModeleDocumentJuridiqueController::class, 'activer'])->name('activer');
        Route::patch('/{modeleDocumentJuridique}/desactiver', [ModeleDocumentJuridiqueController::class, 'desactiver'])->name('desactiver');

        Route::delete('/{modeleDocumentJuridique}/delete', [ModeleDocumentJuridiqueController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | DOCUMENTS JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/', [DocumentJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/actifs', [DocumentJuridiqueController::class, 'listeActifs'])->name('actifs');
        Route::get('/archives', [DocumentJuridiqueController::class, 'listeArchives'])->name('archives');

        Route::get('/creer', [DocumentJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DocumentJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{documentJuridique}', [DocumentJuridiqueController::class, 'details'])->name('details');
        Route::get('/{documentJuridique}/modifier', [DocumentJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{documentJuridique}/update', [DocumentJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::patch('/{documentJuridique}/activer', [DocumentJuridiqueController::class, 'activer'])->name('activer');
        Route::patch('/{documentJuridique}/archiver', [DocumentJuridiqueController::class, 'archiver'])->name('archiver');

        Route::delete('/{documentJuridique}/delete', [DocumentJuridiqueController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | DOSSIERS JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('dossiers')->name('dossiers.')->group(function () {
        Route::get('/', [DossierJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/ouverts', [DossierJuridiqueController::class, 'listeOuverts'])->name('ouverts');
        Route::get('/en-cours', [DossierJuridiqueController::class, 'listeEnCours'])->name('en_cours');
        Route::get('/fermes', [DossierJuridiqueController::class, 'listeFermes'])->name('fermes');

        Route::get('/creer', [DossierJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [DossierJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{dossierJuridique}', [DossierJuridiqueController::class, 'details'])->name('details');
        Route::get('/{dossierJuridique}/modifier', [DossierJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{dossierJuridique}/update', [DossierJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::patch('/{dossierJuridique}/ouvrir', [DossierJuridiqueController::class, 'ouvrir'])->name('ouvrir');
        Route::patch('/{dossierJuridique}/lancer', [DossierJuridiqueController::class, 'lancer'])->name('lancer');
        Route::patch('/{dossierJuridique}/fermer', [DossierJuridiqueController::class, 'fermer'])->name('fermer');
        Route::patch('/{dossierJuridique}/archiver', [DossierJuridiqueController::class, 'archiver'])->name('archiver');

        Route::delete('/{dossierJuridique}/delete', [DossierJuridiqueController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | ARCHIVES DU HUB
    |--------------------------------------------------------------------------
    */
    Route::prefix('archives-hub')->name('archives-hub.')->group(function () {
        Route::get('/', [ArchiveHubController::class, 'listeToutes'])->name('toutes');
        Route::get('/fondations', [ArchiveHubController::class, 'listeFondations'])->name('fondations');
        Route::get('/inaugurations', [ArchiveHubController::class, 'listeInaugurations'])->name('inaugurations');
        Route::get('/medias', [ArchiveHubController::class, 'listeMedias'])->name('medias');

        Route::get('/creer', [ArchiveHubController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [ArchiveHubController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{archiveHub}', [ArchiveHubController::class, 'details'])->name('details');
        Route::get('/{archiveHub}/modifier', [ArchiveHubController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{archiveHub}/update', [ArchiveHubController::class, 'mettreAJour'])->name('update');

        Route::patch('/{archiveHub}/rendre-visible', [ArchiveHubController::class, 'rendreVisible'])->name('rendre_visible');
        Route::patch('/{archiveHub}/masquer', [ArchiveHubController::class, 'masquer'])->name('masquer');

        Route::delete('/{archiveHub}/delete', [ArchiveHubController::class, 'supprimer'])->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | PIECES JOINTES JURIDIQUES
    |--------------------------------------------------------------------------
    */
    Route::prefix('pieces-jointes')->name('pieces-jointes.')->group(function () {
        Route::get('/', [PieceJointeJuridiqueController::class, 'listeToutes'])->name('toutes');
        Route::get('/contrats', [PieceJointeJuridiqueController::class, 'listeContrats'])->name('contrats');
        Route::get('/engagements', [PieceJointeJuridiqueController::class, 'listeEngagements'])->name('engagements');
        Route::get('/dossiers', [PieceJointeJuridiqueController::class, 'listeDossiers'])->name('dossiers');

        Route::get('/creer', [PieceJointeJuridiqueController::class, 'formulaireCreation'])->name('creer');
        Route::post('/enregistrer', [PieceJointeJuridiqueController::class, 'enregistrer'])->name('enregistrer');

        Route::get('/{pieceJointeJuridique}', [PieceJointeJuridiqueController::class, 'details'])->name('details');
        Route::get('/{pieceJointeJuridique}/modifier', [PieceJointeJuridiqueController::class, 'formulaireEdition'])->name('modifier');
        Route::put('/{pieceJointeJuridique}/update', [PieceJointeJuridiqueController::class, 'mettreAJour'])->name('update');

        Route::delete('/{pieceJointeJuridique}/delete', [PieceJointeJuridiqueController::class, 'supprimer'])->name('delete');
    });
});
















});




// Groupe de routes pour la formation
Route::prefix('back/formation')->name('back.formation.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardFormationController::class, 'index'])->name('dashboard');
    Route::get('/graphiques', [DashboardFormationController::class, 'graphiques'])->name('graphiques');

    // Catégories de modules
    Route::resource('categories-modules', CategorieModuleController::class);
    Route::patch('categories-modules/{categorieModule}/toggle-active', [CategorieModuleController::class, 'toggleActive'])->name('categories-modules.toggle-active');
    Route::post('categories-modules/reorder', [CategorieModuleController::class, 'reorder'])->name('categories-modules.reorder');

    // Modules
    Route::resource('modules', ModuleController::class);
    Route::patch('modules/{module}/toggle-active', [ModuleController::class, 'toggleActive'])->name('modules.toggle-active');

    // Cours
    Route::resource('cours', CourController::class);
    Route::get('cours/publies', [CourController::class, 'publies'])->name('cours.publies');
    Route::get('cours/brouillons', [CourController::class, 'brouillons'])->name('cours.brouillons');
    Route::patch('cours/{cour}/publier', [CourController::class, 'publier'])->name('cours.publier');
    Route::patch('cours/{cour}/depublier', [CourController::class, 'depublier'])->name('cours.depublier');
    Route::post('cours/{cour}/ajouter-enseignant', [CourController::class, 'ajouterEnseignant'])->name('cours.ajouter-enseignant');
    Route::delete('cours/{cour}/retirer-enseignant/{user}', [CourController::class, 'retirerEnseignant'])->name('cours.retirer-enseignant');

    // Chapitres
    Route::resource('chapitres', ChapitreController::class);
    Route::post('chapitres/reorder', [ChapitreController::class, 'reorder'])->name('chapitres.reorder');

    // Contenus
    Route::resource('contenus', ContenuController::class);
    Route::get('contenus/videos', [ContenuController::class, 'videos'])->name('contenus.videos');
    Route::get('contenus/documents', [ContenuController::class, 'documents'])->name('contenus.documents');
    Route::get('contenus/tutoriels', [ContenuController::class, 'tutoriels'])->name('contenus.tutoriels');
    Route::patch('contenus/{contenu}/toggle-visibility', [ContenuController::class, 'toggleVisibility'])->name('contenus.toggle-visibility');
    Route::get('contenus/{contenu}/download', [ContenuController::class, 'download'])->name('contenus.download');
    Route::post('contenus/reorder', [ContenuController::class, 'reorder'])->name('contenus.reorder');

    // Inscriptions
    Route::resource('inscriptions', InscriptionController::class);
    Route::get('inscriptions/en-attente', [InscriptionController::class, 'enAttente'])->name('inscriptions.en-attente');
    Route::patch('inscriptions/{inscription}/valider', [InscriptionController::class, 'valider'])->name('inscriptions.valider');
    Route::patch('inscriptions/{inscription}/terminer', [InscriptionController::class, 'terminer'])->name('inscriptions.terminer');
    Route::patch('inscriptions/{inscription}/abandonner', [InscriptionController::class, 'abandonner'])->name('inscriptions.abandonner');

    // Présences
    Route::resource('presences', PresenceController::class);
    Route::get('presences/rapport', [PresenceController::class, 'rapport'])->name('presences.rapport');

    // Accès salles
    Route::resource('acces-salles', AccesSalleController::class);
    Route::patch('acces-salles/{accesSalle}/desactiver', [AccesSalleController::class, 'desactiver'])->name('acces-salles.desactiver');
    Route::patch('acces-salles/{accesSalle}/activer', [AccesSalleController::class, 'activer'])->name('acces-salles.activer');
    Route::post('acces-salles/{accesSalle}/deconnecter/{user}', [AccesSalleController::class, 'deconnecterUtilisateur'])->name('acces-salles.deconnecter');
    Route::post('cours/{cour}/generer-code', [AccesSalleController::class, 'genererNouveauCode'])->name('cours.generer-code');
    Route::post('acces-salles/verifier-code', [AccesSalleController::class, 'verifierCode'])->name('acces-salles.verifier-code');

    // Devoirs
    Route::resource('devoirs', DevoirController::class);
    Route::patch('devoirs/{devoir}/publier', [DevoirController::class, 'publier'])->name('devoirs.publier');
    Route::patch('devoirs/{devoir}/depublier', [DevoirController::class, 'depublier'])->name('devoirs.depublier');

    // Soumissions
    Route::resource('soumissions', SoumissionDevoirController::class);
    Route::get('soumissions/a-corriger', [SoumissionDevoirController::class, 'aCorriger'])->name('soumissions.a-corriger');
    Route::get('soumissions/corrigees', [SoumissionDevoirController::class, 'corrigees'])->name('soumissions.corrigees');
    Route::post('soumissions/{soumission}/noter', [SoumissionDevoirController::class, 'noter'])->name('soumissions.noter');
    Route::get('soumissions/{soumission}/telecharger-fichier/{index}', [SoumissionDevoirController::class, 'telechargerFichier'])->name('soumissions.telecharger-fichier');

    // Commentaires
    Route::resource('commentaires', CommentaireCoursController::class);
    Route::get('commentaires/en-attente', [CommentaireCoursController::class, 'enAttente'])->name('commentaires.en-attente');
    Route::patch('commentaires/{commentaire}/approuver', [CommentaireCoursController::class, 'approuver'])->name('commentaires.approuver');
    Route::delete('commentaires/{commentaire}/rejeter', [CommentaireCoursController::class, 'rejeter'])->name('commentaires.rejeter');
    Route::post('commentaires/{commentaire}/liker', [CommentaireCoursController::class, 'liker'])->name('commentaires.liker');
    Route::post('commentaires/{commentaire}/repondre', [CommentaireCoursController::class, 'repondre'])->name('commentaires.repondre');

    // Progressions
    Route::resource('progressions', ProgressionController::class);
    Route::get('progressions/par-module', [ProgressionController::class, 'parModule'])->name('progressions.par-module');
    Route::get('progressions/par-eleve', [ProgressionController::class, 'parEleve'])->name('progressions.par-eleve');
    Route::get('progressions/barres', [ProgressionController::class, 'barres'])->name('progressions.barres');
    Route::post('progressions/{progression}/avancer', [ProgressionController::class, 'avancer'])->name('progressions.avancer');
    Route::patch('progressions/{progression}/reset', [ProgressionController::class, 'reset'])->name('progressions.reset');

    // Notifications
    Route::resource('notifications', NotificationController::class);
    Route::get('notifications/non-lues', [NotificationController::class, 'nonLues'])->name('notifications.non-lues');
    Route::patch('notifications/{notification}/marquer-lue', [NotificationController::class, 'marquerLue'])->name('notifications.marquer-lue');
    Route::post('notifications/marquer-toutes-lues', [NotificationController::class, 'marquerToutesLues'])->name('notifications.marquer-toutes-lues');
    Route::post('notifications/rappel/{devoir}', [NotificationController::class, 'envoyerRappel'])->name('notifications.envoyer-rappel');

    // Exports
    Route::get('export/excel', [ExportFormationController::class, 'exportExcel'])->name('export.excel');
    Route::get('export/pdf', [ExportFormationController::class, 'exportPdf'])->name('export.pdf');
});























require __DIR__ . '/auth.php';















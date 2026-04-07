<aside class="sidebar" id="sidebar">
    <div class="sidebar-top">

        {{-- En-tête du sidebar --}}
        <div class="brand">
            <div class="brand-left">
                <div class="brand-logo">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div class="brand-text">
                    <div class="brand-title">EUNITAL</div>
                    <div class="brand-subtitle">Hub Digital Admin</div>
                </div>
            </div>

            <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" type="button" title="Réduire le menu">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>

        <div class="sidebar-scroll">

            {{-- TABLEAU DE BORD --}}
            <div class="menu-group-title">Tableau de bord</div>
            <ul class="menu">
                <li>
                    <a href="{{ route('back.dashboard') }}"
                        class="menu-item {{ request()->routeIs('back.dashboard') ? 'active' : '' }}">
                        <div class="menu-left">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-table-cells-large"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Tableau de bord</div>
                                <div class="menu-subtext">Vue générale et pilotage global</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">Accueil</span>
                        </div>
                    </a>
                </li>
            </ul>

            {{-- ADMINISTRATION --}}
            <div class="menu-group-title">Administration</div>
            <ul class="menu">

                {{-- Gestion des contenus --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuGestionContenus"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Gestion des contenus</div>
                                <div class="menu-subtext">Articles, catégories, publications</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuGestionContenus">
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('back.articles.tous') }}"
                                    class="submenu-link {{ request()->routeIs('back.articles.tous') ? 'active' : '' }}">
                                    Tous les articles
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.articles.creer') }}"
                                    class="submenu-link {{ request()->routeIs('back.articles.creer') ? 'active' : '' }}">
                                    Ajouter un article
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.articles.publies') }}"
                                    class="submenu-link {{ request()->routeIs('back.articles.publies') ? 'active' : '' }}">
                                    Articles publiés
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.articles.brouillons') }}"
                                    class="submenu-link {{ request()->routeIs('back.articles.brouillons') ? 'active' : '' }}">
                                    Articles en brouillon
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.articles.archives') }}"
                                    class="submenu-link {{ request()->routeIs('back.articles.archives') ? 'active' : '' }}">
                                    Articles archivés
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.commentaires.tous') }}"
                                    class="submenu-link {{ request()->routeIs('back.commentaires.*') ? 'active' : '' }}">
                                    Commentaires
                                </a>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuCategories" aria-expanded="false">
                                    <span>Catégories</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>

                                <div class="nested-submenu-wrap" id="menuCategories">
                                    <ul class="nested-submenu">
                                        <li>
                                            <a href="{{ route('back.categories.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.categories.toutes') ? 'active' : '' }}">
                                                Toutes les catégories
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.categories.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.categories.creer') ? 'active' : '' }}">
                                                Ajouter une catégorie
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.categories.actives') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.categories.actives', 'back.categories.inactives') ? 'active' : '' }}">
                                                Sous-catégories
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.etiquettes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.etiquettes.*') ? 'active' : '' }}">
                                                Étiquettes
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Gestion des utilisateurs --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuUtilisateurs"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-secondary-subtle text-secondary">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Gestion des utilisateurs</div>
                                <div class="menu-subtext">Admins, auteurs, responsables</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">7</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuUtilisateurs">
                        <ul class="submenu">
                            <li><a href="{{ route('back.utilisateurs.tous') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.tous') ? 'active' : '' }}">Tous
                                    les utilisateurs</a></li>
                            <li><a href="{{ route('back.utilisateurs.creer') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.creer') ? 'active' : '' }}">Ajouter
                                    un utilisateur</a></li>
                            <li><a href="{{ route('back.utilisateurs.administrateurs') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.administrateurs') ? 'active' : '' }}">Administrateurs</a>
                            </li>
                            <li><a href="{{ route('back.utilisateurs.auteurs') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.auteurs') ? 'active' : '' }}">Auteurs</a>
                            </li>
                            <li><a href="{{ route('back.utilisateurs.responsables') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.responsables') ? 'active' : '' }}">Responsables</a>
                            </li>
                            <li><a href="{{ route('back.utilisateurs.desactives') }}"
                                    class="submenu-link {{ request()->routeIs('back.utilisateurs.desactives') ? 'active' : '' }}">Comptes
                                    désactivés</a></li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuRolesPermissions" aria-expanded="false">
                                    <span>Rôles et permissions</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>

                                <div class="nested-submenu-wrap" id="menuRolesPermissions">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.roles.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.roles.*') ? 'active' : '' }}">Liste
                                                des rôles</a></li>
                                        <li><a href="{{ route('back.roles.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.roles.creer') ? 'active' : '' }}">Créer
                                                un rôle</a></li>
                                        <li><a href="{{ route('back.permissions.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.permissions.*') ? 'active' : '' }}">Permissions
                                                d’accès</a></li>
                                        <li><a href="{{ route('back.utilisateurs.tous') }}"
                                                class="nested-submenu-link">Attribution des rôles</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Équipe --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuEquipe"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Équipe</div>
                                <div class="menu-subtext">Membres et organisation interne</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">5</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuEquipe">
                        <ul class="submenu">
                            <li><a href="{{ route('back.equipe.membres.tous') }}"
                                    class="submenu-link {{ request()->routeIs('back.equipe.membres.tous', 'back.equipe.membres.actifs', 'back.equipe.membres.inactifs', 'back.equipe.membres.en_pause', 'back.equipe.membres.details', 'back.equipe.membres.modifier') ? 'active' : '' }}">Tous
                                    les membres</a></li>
                            <li><a href="{{ route('back.equipe.membres.creer') }}"
                                    class="submenu-link {{ request()->routeIs('back.equipe.membres.creer') ? 'active' : '' }}">Ajouter
                                    un membre</a></li>
                            <li><a href="{{ route('back.equipe.membres.organigramme') }}"
                                    class="submenu-link {{ request()->routeIs('back.equipe.membres.organigramme') ? 'active' : '' }}">Organigramme</a>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuOrganisationInterne" aria-expanded="false">
                                    <span>Fonctions et postes</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuOrganisationInterne">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.equipe.postes.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.postes.*') ? 'active' : '' }}">Tous
                                                les postes</a></li>
                                        <li><a href="{{ route('back.equipe.postes.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.postes.creer') ? 'active' : '' }}">Ajouter
                                                un poste</a></li>
                                        <li><a href="{{ route('back.equipe.departements.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.departements.*') ? 'active' : '' }}">Départements</a>
                                        </li>
                                        <li><a href="{{ route('back.equipe.departements.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.departements.creer') ? 'active' : '' }}">Ajouter
                                                un département</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuMessagesInternes" aria-expanded="false">
                                    <span>Messages internes</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuMessagesInternes">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.equipe.messages.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.messages.tous') ? 'active' : '' }}">Tous
                                                les messages</a></li>
                                        <li><a href="{{ route('back.equipe.messages.recus') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.messages.recus') ? 'active' : '' }}">Messages
                                                reçus</a></li>
                                        <li><a href="{{ route('back.equipe.messages.envoyes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.messages.envoyes') ? 'active' : '' }}">Messages
                                                envoyés</a></li>
                                        <li><a href="{{ route('back.equipe.messages.annonces') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.messages.annonces') ? 'active' : '' }}">Annonces
                                                internes</a></li>
                                        <li><a href="{{ route('back.equipe.messages.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.equipe.messages.creer') ? 'active' : '' }}">Nouveau
                                                message</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Médias --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuMedias"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-photo-film"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Médias</div>
                                <div class="menu-subtext">Images, vidéos, documents et réseaux</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">8</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuMedias">
                        <ul class="submenu">
                            <li><a href="{{ route('back.medias.fichiers.bibliotheque') }}"
                                    class="submenu-link {{ request()->routeIs('back.medias.fichiers.bibliotheque') ? 'active' : '' }}">Bibliothèque
                                    média</a></li>
                            <li><a href="{{ route('back.medias.fichiers.creer') }}"
                                    class="submenu-link {{ request()->routeIs('back.medias.fichiers.creer') ? 'active' : '' }}">Ajouter
                                    un fichier</a></li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuTypesMedias" aria-expanded="false">
                                    <span>Types de médias</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuTypesMedias">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.medias.fichiers.images') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.fichiers.images') ? 'active' : '' }}">Images</a>
                                        </li>
                                        <li><a href="{{ route('back.medias.fichiers.videos') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.fichiers.videos') ? 'active' : '' }}">Vidéos</a>
                                        </li>
                                        <li><a href="{{ route('back.medias.fichiers.documents') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.fichiers.documents') ? 'active' : '' }}">Documents</a>
                                        </li>
                                        <li><a href="{{ route('back.medias.fichiers.en_avant') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.fichiers.en_avant') ? 'active' : '' }}">Médias
                                                en avant</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuOrganisationMedias" aria-expanded="false">
                                    <span>Organisation média</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuOrganisationMedias">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.medias.categories.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.categories.toutes') ? 'active' : '' }}">Catégories
                                                média</a></li>
                                        <li><a href="{{ route('back.medias.categories.actives') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.categories.actives') ? 'active' : '' }}">Catégories
                                                actives</a></li>
                                        <li><a href="{{ route('back.medias.categories.inactives') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.categories.inactives') ? 'active' : '' }}">Catégories
                                                inactives</a></li>
                                        <li><a href="{{ route('back.medias.categories.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.categories.creer') ? 'active' : '' }}">Ajouter
                                                une catégorie</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuLiensSociaux" aria-expanded="false">
                                    <span>Liens sociaux & web</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuLiensSociaux">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.medias.liens-sociaux.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.liens-sociaux.tous') ? 'active' : '' }}">Tous
                                                les liens sociaux</a></li>
                                        <li><a href="{{ route('back.medias.liens-sociaux.header') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.liens-sociaux.header') ? 'active' : '' }}">Liens
                                                du header</a></li>
                                        <li><a href="{{ route('back.medias.liens-sociaux.footer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.liens-sociaux.footer') ? 'active' : '' }}">Liens
                                                du footer</a></li>
                                        <li><a href="{{ route('back.medias.liens-sociaux.actifs') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.liens-sociaux.actifs') ? 'active' : '' }}">Liens
                                                actifs</a></li>
                                        <li><a href="{{ route('back.medias.liens-sociaux.creer') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.medias.liens-sociaux.creer') ? 'active' : '' }}">Ajouter
                                                un lien social</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Pages --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuPages"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Pages</div>
                                <div class="menu-subtext">Pages institutionnelles et du site</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">7</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuPages">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Toutes les pages</a></li>
                            <li><a href="#" class="submenu-link">Ajouter une page</a></li>
                            <li><a href="#" class="submenu-link">Page d’accueil</a></li>
                            <li><a href="#" class="submenu-link">À propos</a></li>
                            <li><a href="#" class="submenu-link">Contact</a></li>
                            <li><a href="#" class="submenu-link">Mentions légales</a></li>
                            <li><a href="#" class="submenu-link">Conditions générales d’utilisation</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Communication --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuCommunication"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Communication</div>
                                <div class="menu-subtext">Messages, annonces, newsletter</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuCommunication">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Messages de contact</a></li>
                            <li><a href="#" class="submenu-link">Annonces</a></li>
                            <li><a href="#" class="submenu-link">Notifications</a></li>
                            <li><a href="#" class="submenu-link">Newsletter</a></li>
                            <li><a href="#" class="submenu-link">Abonnés</a></li>
                            <li><a href="#" class="submenu-link">Campagnes</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Paiements --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuPaiements"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Paiements</div>
                                <div class="menu-subtext">Revenus, demandes, historique</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">5</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuPaiements">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Vue des revenus</a></li>
                            <li><a href="#" class="submenu-link">Demandes de paiement</a></li>
                            <li><a href="#" class="submenu-link">Historique des paiements</a></li>
                            <li><a href="#" class="submenu-link">Tarification</a></li>
                            <li><a href="#" class="submenu-link">Rapports financiers</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Statistiques --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuStatsRapports"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-dark-subtle text-dark">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Statistiques & rapports</div>
                                <div class="menu-subtext">Analyses, performances, bilans</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuStatsRapports">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Statistiques globales</a></li>
                            <li><a href="#" class="submenu-link">Vues des articles</a></li>
                            <li><a href="#" class="submenu-link">Performances des auteurs</a></li>
                            <li><a href="#" class="submenu-link">Rapports mensuels</a></li>
                            <li><a href="#" class="submenu-link">Rapports annuels</a></li>
                            <li><a href="#" class="submenu-link">Exports et impressions</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Paramètres --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuParametres"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Paramètres</div>
                                <div class="menu-subtext">Site, emails, options générales</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">7</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuParametres">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Paramètres généraux</a></li>
                            <li><a href="#" class="submenu-link">Identité du site</a></li>
                            <li><a href="#" class="submenu-link">Logo et favicon</a></li>
                            <li><a href="#" class="submenu-link">Menus du site</a></li>
                            <li><a href="#" class="submenu-link">Réseaux sociaux</a></li>
                            <li><a href="#" class="submenu-link">Configuration email</a></li>
                            <li><a href="#" class="submenu-link">Paramètres système</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Sécurité --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuSecurite"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Sécurité</div>
                                <div class="menu-subtext">Accès, activités, protection</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">5</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuSecurite">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Connexions</a></li>
                            <li><a href="#" class="submenu-link">Journal des activités</a></li>
                            <li><a href="#" class="submenu-link">Historique système</a></li>
                            <li><a href="#" class="submenu-link">Gestion des accès</a></li>
                            <li><a href="#" class="submenu-link">Protection des données</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            {{-- CHAMBRES DU HUB --}}
            <div class="menu-group-title">Chambres du Hub</div>
            <ul class="menu">

                {{-- Chambre ingénieurs --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreIngenieurs"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-compass-drafting"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre d’ingénieurs</div>
                                <div class="menu-subtext">Réflexion, idées, architecture</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreIngenieurs">
                        <ul class="submenu">
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuIngenieursInnovation" aria-expanded="false">
                                    <span>Innovation & orientation</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuIngenieursInnovation">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-ingenieur.idees.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.idees.*') ? 'active' : '' }}">Idées
                                                et propositions</a></li>
                                        <li><a href="{{ route('back.chambre-ingenieur.reflexions.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.reflexions.*') ? 'active' : '' }}">Réflexion
                                                stratégique</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuIngenieursConception" aria-expanded="false">
                                    <span>Conception & validation</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuIngenieursConception">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-ingenieur.architectures.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.architectures.*') ? 'active' : '' }}">Architecture
                                                technique</a></li>
                                        <li><a href="{{ route('back.chambre-ingenieur.etudes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.etudes.*') ? 'active' : '' }}">Études
                                                de faisabilité</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuIngenieursExecution" aria-expanded="false">
                                    <span>Réalisation & documentation</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuIngenieursExecution">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-ingenieur.prototypes.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.prototypes.*') ? 'active' : '' }}">Prototypes</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-ingenieur.dossiers.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-ingenieur.dossiers.*') ? 'active' : '' }}">Dossiers
                                                techniques</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Chambre marketing --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreMarketing"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre marketing</div>
                                <div class="menu-subtext">Stratégie, visibilité, croissance</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreMarketing">
                        <ul class="submenu">
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuMarketingDiffusion" aria-expanded="false">
                                    <span>Diffusion & visibilité</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuMarketingDiffusion">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-marketing.campagnes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.campagnes.*') ? 'active' : '' }}">Campagnes
                                                marketing</a></li>
                                        <li><a href="{{ route('back.chambre-marketing.acquisitions.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.acquisitions.*') ? 'active' : '' }}">Acquisition</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuMarketingStrategie" aria-expanded="false">
                                    <span>Identité & stratégie</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuMarketingStrategie">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-marketing.positionnements.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.positionnements.*') ? 'active' : '' }}">Positionnement</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-marketing.images-marque.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.images-marque.*') ? 'active' : '' }}">Image
                                                de marque</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuMarketingPerformance" aria-expanded="false">
                                    <span>Croissance & pilotage</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuMarketingPerformance">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-marketing.croissances.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.croissances.*') ? 'active' : '' }}">Croissance</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-marketing.tableaux-performance.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-marketing.tableaux-performance.*') ? 'active' : '' }}">Tableaux
                                                de performance</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Chambre studio --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreStudio"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-photo-film"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre studio</div>
                                <div class="menu-subtext">Audio, vidéo, production</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">13</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreStudio">
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('back.chambre-studio.dashboard') }}"
                                    class="submenu-link {{ request()->routeIs('back.chambre-studio.dashboard') ? 'active' : '' }}">
                                    Dashboard studio
                                </a>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuStudioProduction" aria-expanded="false">
                                    <span>Production</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuStudioProduction">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-studio.productions-audio.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.productions-audio.*') ? 'active' : '' }}">Production
                                                audio</a></li>
                                        <li><a href="{{ route('back.chambre-studio.productions-video.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.productions-video.*') ? 'active' : '' }}">Production
                                                vidéo</a></li>
                                        <li><a href="{{ route('back.chambre-studio.montages.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.montages.*') ? 'active' : '' }}">Montage</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-studio.captations.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.captations.*') ? 'active' : '' }}">Captation</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-studio.habillages-sonores.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.habillages-sonores.*') ? 'active' : '' }}">Habillage
                                                sonore</a></li>
                                        <li><a href="{{ route('back.chambre-studio.diffusions.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.diffusions.*') ? 'active' : '' }}">Diffusion
                                                studio</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuStudioExploitation" aria-expanded="false">
                                    <span>Exploitation studio</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuStudioExploitation">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-studio.reservations.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.reservations.*') ? 'active' : '' }}">Réservations</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-studio.equipements.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.equipements.*') ? 'active' : '' }}">Équipements</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-studio.projets.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.projets.*') ? 'active' : '' }}">Projets
                                                studio</a></li>
                                        <li><a href="{{ route('back.chambre-studio.evenements.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.evenements.*') ? 'active' : '' }}">Événements</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuStudioBusiness" aria-expanded="false">
                                    <span>Clients & business</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuStudioBusiness">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-studio.clients.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.clients.*') ? 'active' : '' }}">Clients
                                                studio</a></li>
                                        <li><a href="{{ route('back.chambre-studio.commandes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-studio.commandes.*') ? 'active' : '' }}">Commandes
                                                studio</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Chambre graphisme --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreGraphisme"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-pen-ruler"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre graphisme</div>
                                <div class="menu-subtext">Design, branding, visuels</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">8</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreGraphisme">
                        <ul class="submenu">

                            {{-- PILOTAGE --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuGraphismePilotage" aria-expanded="false">
                                    <span> Pilotage graphique</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>

                                <div class="nested-submenu-wrap" id="menuGraphismePilotage">
                                    <ul class="nested-submenu">
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.dashboard') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.dashboard') ? 'active' : '' }}">
                                                Dashboard graphisme
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.clients-demandes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.clients-demandes.*') ? 'active' : '' }}">
                                                Demandes clients design
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- PRODUCTION --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuGraphismeProduction" aria-expanded="false">
                                    <span> Production design</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>

                                <div class="nested-submenu-wrap" id="menuGraphismeProduction">
                                    <ul class="nested-submenu">
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.creations.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.creations.*') ? 'active' : '' }}">
                                                Créations graphiques
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.identites.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.identites.*') ? 'active' : '' }}">
                                                Identité visuelle
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.affiches.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.affiches.*') ? 'active' : '' }}">
                                                Affiches & flyers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.social.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.social.*') ? 'active' : '' }}">
                                                Visuels réseaux sociaux
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- DESIGN DIGITAL --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuGraphismeDigital" aria-expanded="false">
                                    <span> Design digital</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>

                                <div class="nested-submenu-wrap" id="menuGraphismeDigital">
                                    <ul class="nested-submenu">
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.uiux.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.uiux.*') ? 'active' : '' }}">
                                                UI / UX design
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('back.chambre-graphisme.maquettes.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-graphisme.maquettes.*') ? 'active' : '' }}">
                                                Maquettes graphiques
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- Chambre juridique --}}


                {{-- Chambre juridique --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreJuridique"
                        aria-expanded="{{ request()->routeIs('back.juridique.*') ? 'true' : 'false' }}">
                        <div class="menu-left">
                            <div class="menu-icon bg-secondary-subtle text-secondary">
                                <i class="fa-solid fa-scale-balanced"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre juridique</div>
                                <div class="menu-subtext">Conformité, contrats, documents, RGPD</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">Juridique</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreJuridique">
                        <ul class="submenu">

                            {{-- DASHBOARD --}}
                            <li>
                                <a href="{{ route('back.juridique.dashboard') }}"
                                    class="submenu-link {{ request()->routeIs('back.juridique.dashboard') ? 'active' : '' }}">
                                    <i class="fa-solid fa-chart-line me-2"></i> Tableau de bord
                                </a>
                            </li>

                            {{-- DOCUMENTS & SIGNATURES --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueDocuments" aria-expanded="false">
                                    <span><i class="fa-solid fa-file-alt me-2"></i> Documents & signatures</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueDocuments">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.types-documents.index') }}"
                                                class="nested-submenu-link">Types de documents</a></li>
                                        <li><a href="{{ route('back.juridique.modeles.index') }}"
                                                class="nested-submenu-link">Modèles de documents</a></li>
                                        <li><a href="{{ route('back.juridique.documents.index') }}"
                                                class="nested-submenu-link">Tous les documents</a></li>
                                        <li><a href="{{ route('back.juridique.documents.create') }}"
                                                class="nested-submenu-link">Nouveau document</a></li>
                                        <li><a href="{{ route('back.juridique.generation.index') }}"
                                                class="nested-submenu-link">Générer un document</a></li>
                                        <li><a href="{{ route('back.juridique.documents.brouillons') }}"
                                                class="nested-submenu-link">Brouillons</a></li>
                                        <li><a href="{{ route('back.juridique.documents.en-attente') }}"
                                                class="nested-submenu-link">En attente</a></li>
                                        <li><a href="{{ route('back.juridique.documents.signes') }}"
                                                class="nested-submenu-link">Documents signés</a></li>
                                        <li><a href="{{ route('back.juridique.signatures.index') }}"
                                                class="nested-submenu-link">Signatures</a></li>
                                        <li><a href="{{ route('back.juridique.signatures.en-attente') }}"
                                                class="nested-submenu-link">Signatures en attente</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- CONTRATS & ENGAGEMENTS --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueContrats" aria-expanded="false">
                                    <span><i class="fa-solid fa-handshake me-2"></i> Contrats & engagements</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueContrats">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.contrats.index') }}"
                                                class="nested-submenu-link">Tous les contrats</a></li>
                                        <li><a href="{{ route('back.juridique.contrats.create') }}"
                                                class="nested-submenu-link">Nouveau contrat</a></li>
                                        <li><a href="{{ route('back.juridique.contrats.actifs') }}"
                                                class="nested-submenu-link">Contrats actifs</a></li>
                                        <li><a href="{{ route('back.juridique.contrats.expirants') }}"
                                                class="nested-submenu-link">Expirant bientôt</a></li>
                                        <li><a href="{{ route('back.juridique.contrats.expires') }}"
                                                class="nested-submenu-link">Contrats expirés</a></li>
                                        <li><a href="{{ route('back.juridique.engagements.index') }}"
                                                class="nested-submenu-link">Engagements</a></li>
                                        <li><a href="{{ route('back.juridique.engagements.actifs') }}"
                                                class="nested-submenu-link">Engagements actifs</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- CONFORMITÉ & RGPD --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueConformite" aria-expanded="false">
                                    <span><i class="fa-solid fa-shield-alt me-2"></i> Conformité & RGPD</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueConformite">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.conformites.index') }}"
                                                class="nested-submenu-link">Évaluations de conformité</a></li>
                                        <li><a href="{{ route('back.juridique.conformites.conformes') }}"
                                                class="nested-submenu-link">Conformes</a></li>
                                        <li><a href="{{ route('back.juridique.conformites.non-conformes') }}"
                                                class="nested-submenu-link">Non conformes</a></li>
                                        <li><a href="{{ route('back.juridique.conformites.en-cours') }}"
                                                class="nested-submenu-link">En cours</a></li>
                                        <li><a href="{{ route('back.juridique.rgpd.index') }}"
                                                class="nested-submenu-link">Démarches RGPD</a></li>
                                        <li><a href="{{ route('back.juridique.rgpd.registre') }}"
                                                class="nested-submenu-link">Registre RGPD</a></li>
                                        <li><a href="{{ route('back.juridique.politiques.index') }}"
                                                class="nested-submenu-link">Politique confidentialité</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- TEXTES LÉGAUX --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueLegal" aria-expanded="false">
                                    <span><i class="fa-solid fa-gavel me-2"></i> Textes légaux</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueLegal">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.legalites.index') }}"
                                                class="nested-submenu-link">Bibliothèque juridique</a></li>
                                        <li><a href="{{ route('back.juridique.legalites.lois') }}"
                                                class="nested-submenu-link">Lois</a></li>
                                        <li><a href="{{ route('back.juridique.legalites.decrets') }}"
                                                class="nested-submenu-link">Décrets</a></li>
                                        <li><a href="{{ route('back.juridique.legalites.reglements') }}"
                                                class="nested-submenu-link">Règlements</a></li>
                                        <li><a href="{{ route('back.juridique.legalites.en-vigueur') }}"
                                                class="nested-submenu-link">En vigueur</a></li>
                                        <li><a href="{{ route('back.juridique.conseils.index') }}"
                                                class="nested-submenu-link">Conseils juridiques</a></li>
                                        <li><a href="{{ route('back.juridique.conseils.faq') }}"
                                                class="nested-submenu-link">FAQ juridique</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- LITIGES --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueLitiges" aria-expanded="false">
                                    <span><i class="fa-solid fa-gavel me-2"></i> Litiges</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueLitiges">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.litiges.index') }}"
                                                class="nested-submenu-link">Tous les litiges</a></li>
                                        <li><a href="{{ route('back.juridique.litiges.create') }}"
                                                class="nested-submenu-link">Nouveau litige</a></li>
                                        <li><a href="{{ route('back.juridique.litiges.ouverts') }}"
                                                class="nested-submenu-link">Litiges ouverts</a></li>
                                        <li><a href="{{ route('back.juridique.litiges.clos') }}"
                                                class="nested-submenu-link">Litiges clos</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- DÉMARCHES ADMINISTRATIVES --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueDemarches" aria-expanded="false">
                                    <span><i class="fa-solid fa-building me-2"></i> Démarches
                                        administratives</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueDemarches">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.demarches.index') }}"
                                                class="nested-submenu-link">Toutes les démarches</a></li>
                                        <li><a href="{{ route('back.juridique.demarches.create') }}"
                                                class="nested-submenu-link">Nouvelle démarche</a></li>
                                        <li><a href="{{ route('back.juridique.demarches.en-cours') }}"
                                                class="nested-submenu-link">Démarches actives</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- MENTIONS & CGU --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueMentions" aria-expanded="false">
                                    <span><i class="fa-solid fa-file-lines me-2"></i> Mentions & CGU</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueMentions">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.mentions.index') }}"
                                                class="nested-submenu-link">Mentions légales</a></li>
                                        <li><a href="{{ route('back.juridique.mentions.actives') }}"
                                                class="nested-submenu-link">Mentions actives</a></li>
                                        <li><a href="{{ route('back.juridique.cgu.index') }}"
                                                class="nested-submenu-link">CGU / CGV</a></li>
                                        <li><a href="{{ route('back.juridique.cgu.cgu') }}"
                                                class="nested-submenu-link">CGU en vigueur</a></li>
                                        <li><a href="{{ route('back.juridique.cgu.cgv') }}"
                                                class="nested-submenu-link">CGV en vigueur</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- ENTREPRISES --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueEntreprises" aria-expanded="false">
                                    <span><i class="fa-solid fa-building me-2"></i> Entreprises</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueEntreprises">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.entreprises.index') }}"
                                                class="nested-submenu-link">Toutes les entreprises</a></li>
                                        <li><a href="{{ route('back.juridique.entreprises.create') }}"
                                                class="nested-submenu-link">Ajouter une entreprise</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- ARCHIVES --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueArchives" aria-expanded="false">
                                    <span><i class="fa-solid fa-archive me-2"></i> Archives</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueArchives">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.archives.index') }}"
                                                class="nested-submenu-link">Toutes les archives</a></li>
                                        <li><a href="{{ route('back.juridique.archives.documents') }}"
                                                class="nested-submenu-link">Documents archivés</a></li>
                                        <li><a href="{{ route('back.juridique.archives.contrats') }}"
                                                class="nested-submenu-link">Contrats archivés</a></li>
                                        <li><a href="{{ route('back.juridique.archives.litiges') }}"
                                                class="nested-submenu-link">Litiges archivés</a></li>
                                        <li><a href="{{ route('back.juridique.archives.politique') }}"
                                                class="nested-submenu-link">Politique d'archivage</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- VALIDATION & NOTIFICATIONS --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueValidation" aria-expanded="false">
                                    <span><i class="fa-solid fa-check-circle me-2"></i> Validation &
                                        notifications</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueValidation">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.validation.index') }}"
                                                class="nested-submenu-link">À valider</a></li>
                                        <li><a href="{{ route('back.juridique.notifications.index') }}"
                                                class="nested-submenu-link">Notifications</a></li>
                                        <li><a href="{{ route('back.juridique.notifications.preferences') }}"
                                                class="nested-submenu-link">Préférences</a></li>
                                    </ul>
                                </div>
                            </li>

                            {{-- STATISTIQUES & EXPORTS --}}
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuJuridiqueStats" aria-expanded="false">
                                    <span><i class="fa-solid fa-chart-pie me-2"></i> Statistiques & exports</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuJuridiqueStats">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.juridique.statistiques.index') }}"
                                                class="nested-submenu-link">Statistiques</a></li>
                                        <li><a href="{{ route('back.juridique.recherche.index') }}"
                                                class="nested-submenu-link">Recherche</a></li>
                                        <li><a href="{{ route('back.juridique.export.index') }}"
                                                class="nested-submenu-link">Exporter des données</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>




                {{-- Chambre RH --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreRH"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-people-roof"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre ressources humaines</div>
                                <div class="menu-subtext">Personnel, suivi humain, recrutement</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">6</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreRH">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Recrutement</a></li>
                            <li><a href="#" class="submenu-link">Dossiers du personnel</a></li>
                            <li><a href="#" class="submenu-link">Présences</a></li>
                            <li><a href="#" class="submenu-link">Évaluations</a></li>
                            <li><a href="#" class="submenu-link">Discipline</a></li>
                            <li><a href="#" class="submenu-link">Bien-être au travail</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Chambre rénovation & innovation --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreInnovationHub"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre rénovation & innovation</div>
                                <div class="menu-subtext">Améliorations et idées nouvelles</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">5</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreInnovationHub">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Propositions d’amélioration</a></li>
                            <li><a href="#" class="submenu-link">Innovations en cours</a></li>
                            <li><a href="#" class="submenu-link">Réformes internes</a></li>
                            <li><a href="#" class="submenu-link">Expérimentations</a></li>
                            <li><a href="#" class="submenu-link">Suivi des innovations</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Développement --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreDev"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-dark-subtle text-dark">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre développement & programmation</div>
                                <div class="menu-subtext">Code, applications, plateformes</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <span class="badge-pill">7</span>
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuChambreDev">
                        <ul class="submenu">
                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuDevProduction" aria-expanded="false">
                                    <span>Production applicative</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuDevProduction">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-developpement.applications-web.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.applications-web.*') ? 'active' : '' }}">Applications
                                                web</a></li>
                                        <li><a href="{{ route('back.chambre-developpement.applications-mobiles.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.applications-mobiles.*') ? 'active' : '' }}">Applications
                                                mobiles</a></li>
                                        <li><a href="{{ route('back.chambre-developpement.sites-vitrines.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.sites-vitrines.*') ? 'active' : '' }}">Sites
                                                vitrines</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuDevIntegration" aria-expanded="false">
                                    <span>Intégration & livraison</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuDevIntegration">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-developpement.apis-integrations.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.apis-integrations.*') ? 'active' : '' }}">API
                                                & intégrations</a></li>
                                        <li><a href="{{ route('back.chambre-developpement.depots-versions.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.depots-versions.*') ? 'active' : '' }}">Dépôts
                                                et versions</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="submenu-nested-item">
                                <button class="submenu-link submenu-toggle-btn" type="button"
                                    data-target="#menuDevQualite" aria-expanded="false">
                                    <span>Qualité & support</span>
                                    <i class="fa-solid fa-chevron-down submenu-caret"></i>
                                </button>
                                <div class="nested-submenu-wrap" id="menuDevQualite">
                                    <ul class="nested-submenu">
                                        <li><a href="{{ route('back.chambre-developpement.maintenances.toutes') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.maintenances.*') ? 'active' : '' }}">Maintenance</a>
                                        </li>
                                        <li><a href="{{ route('back.chambre-developpement.tests-techniques.tous') }}"
                                                class="nested-submenu-link {{ request()->routeIs('back.chambre-developpement.tests-techniques.*') ? 'active' : '' }}">Tests
                                                techniques</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Autres chambres simples --}}
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button"
                        data-target="#menuChambreOrientations" aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre orientations</div>
                                <div class="menu-subtext">Tâches du jour et directives</div>
                            </div>
                        </div>
                        <div class="menu-right"><span class="badge-pill">5</span><i
                                class="fa-solid fa-chevron-down menu-caret"></i></div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreOrientations">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Tâches du jour</a></li>
                            <li><a href="#" class="submenu-link">Objectifs hebdomadaires</a></li>
                            <li><a href="#" class="submenu-link">Directives générales</a></li>
                            <li><a href="#" class="submenu-link">Répartition des missions</a></li>
                            <li><a href="#" class="submenu-link">Consignes prioritaires</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreQualite"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-magnifying-glass-chart"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre suivi & contrôle qualité</div>
                                <div class="menu-subtext">Vérification, qualité, contrôle</div>
                            </div>
                        </div>
                        <div class="menu-right"><span class="badge-pill">5</span><i
                                class="fa-solid fa-chevron-down menu-caret"></i></div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreQualite">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Contrôle qualité</a></li>
                            <li><a href="#" class="submenu-link">Suivi d’exécution</a></li>
                            <li><a href="#" class="submenu-link">Audits internes</a></li>
                            <li><a href="#" class="submenu-link">Vérifications finales</a></li>
                            <li><a href="#" class="submenu-link">Rapports qualité</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreHebergement"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-server"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre hébergement</div>
                                <div class="menu-subtext">Serveurs, domaines, déploiement</div>
                            </div>
                        </div>
                        <div class="menu-right"><span class="badge-pill">6</span><i
                                class="fa-solid fa-chevron-down menu-caret"></i></div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreHebergement">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Serveurs</a></li>
                            <li><a href="#" class="submenu-link">Domaines</a></li>
                            <li><a href="#" class="submenu-link">Applications hébergées</a></li>
                            <li><a href="#" class="submenu-link">Bases de données</a></li>
                            <li><a href="#" class="submenu-link">Monitoring & uptime</a></li>
                            <li><a href="#" class="submenu-link">Sauvegardes</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreStrategie"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-brain"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre stratégie & vision</div>
                                <div class="menu-subtext">Direction, cap et planification</div>
                            </div>
                        </div>
                        <div class="menu-right"><span class="badge-pill">4</span><i
                                class="fa-solid fa-chevron-down menu-caret"></i></div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreStrategie">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Vision globale</a></li>
                            <li><a href="#" class="submenu-link">Feuille de route</a></li>
                            <li><a href="#" class="submenu-link">Décisions majeures</a></li>
                            <li><a href="#" class="submenu-link">Priorités stratégiques</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreData"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-dark-subtle text-dark">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Chambre data & analyse</div>
                                <div class="menu-subtext">Données, mesures et intelligence</div>
                            </div>
                        </div>
                        <div class="menu-right"><span class="badge-pill">4</span><i
                                class="fa-solid fa-chevron-down menu-caret"></i></div>
                    </button>
                    <div class="submenu-wrap" id="menuChambreData">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Tableaux analytiques</a></li>
                            <li><a href="#" class="submenu-link">Indicateurs clés</a></li>
                            <li><a href="#" class="submenu-link">Rapports d’analyse</a></li>
                            <li><a href="#" class="submenu-link">Prévisions</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <li class="menu-dropdown-item">
                <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambrePartenariat"
                    aria-expanded="false">
                    <div class="menu-left">
                        <div class="menu-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div class="menu-texts">
                            <div class="menu-text">Chambre partenariat & relations</div>
                            <div class="menu-subtext">Réseaux, alliances et collaborations</div>
                        </div>
                    </div>
                    <div class="menu-right">
                        <span class="badge-pill">4</span>
                        <i class="fa-solid fa-chevron-down menu-caret"></i>
                    </div>
                </button>

                <div class="submenu-wrap" id="menuChambrePartenariat">
                    <ul class="submenu">
                        <li><a href="#" class="submenu-link">Partenaires</a></li>
                        <li><a href="#" class="submenu-link">Collaborations</a></li>
                        <li><a href="#" class="submenu-link">Sponsors</a></li>
                        <li><a href="#" class="submenu-link">Relations institutionnelles</a></li>
                    </ul>
                </div>
            </li>

            <li class="menu-dropdown-item">
                <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreProduit"
                    aria-expanded="false">
                    <div class="menu-left">
                        <div class="menu-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-rocket"></i>
                        </div>
                        <div class="menu-texts">
                            <div class="menu-text">Chambre produit & lancement</div>
                            <div class="menu-subtext">Projets, sorties et mise en œuvre</div>
                        </div>
                    </div>
                    <div class="menu-right">
                        <span class="badge-pill">5</span>
                        <i class="fa-solid fa-chevron-down menu-caret"></i>
                    </div>
                </button>

                <div class="submenu-wrap" id="menuChambreProduit">
                    <ul class="submenu">
                        <li><a href="#" class="submenu-link">Produits en cours</a></li>
                        <li><a href="#" class="submenu-link">Lancements</a></li>
                        <li><a href="#" class="submenu-link">Feuilles de produit</a></li>
                        <li><a href="#" class="submenu-link">Tests de sortie</a></li>
                        <li><a href="#" class="submenu-link">Mises en production</a></li>
                    </ul>
                </div>
            </li>

            <li class="menu-dropdown-item">
                <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreFinance"
                    aria-expanded="false">
                    <div class="menu-left">
                        <div class="menu-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div class="menu-texts">
                            <div class="menu-text">Chambre finance & gestion</div>
                            <div class="menu-subtext">Budget, dépenses et organisation</div>
                        </div>
                    </div>
                    <div class="menu-right">
                        <span class="badge-pill">5</span>
                        <i class="fa-solid fa-chevron-down menu-caret"></i>
                    </div>
                </button>

                <div class="submenu-wrap" id="menuChambreFinance">
                    <ul class="submenu">
                        <li><a href="#" class="submenu-link">Budgets</a></li>
                        <li><a href="#" class="submenu-link">Dépenses</a></li>
                        <li><a href="#" class="submenu-link">Prévisions</a></li>
                        <li><a href="#" class="submenu-link">Rentabilité</a></li>
                        <li><a href="#" class="submenu-link">Trésorerie</a></li>
                    </ul>
                </div>
            </li>

            <li class="menu-dropdown-item">
                <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreCyber"
                    aria-expanded="false">
                    <div class="menu-left">
                        <div class="menu-icon bg-danger-subtle text-danger">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="menu-texts">
                            <div class="menu-text">Chambre cybersécurité</div>
                            <div class="menu-subtext">Protection numérique et surveillance</div>
                        </div>
                    </div>
                    <div class="menu-right">
                        <span class="badge-pill">5</span>
                        <i class="fa-solid fa-chevron-down menu-caret"></i>
                    </div>
                </button>

                <div class="submenu-wrap" id="menuChambreCyber">
                    <ul class="submenu">
                        <li><a href="#" class="submenu-link">Surveillance</a></li>
                        <li><a href="#" class="submenu-link">Incidents</a></li>
                        <li><a href="#" class="submenu-link">Audits sécurité</a></li>
                        <li><a href="#" class="submenu-link">Protection des accès</a></li>
                        <li><a href="#" class="submenu-link">Recommandations sécurité</a></li>
                    </ul>
                </div>
            </li>

            {{-- formations  --}}


            {{-- CHAMBRE FORMATION & APPRENTISSAGE --}}
            <li class="menu-dropdown-item">
                <button class="menu-item menu-toggle-btn" type="button" data-target="#menuChambreFormation"
                    aria-expanded="false">
                    <div class="menu-left">
                        <div class="menu-icon bg-info-subtle text-info">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="menu-texts">
                            <div class="menu-text">Chambre formation & apprentissage</div>
                            <div class="menu-subtext">Encadrement, formation, transmission</div>
                        </div>
                    </div>
                    <div class="menu-right">
                        <span class="badge-pill">Formation</span>
                        <i class="fa-solid fa-chevron-down menu-caret"></i>
                    </div>
                </button>

                <div class="submenu-wrap" id="menuChambreFormation">
                    <ul class="submenu">

                        {{-- DASHBOARD --}}
                        <li>
                            <a href="{{ route('back.formation.dashboard') }}"
                                class="submenu-link {{ request()->routeIs('back.formation.dashboard') ? 'active' : '' }}">
                                <i class="fa-solid fa-chart-line me-2"></i>
                                Tableau de bord
                            </a>
                        </li>

                        {{-- CATÉGORIES & MODULES --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationCategoriesModules" aria-expanded="false">
                                <span><i class="fa-solid fa-folder-tree me-2"></i> Catégories & modules</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationCategoriesModules">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.categories-modules.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.categories-modules.*') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Catégories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.modules.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.modules.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-layer-group me-2"></i> Tous les modules
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.modules.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.modules.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Ajouter un module
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- Enseignants & formateurs --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuEnseignants" aria-expanded="false">
                                <span><i class="fas fa-chalkboard-user me-2"></i> Enseignants & formateurs</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuEnseignants">
                                <ul class="nested-submenu">
                                    <li><a href="{{ route('back.formation.enseignants.index') }}"
                                            class="nested-submenu-link">Tous les enseignants</a></li>
                                    <li><a href="{{ route('back.formation.enseignants.create') }}"
                                            class="nested-submenu-link">Ajouter un enseignant</a></li>
                                    <li><a href="{{ route('back.formation.enseignants.actifs') }}"
                                            class="nested-submenu-link">Enseignants actifs</a></li>
                                    <li>
    <a href="{{ route('back.formation.enseignants.assigner') }}"
       class="nested-submenu-link">
        Assigner un cours
    </a>
</li>
                                </ul>
                            </div>
                        </li>

                        {{-- GESTION DES COURS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationCours" aria-expanded="false">
                                <span><i class="fa-solid fa-book me-2"></i> Gestion des cours</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationCours">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.cours.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.cours.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-table-list me-2"></i> Tous les cours
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.cours.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.cours.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Créer un cours
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.cours.publies') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.cours.publies') ? 'active' : '' }}">
                                            <i class="fa-solid fa-eye me-2"></i> Cours publiés
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.cours.brouillons') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.cours.brouillons') ? 'active' : '' }}">
                                            <i class="fa-solid fa-pencil me-2"></i> Cours en brouillon
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.chapitres.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.chapitres.*') ? 'active' : '' }}">
                                            <i class="fa-solid fa-layer-group me-2"></i> Chapitres
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- CONTENUS PÉDAGOGIQUES --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationContenus" aria-expanded="false">
                                <span><i class="fa-solid fa-file-alt me-2"></i> Contenus pédagogiques</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationContenus">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.contenus.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.contenus.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-folder-open me-2"></i> Tous les contenus
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.contenus.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.contenus.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Ajouter un contenu
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.contenus.videos') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.contenus.videos') ? 'active' : '' }}">
                                            <i class="fa-solid fa-video me-2 text-danger"></i> Vidéos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.contenus.documents') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.contenus.documents') ? 'active' : '' }}">
                                            <i class="fa-solid fa-file-pdf me-2 text-primary"></i> Documents
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.contenus.tutoriels') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.contenus.tutoriels') ? 'active' : '' }}">
                                            <i class="fa-solid fa-chalkboard-user me-2 text-purple"></i> Tutoriels
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- ÉLÈVES & INSCRIPTIONS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationInscriptions" aria-expanded="false">
                                <span><i class="fa-solid fa-users me-2"></i> Élèves & inscriptions</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationInscriptions">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.inscriptions.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.inscriptions.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Toutes les inscriptions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.inscriptions.en-attente') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.inscriptions.en-attente') ? 'active' : '' }}">
                                            <i class="fa-solid fa-clock me-2 text-warning"></i> Inscriptions en
                                            attente
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.inscriptions.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.inscriptions.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-user-plus me-2"></i> Nouvelle inscription
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- PRÉSENCES & ACCÈS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationPresences" aria-expanded="false">
                                <span><i class="fa-solid fa-calendar-check me-2"></i> Présences & accès</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationPresences">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.presences.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.presences.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Liste des présences
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.presences.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.presences.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Enregistrer une présence
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.presences.rapport') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.presences.rapport') ? 'active' : '' }}">
                                            <i class="fa-solid fa-chart-bar me-2"></i> Rapport de présence
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.acces-salles.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.acces-salles.*') ? 'active' : '' }}">
                                            <i class="fa-solid fa-door-open me-2"></i> Codes d'accès salles
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- DEVOIRS & ÉVALUATIONS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationDevoirs" aria-expanded="false">
                                <span><i class="fa-solid fa-tasks me-2"></i> Devoirs & évaluations</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationDevoirs">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.devoirs.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.devoirs.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Tous les devoirs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.devoirs.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.devoirs.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Créer un devoir
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.soumissions.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.soumissions.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-inbox me-2"></i> Toutes les soumissions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.soumissions.a-corriger') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.soumissions.a-corriger') ? 'active' : '' }}">
                                            <i class="fa-solid fa-check-double me-2 text-warning"></i> À corriger
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.soumissions.corrigees') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.soumissions.corrigees') ? 'active' : '' }}">
                                            <i class="fa-solid fa-check-circle me-2 text-success"></i> Corrigées
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- SUIVI & PROGRESSION --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationProgression" aria-expanded="false">
                                <span><i class="fa-solid fa-chart-line me-2"></i> Suivi & progression</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationProgression">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.progressions.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.progressions.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-chart-simple me-2"></i> Progression globale
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.progressions.par-module') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.progressions.par-module') ? 'active' : '' }}">
                                            <i class="fa-solid fa-folder-open me-2"></i> Par module
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.progressions.par-eleve') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.progressions.par-eleve') ? 'active' : '' }}">
                                            <i class="fa-solid fa-user-graduate me-2"></i> Par élève
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.progressions.barres') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.progressions.barres') ? 'active' : '' }}">
                                            <i class="fa-solid fa-chart-column me-2"></i> Barres de progression
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- COMMENTAIRES & FEEDBACK --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationCommentaires" aria-expanded="false">
                                <span><i class="fa-solid fa-comments me-2"></i> Commentaires & feedback</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationCommentaires">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.commentaires.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.commentaires.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Tous les commentaires
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.commentaires.en-attente') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.commentaires.en-attente') ? 'active' : '' }}">
                                            <i class="fa-solid fa-clock me-2 text-warning"></i> En attente de
                                            modération
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- NOTIFICATIONS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationNotifications" aria-expanded="false">
                                <span><i class="fa-solid fa-bell me-2"></i> Notifications</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationNotifications">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.notifications.index') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.notifications.index') ? 'active' : '' }}">
                                            <i class="fa-solid fa-list me-2"></i> Toutes les notifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.notifications.non-lues') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.notifications.non-lues') ? 'active' : '' }}">
                                            <i class="fa-solid fa-envelope me-2 text-warning"></i> Non lues
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.notifications.create') }}"
                                            class="nested-submenu-link {{ request()->routeIs('back.formation.notifications.create') ? 'active' : '' }}">
                                            <i class="fa-solid fa-plus me-2"></i> Envoyer une notification
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- RAPPORTS & EXPORTS --}}
                        <li class="submenu-nested-item">
                            <button class="submenu-link submenu-toggle-btn" type="button"
                                data-target="#menuFormationRapports" aria-expanded="false">
                                <span><i class="fa-solid fa-chart-pie me-2"></i> Rapports & exports</span>
                                <i class="fa-solid fa-chevron-down submenu-caret"></i>
                            </button>
                            <div class="nested-submenu-wrap" id="menuFormationRapports">
                                <ul class="nested-submenu">
                                    <li>
                                        <a href="{{ route('back.formation.export.excel', ['type' => 'cours']) }}"
                                            class="nested-submenu-link">
                                            <i class="fa-solid fa-file-excel me-2 text-success"></i> Exporter cours
                                            (Excel)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.export.excel', ['type' => 'inscriptions']) }}"
                                            class="nested-submenu-link">
                                            <i class="fa-solid fa-file-excel me-2 text-success"></i> Exporter
                                            inscriptions (Excel)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.export.excel', ['type' => 'presences']) }}"
                                            class="nested-submenu-link">
                                            <i class="fa-solid fa-file-excel me-2 text-success"></i> Exporter
                                            présences
                                            (Excel)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.formation.export.excel', ['type' => 'progressions']) }}"
                                            class="nested-submenu-link">
                                            <i class="fa-solid fa-file-excel me-2 text-success"></i> Exporter
                                            progressions (Excel)
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            </ul>

            <div class="menu-group-title">Outils transversaux</div>
            <ul class="menu">

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuAgenda"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-primary-subtle text-primary">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Agenda</div>
                                <div class="menu-subtext">Calendrier global du hub</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuAgenda">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Calendrier général</a></li>
                            <li><a href="#" class="submenu-link">Réunions</a></li>
                            <li><a href="#" class="submenu-link">Événements</a></li>
                            <li><a href="#" class="submenu-link">Planification</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuTaches"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-list-ul"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Tâches</div>
                                <div class="menu-subtext">Missions et travail quotidien</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuTaches">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Tâches globales</a></li>
                            <li><a href="#" class="submenu-link">Tâches assignées</a></li>
                            <li><a href="#" class="submenu-link">Suivi d’avancement</a></li>
                            <li><a href="#" class="submenu-link">Historique des tâches</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuMessagerie"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-success-subtle text-success">
                                <i class="fa-regular fa-comments"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Messagerie</div>
                                <div class="menu-subtext">Échanges internes</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuMessagerie">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Boîte interne</a></li>
                            <li><a href="#" class="submenu-link">Discussions d’équipe</a></li>
                            <li><a href="#" class="submenu-link">Canaux par chambre</a></li>
                            <li><a href="#" class="submenu-link">Annonces rapides</a></li>
                        </ul>
                    </div>
                </li>

                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuFichiers"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-info-subtle text-info">
                                <i class="fa-regular fa-folder"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Fichiers partagés</div>
                                <div class="menu-subtext">Documents et ressources du hub</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>
                    <div class="submenu-wrap" id="menuFichiers">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Tous les fichiers</a></li>
                            <li><a href="#" class="submenu-link">Documents partagés</a></li>
                            <li><a href="#" class="submenu-link">Ressources internes</a></li>
                            <li><a href="#" class="submenu-link">Archives</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="menu-group-title">Assistance</div>
            <ul class="menu">
                <li class="menu-dropdown-item">
                    <button class="menu-item menu-toggle-btn" type="button" data-target="#menuAssistance"
                        aria-expanded="false">
                        <div class="menu-left">
                            <div class="menu-icon bg-secondary-subtle text-secondary">
                                <i class="fa-solid fa-circle-question"></i>
                            </div>
                            <div class="menu-texts">
                                <div class="menu-text">Centre d’aide</div>
                                <div class="menu-subtext">Support, documentation, accompagnement</div>
                            </div>
                        </div>
                        <div class="menu-right">
                            <i class="fa-solid fa-chevron-down menu-caret"></i>
                        </div>
                    </button>

                    <div class="submenu-wrap" id="menuAssistance">
                        <ul class="submenu">
                            <li><a href="#" class="submenu-link">Documentation</a></li>
                            <li><a href="#" class="submenu-link">FAQ</a></li>
                            <li><a href="#" class="submenu-link">Support technique</a></li>
                            <li><a href="#" class="submenu-link">Support administratif</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="sidebar-bottom">
                <div class="profile-card">
                    <div class="profile-left">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=11b1ad&color=fff&size=128"
                            alt="Profil" class="profile-avatar">
                        <div class="profile-meta">
                            <div class="profile-name">{{ auth()->user()->name ?? 'John Doe' }}</div>
                            <div class="profile-role">Administrateur principal</div>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <button class="circle-btn" type="button" title="Paramètres rapides">
                            <i class="fa-solid fa-gear"></i>
                        </button>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="circle-btn text-danger" type="submit" title="Déconnexion">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <ul class="menu">
                    <li class="menu-dropdown-item">
                        <button class="menu-item menu-toggle-btn" type="button" data-target="#menuCorbeille"
                            aria-expanded="false">
                            <div class="menu-left">
                                <div class="menu-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                                <div class="menu-texts">
                                    <div class="menu-text">Corbeille</div>
                                    <div class="menu-subtext">Éléments supprimés</div>
                                </div>
                            </div>
                            <div class="menu-right">
                                <span class="badge-pill">5</span>
                                <i class="fa-solid fa-chevron-down menu-caret"></i>
                            </div>
                        </button>

                        <div class="submenu-wrap" id="menuCorbeille">
                            <ul class="submenu">
                                <li><a href="#" class="submenu-link">Articles supprimés</a></li>
                                <li><a href="#" class="submenu-link">Utilisateurs supprimés</a></li>
                                <li><a href="#" class="submenu-link">Médias supprimés</a></li>
                                <li><a href="#" class="submenu-link">Pages supprimées</a></li>
                                <li><a href="#" class="submenu-link">Vider la corbeille</a></li>
                            </ul>
                        </div>
                    </li>










                </ul>

                <div class="support-box">
                    <div class="support-left">
                        <div class="support-icon">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="support-content">
                            <div class="support-title">Support EUNITAL</div>
                            <div class="support-text">Assistance technique et administrative</div>
                        </div>
                    </div>
                    <button class="circle-btn" type="button" title="Ouvrir le support">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</aside>

















<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;

        const buttons = sidebar.querySelectorAll('.menu-toggle-btn, .submenu-toggle-btn');

        function getTarget(button) {
            const selector = button.getAttribute('data-target');
            if (!selector) return null;
            return document.querySelector(selector);
        }

        function setExpanded(button, open) {
            button.setAttribute('aria-expanded', open ? 'true' : 'false');

            const caret = button.querySelector('.menu-caret, .submenu-caret');
            if (caret) {
                caret.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        }

        function openMenu(button, target) {
            target.classList.add('show');
            setExpanded(button, true);
        }

        function closeMenu(button, target) {
            target.classList.remove('show');
            setExpanded(button, false);
        }

        function toggleMenu(button, target) {
            if (target.classList.contains('show')) {
                closeMenu(button, target);
            } else {
                openMenu(button, target);
            }
        }

        /* Tout fermer au départ */
        sidebar.querySelectorAll('.submenu-wrap, .nested-submenu-wrap').forEach(menu => {
            menu.classList.remove('show');
        });

        buttons.forEach(button => {
            const target = getTarget(button);
            if (!target) return;

            setExpanded(button, false);

            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMenu(button, target);
            });
        });

        /* bouton réduction du sidebar */
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
        if (sidebarCollapseBtn) {
            sidebarCollapseBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        }
    });
</script>

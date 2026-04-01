<header class="topbar">
    <div class="mobile-search-panel" id="mobileSearchPanel">
        <div class="mobile-search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Recherche">
            <button type="button" id="mobileSearchClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Ouvrir le menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="search-box" id="desktopSearchBox">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Rechercher...">
            <div class="search-shortcut">/</div>
        </div>

        <button class="mobile-search-toggle" id="mobileSearchToggle" type="button" aria-label="Ouvrir la recherche">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>

    <div class="topbar-right">
        <div class="topbar-dropdown mobile-only">
            <button class="top-icon topbar-dropdown-toggle" type="button" data-dropdown="mobile-actions"
                id="topbarMoreToggle" title="Plus d’actions">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>

            <div class="topbar-popup topbar-popup-mobile-actions" id="dropdown-mobile-actions">
                <div class="topbar-popup-header">
                    <h6>Actions rapides</h6>
                </div>

                <div class="topbar-popup-body p-0">
                    <button class="popup-list-item topbar-dropdown-toggle" type="button" data-dropdown="langue">
                        <div class="popup-list-left">
                            <span class="popup-flag">🇺🇸</span>
                            <span>Langue</span>
                        </div>
                    </button>

                    <button class="popup-list-item topbar-dropdown-toggle" type="button" data-dropdown="apps">
                        <div class="popup-list-left">
                            <i class="fa-solid fa-table-cells"></i>
                            <span>Accès rapides</span>
                        </div>
                    </button>

                    <button class="popup-list-item" type="button" id="themeToggleMobile">
                        <div class="popup-list-left">
                            <i class="fa-regular fa-moon" id="themeToggleMobileIcon"></i>
                            <span>Thème</span>
                        </div>
                    </button>

                    <button class="popup-list-item topbar-dropdown-toggle" type="button" data-dropdown="messages">
                        <div class="popup-list-left">
                            <i class="fa-regular fa-message"></i>
                            <span>Messages</span>
                        </div>
                    </button>

                    <button class="popup-list-item topbar-dropdown-toggle" type="button" data-dropdown="notifications">
                        <div class="popup-list-left">
                            <i class="fa-regular fa-bell"></i>
                            <span>Notifications</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        {{-- Barre groupée des 5 actions --}}
        <div class="topbar-actions-group">


            {{-- Langue --}}
            <div class="topbar-dropdown">
                <button class="top-icon lang-btn topbar-dropdown-toggle" type="button" data-dropdown="langue"
                    title="Langue">
                    <span>🇺🇸</span>
                </button>

                <div class="topbar-popup" id="dropdown-langue">
                    <div class="topbar-popup-header">
                        <h6>Langue</h6>
                    </div>

                    <div class="topbar-popup-body p-0">
                        <button class="popup-list-item active" type="button">
                            <div class="popup-list-left">
                                <span class="popup-flag">🇺🇸</span>
                                <span>Anglais</span>
                            </div>
                            <i class="fa-solid fa-check"></i>
                        </button>

                        <button class="popup-list-item" type="button">
                            <div class="popup-list-left">
                                <span class="popup-flag">🇫🇷</span>
                                <span>Français</span>
                            </div>
                        </button>

                        <button class="popup-list-item" type="button">
                            <div class="popup-list-left">
                                <span class="popup-flag">🇩🇪</span>
                                <span>Allemand</span>
                            </div>
                        </button>

                        <button class="popup-list-item" type="button">
                            <div class="popup-list-left">
                                <span class="popup-flag">🇪🇸</span>
                                <span>Espagnol</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Accès rapides --}}
            <div class="topbar-dropdown">
                <button class="top-icon topbar-dropdown-toggle" type="button" data-dropdown="apps"
                    title="Accès rapides">
                    <i class="fa-solid fa-table-cells"></i>
                </button>

                <div class="topbar-popup topbar-popup-lg" id="dropdown-apps">
                    <div class="topbar-popup-header">
                        <h6>Accès rapides</h6>
                    </div>

                    <div class="topbar-popup-body">
                        <div class="quick-grid">
                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-info-subtle text-info">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <span>Agenda</span>
                            </a>

                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-primary-subtle text-primary">
                                    <i class="fa-regular fa-comments"></i>
                                </div>
                                <span>Chat</span>
                            </a>

                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-success-subtle text-success">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <span>Email</span>
                            </a>

                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-warning-subtle text-warning">
                                    <i class="fa-solid fa-table-columns"></i>
                                </div>
                                <span>Kanban</span>
                            </a>

                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-info-subtle text-info">
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                                <span>Fichiers</span>
                            </a>

                            <a href="#" class="quick-item">
                                <div class="quick-icon bg-secondary-subtle text-secondary">
                                    <i class="fa-solid fa-headset"></i>
                                </div>
                                <span>Support</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Thème --}}
            <div class="topbar-dropdown">
                <button class="top-icon" id="themeToggle" type="button" title="Thème sombre / clair">
                    <i class="fa-regular fa-moon" id="themeToggleIcon"></i>
                </button>
            </div>

            {{-- Messages --}}
            <div class="topbar-dropdown">
                <button class="top-icon topbar-dropdown-toggle" type="button" data-dropdown="messages"
                    title="Messages">
                    <i class="fa-regular fa-message"></i>
                    <span class="notif-badge">5</span>
                </button>

                <div class="topbar-popup topbar-popup-xl" id="dropdown-messages">
                    <div class="topbar-popup-header d-flex justify-content-between align-items-start">
                        <div>
                            <h6>Messages</h6>
                            <small>5 nouveaux messages</small>
                        </div>
                        <a href="#" class="popup-link-action">Ouvrir le chat</a>
                    </div>

                    <div class="topbar-popup-scroll">
                        <a href="#" class="message-item">
                            <div class="message-dot"></div>
                            <img src="https://ui-avatars.com/api/?name=Mia+Rodriguez&background=e2e8f0&color=334155"
                                alt="Mia">
                            <div class="message-content">
                                <div class="message-name">Mia Rodriguez</div>
                                <div class="message-text">Peux-tu relire la maquette analytique aujourd’hui ?</div>
                                <div class="message-time">Il y a 2 min</div>
                            </div>
                        </a>

                        <a href="#" class="message-item">
                            <div class="message-dot"></div>
                            <img src="https://ui-avatars.com/api/?name=Dev+Channel&background=e2e8f0&color=334155"
                                alt="Dev">
                            <div class="message-content">
                                <div class="message-name">Canal Dev</div>
                                <div class="message-text">Le build est terminé. Prêt pour la mise en production.</div>
                                <div class="message-time">Il y a 12 min</div>
                            </div>
                        </a>

                        <a href="#" class="message-item">
                            <div class="message-dot"></div>
                            <img src="https://ui-avatars.com/api/?name=Sarah+Kim&background=e2e8f0&color=334155"
                                alt="Sarah">
                            <div class="message-content">
                                <div class="message-name">Sarah Kim</div>
                                <div class="message-text">A partagé un fichier : Q1-forecast-report.pdf</div>
                                <div class="message-time">Il y a 35 min</div>
                            </div>
                        </a>
                    </div>

                    <div class="topbar-popup-footer">
                        <a href="#" class="popup-footer-link">Voir tous les messages <i
                                class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>

            {{-- Notifications --}}
            <div class="topbar-dropdown">
                <button class="top-icon topbar-dropdown-toggle" type="button" data-dropdown="notifications"
                    title="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-badge">4</span>
                </button>

                <div class="topbar-popup topbar-popup-xl" id="dropdown-notifications">
                    <div class="topbar-popup-header d-flex justify-content-between align-items-start">
                        <div>
                            <h6>Notifications</h6>
                            <small>4 non lues</small>
                        </div>
                        <a href="#" class="popup-link-action">Tout marquer comme lu</a>
                    </div>

                    <div class="topbar-popup-scroll">
                        <a href="#" class="notif-item">
                            <div class="notif-dot"></div>
                            <div class="notif-icon bg-info-subtle text-info">
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">Déploiement prêt</div>
                                <div class="notif-text">La version Sprint 24 a passé les contrôles qualité.</div>
                                <div class="notif-time">Il y a 5 min</div>
                            </div>
                        </a>

                        <a href="#" class="notif-item">
                            <div class="notif-dot"></div>
                            <img class="notif-avatar"
                                src="https://ui-avatars.com/api/?name=Mia&background=e2e8f0&color=334155"
                                alt="Mia">
                            <div class="notif-content">
                                <div class="notif-title">Mia a envoyé un retour</div>
                                <div class="notif-text">Merci de vérifier la hiérarchie de la carte dashboard.</div>
                                <div class="notif-time">Il y a 21 min</div>
                            </div>
                        </a>

                        <a href="#" class="notif-item">
                            <div class="notif-dot"></div>
                            <div class="notif-icon bg-warning-subtle text-warning">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">Seuil de stockage</div>
                                <div class="notif-text">Le bucket média a atteint 81% d’utilisation.</div>
                                <div class="notif-time">Il y a 58 min</div>
                            </div>
                        </a>

                        <a href="#" class="notif-item">
                            <div class="notif-dot"></div>
                            <div class="notif-icon bg-success-subtle text-success">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">Paiement reçu</div>
                                <div class="notif-text">La facture #INV-3921 a été réglée avec succès.</div>
                                <div class="notif-time">Il y a 2 h</div>
                            </div>
                        </a>
                    </div>

                    <div class="topbar-popup-footer">
                        <a href="#" class="popup-footer-link">Ouvrir le centre de notifications <i
                                class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="top-divider"></div>

        {{-- Profil --}}
        <div class="topbar-dropdown">
            <button class="user-summary user-summary-btn topbar-dropdown-toggle" type="button"
                data-dropdown="profil">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'John Doe') }}&background=0f172a&color=fff&size=128"
                    alt="User">
                <div class="user-summary-text">
                    <div class="user-summary-name">{{ auth()->user()->name ?? 'John Doe' }}</div>
                    <div class="user-summary-role">Administrateur produit</div>
                </div>
                <i class="fa-solid fa-angle-down user-summary-caret"></i>
            </button>

            <div class="topbar-popup topbar-popup-profile" id="dropdown-profil">
                <div class="profile-popup-head">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'John Doe') }}&background=0f172a&color=fff&size=128"
                        alt="User">
                    <div>
                        <div class="profile-popup-name">{{ auth()->user()->name ?? 'John Doe' }}</div>
                        <div class="profile-popup-email">john.doe@example.com</div>
                    </div>
                </div>

                <div class="profile-popup-body">
                    <a href="#" class="profile-popup-link">
                        <span class="profile-popup-icon"><i class="fa-regular fa-user"></i></span>
                        <span>Mon profil</span>
                    </a>

                    <a href="#" class="profile-popup-link">
                        <span class="profile-popup-icon"><i class="fa-solid fa-sliders"></i></span>
                        <span>Préférences</span>
                    </a>

                    <a href="#" class="profile-popup-link">
                        <span class="profile-popup-icon"><i class="fa-solid fa-wave-square"></i></span>
                        <span>Journal d’activité</span>
                    </a>

                    <a href="#" class="profile-popup-link">
                        <span class="profile-popup-icon"><i class="fa-regular fa-credit-card"></i></span>
                        <span>Facturation</span>
                    </a>
                </div>

                <div class="profile-popup-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="profile-signout-btn">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>

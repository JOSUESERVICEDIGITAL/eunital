<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-2">
        <ul class="nav nav-pills flex-column flex-md-row">
            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.chambre-formation.dashboard') ? 'active' : '' }}"
                   href="{{ route('back.chambre-formation.dashboard') }}">
                    <i class="fas fa-chart-line mr-1"></i> Dashboard
                </a>
            </li>

            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.formation.categories.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.categories.index') }}">
                    <i class="fas fa-tags mr-1"></i> Catégories
                </a>
            </li>

            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.formation.modules.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.modules.index') }}">
                    <i class="fas fa-cubes mr-1"></i> Modules
                </a>
            </li>

            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.formation.cours.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.cours.index') }}">
                    <i class="fas fa-book mr-1"></i> Cours
                </a>
            </li>

            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.formation.inscriptions.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.inscriptions.index') }}">
                    <i class="fas fa-user-graduate mr-1"></i> Inscriptions
                </a>
            </li>

            <li class="nav-item mb-2 mb-md-0 mr-md-2">
                <a class="nav-link {{ request()->routeIs('back.formation.presences.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.presences.index') }}">
                    <i class="fas fa-user-check mr-1"></i> Présences
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('back.formation.contenus.*') ? 'active' : '' }}"
                   href="{{ route('back.formation.contenus.index') }}">
                    <i class="fas fa-photo-video mr-1"></i> Contenus
                </a>
            </li>
        </ul>
    </div>
</div>

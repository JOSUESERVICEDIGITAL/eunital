<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-graduation-cap text-primary mr-2"></i>
            Chambre formation
        </h5>
    </div>

    <div class="list-group list-group-flush">
        <a href="{{ route('back.chambre-formation.dashboard') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.chambre-formation.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie mr-2"></i> Tableau de bord
        </a>

        <a href="{{ route('back.formation.categories.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags mr-2"></i> Catégories
        </a>

        <a href="{{ route('back.formation.modules.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.modules.*') ? 'active' : '' }}">
            <i class="fas fa-cubes mr-2"></i> Modules
        </a>

        <a href="{{ route('back.formation.cours.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.cours.*') ? 'active' : '' }}">
            <i class="fas fa-book-open mr-2"></i> Cours
        </a>

        <a href="{{ route('back.formation.chapitres.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.chapitres.*') ? 'active' : '' }}">
            <i class="fas fa-stream mr-2"></i> Chapitres
        </a>

        <a href="{{ route('back.formation.contenus.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.contenus.*') ? 'active' : '' }}">
            <i class="fas fa-file-video mr-2"></i> Contenus
        </a>

        <a href="{{ route('back.formation.devoirs.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.devoirs.*') ? 'active' : '' }}">
            <i class="fas fa-tasks mr-2"></i> Devoirs
        </a>

        <a href="{{ route('back.formation.inscriptions.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.inscriptions.*') ? 'active' : '' }}">
            <i class="fas fa-user-plus mr-2"></i> Inscriptions
        </a>

        <a href="{{ route('back.formation.presences.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.presences.*') ? 'active' : '' }}">
            <i class="fas fa-user-check mr-2"></i> Présences
        </a>

        <a href="{{ route('back.formation.acces-salles.index') }}"
           class="list-group-item list-group-item-action {{ request()->routeIs('back.formation.acces-salles.*') ? 'active' : '' }}">
            <i class="fas fa-door-open mr-2"></i> Accès salles
        </a>
    </div>
</div>

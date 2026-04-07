<ul class="nav nav-tabs mb-3" id="juridiqueTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('back.juridique.dashboard') ? 'active' : '' }}" 
           href="{{ route('back.juridique.dashboard') }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="documentsDropdown" role="button" data-toggle="dropdown">
            <i class="fas fa-file-alt"></i> Documents
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('back.juridique.documents.index') }}">Tous les documents</a>
            <a class="dropdown-item" href="{{ route('back.juridique.documents.create') }}">Nouveau document</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('back.juridique.documents.brouillons') }}">Brouillons</a>
            <a class="dropdown-item" href="{{ route('back.juridique.documents.en-attente') }}">En attente</a>
            <a class="dropdown-item" href="{{ route('back.juridique.documents.signes') }}">Signés</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('back.juridique.contrats.*') ? 'active' : '' }}" 
           href="{{ route('back.juridique.contrats.index') }}">
            <i class="fas fa-handshake"></i> Contrats
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('back.juridique.signatures.*') ? 'active' : '' }}" 
           href="{{ route('back.juridique.signatures.index') }}">
            <i class="fas fa-pen"></i> Signatures
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('back.juridique.modeles.*') ? 'active' : '' }}" 
           href="{{ route('back.juridique.modeles.index') }}">
            <i class="fas fa-copy"></i> Modèles
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('back.juridique.entreprises.*') ? 'active' : '' }}" 
           href="{{ route('back.juridique.entreprises.index') }}">
            <i class="fas fa-building"></i> Entreprises
        </a>
    </li>
</ul>
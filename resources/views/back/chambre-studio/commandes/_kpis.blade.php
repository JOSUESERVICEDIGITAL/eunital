@php
    $total = $commandes->count();
    $enAttente = $commandes->where('statut', 'en_attente')->count();
    $enCours = $commandes->where('statut', 'en_cours')->count();
    $livrees = $commandes->where('statut', 'livre')->count();
    $mariages = $commandes->where('type', 'mariage')->count();
    $multimedia = $commandes->where('type', 'multimedia')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Commandes</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-file-signature"></i>
            </div>
        </div>
        <div class="text-muted small">Total des commandes studio enregistrées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">En attente</div>
                <div class="stat-number">{{ $enAttente }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
        <div class="text-muted small">Demandes reçues en attente de validation.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">En cours</div>
                <div class="stat-number">{{ $enCours }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-gears"></i>
            </div>
        </div>
        <div class="text-muted small">Commandes en production ou exécution.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Livrées</div>
                <div class="stat-number">{{ $livrees }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
        <div class="text-muted small">Prestations finalisées et remises.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Mariages</div>
                <div class="stat-number">{{ $mariages }}</div>
            </div>
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-heart"></i>
            </div>
        </div>
        <div class="text-muted small">Commandes liées aux cérémonies et mariages.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Multimédia</div>
                <div class="stat-number">{{ $multimedia }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-photo-film"></i>
            </div>
        </div>
        <div class="text-muted small">Commandes photo, vidéo et contenus multimédias.</div>
    </div>
</div>
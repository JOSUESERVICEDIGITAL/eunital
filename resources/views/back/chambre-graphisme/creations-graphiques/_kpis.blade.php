@php
    $total = $creations->count();
    $brouillons = $creations->where('statut', 'brouillon')->count();
    $enCours = $creations->where('statut', 'en_cours')->count();
    $validations = $creations->where('statut', 'validation')->count();
    $livrees = $creations->where('statut', 'livre')->count();
    $avecClient = $creations->filter(fn($creation) => !empty($creation->client_studio_id))->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Créations</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-pen-ruler"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des créations graphiques.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Brouillons</div>
                <div class="stat-number">{{ $brouillons }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-file"></i>
            </div>
        </div>
        <div class="text-muted small">Créations encore en préparation.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">En cours</div>
                <div class="stat-number">{{ $enCours }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-pen"></i>
            </div>
        </div>
        <div class="text-muted small">Travaux actuellement en production.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Validation</div>
                <div class="stat-number">{{ $validations }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-check-double"></i>
            </div>
        </div>
        <div class="text-muted small">Créations soumises à validation.</div>
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
        <div class="text-muted small">Créations finalisées et remises.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec client</div>
                <div class="stat-number">{{ $avecClient }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-user-group"></i>
            </div>
        </div>
        <div class="text-muted small">Créations liées à un client studio.</div>
    </div>
</div>
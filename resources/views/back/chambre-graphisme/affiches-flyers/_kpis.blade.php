@php
    $total = $affiches->count();
    $affichesCount = $affiches->where('type', 'affiche')->count();
    $flyersCount = $affiches->where('type', 'flyer')->count();
    $creations = $affiches->where('statut', 'creation')->count();
    $validations = $affiches->where('statut', 'validation')->count();
    $livres = $affiches->where('statut', 'livre')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Supports</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-file-image"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des affiches et flyers.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Affiches</div>
                <div class="stat-number">{{ $affichesCount }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-rectangle-list"></i>
            </div>
        </div>
        <div class="text-muted small">Supports de communication grand format.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Flyers</div>
                <div class="stat-number">{{ $flyersCount }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-file-lines"></i>
            </div>
        </div>
        <div class="text-muted small">Supports courts et promotionnels.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Création</div>
                <div class="stat-number">{{ $creations }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-pen"></i>
            </div>
        </div>
        <div class="text-muted small">Supports encore en production.</div>
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
        <div class="text-muted small">Supports soumis à validation.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Livrés</div>
                <div class="stat-number">{{ $livres }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
        <div class="text-muted small">Supports finalisés et remis.</div>
    </div>
</div>
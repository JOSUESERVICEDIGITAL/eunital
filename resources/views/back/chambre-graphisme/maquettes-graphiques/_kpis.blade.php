@php
    $total = $maquettes->count();
    $creations = $maquettes->where('statut', 'creation')->count();
    $validations = $maquettes->where('statut', 'validation')->count();
    $livrees = $maquettes->where('statut', 'livre')->count();
    $avecSupport = $maquettes->filter(fn($maquette) => !empty($maquette->support))->count();
    $avecFichier = $maquettes->filter(fn($maquette) => !empty($maquette->fichier))->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Maquettes</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-cubes"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des maquettes graphiques.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Création</div>
                <div class="stat-number">{{ $creations }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-pen"></i>
            </div>
        </div>
        <div class="text-muted small">Maquettes en cours de production.</div>
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
        <div class="text-muted small">Maquettes soumises à validation.</div>
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
        <div class="text-muted small">Maquettes finalisées et remises.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec support</div>
                <div class="stat-number">{{ $avecSupport }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>
        <div class="text-muted small">Maquettes liées à un support défini.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec fichier</div>
                <div class="stat-number">{{ $avecFichier }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-file"></i>
            </div>
        </div>
        <div class="text-muted small">Maquettes avec fichier ou export renseigné.</div>
    </div>
</div>
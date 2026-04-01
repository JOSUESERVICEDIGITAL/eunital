@php
    $total = $designs->count();
    $wireframes = $designs->where('type', 'wireframe')->count();
    $maquettes = $designs->where('type', 'maquette')->count();
    $prototypes = $designs->where('type', 'prototype')->count();
    $conception = $designs->where('statut', 'conception')->count();
    $valides = $designs->where('statut', 'valide')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Designs</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-object-group"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des travaux UI/UX.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Wireframes</div>
                <div class="stat-number">{{ $wireframes }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-vector-square"></i>
            </div>
        </div>
        <div class="text-muted small">Structures et zonings d’interfaces.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Maquettes</div>
                <div class="stat-number">{{ $maquettes }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
        </div>
        <div class="text-muted small">Interfaces haute fidélité prêtes à revue.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Prototypes</div>
                <div class="stat-number">{{ $prototypes }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-diagram-project"></i>
            </div>
        </div>
        <div class="text-muted small">Simulations interactives des parcours.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Conception</div>
                <div class="stat-number">{{ $conception }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-pen"></i>
            </div>
        </div>
        <div class="text-muted small">Designs en phase de construction.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Validés</div>
                <div class="stat-number">{{ $valides }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="text-muted small">Designs validés et prêts au développement.</div>
    </div>
</div>
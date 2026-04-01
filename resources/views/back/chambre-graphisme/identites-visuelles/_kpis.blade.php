@php
    $total = $identites->count();
    $creations = $identites->where('statut', 'creation')->count();
    $validations = $identites->where('statut', 'validation')->count();
    $terminees = $identites->where('statut', 'termine')->count();
    $avecLogo = $identites->filter(fn($identite) => !empty($identite->logo))->count();
    $avecClient = $identites->filter(fn($identite) => !empty($identite->client_studio_id))->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Identités</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-fingerprint"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des identités visuelles.</div>
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
        <div class="text-muted small">Identités en construction.</div>
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
        <div class="text-muted small">Identités en cours de validation.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Terminées</div>
                <div class="stat-number">{{ $terminees }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-award"></i>
            </div>
        </div>
        <div class="text-muted small">Identités visuelles finalisées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec logo</div>
                <div class="stat-number">{{ $avecLogo }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-image"></i>
            </div>
        </div>
        <div class="text-muted small">Identités contenant un logo.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec client</div>
                <div class="stat-number">{{ $avecClient }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-user-group"></i>
            </div>
        </div>
        <div class="text-muted small">Identités liées à un client studio.</div>
    </div>
</div>
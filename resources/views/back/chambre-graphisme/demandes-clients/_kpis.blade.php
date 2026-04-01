@php
    $total = $demandes->count();
    $enAttente = $demandes->where('statut', 'en_attente')->count();
    $enCours = $demandes->where('statut', 'en_cours')->count();
    $terminees = $demandes->where('statut', 'termine')->count();
    $urgentes = $demandes->where('priorite', 'urgente')->count();
    $branding = $demandes->where('type', 'branding')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Demandes</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des demandes clients.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">En attente</div>
                <div class="stat-number">{{ $enAttente }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
        <div class="text-muted small">Demandes en attente de prise en charge.</div>
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
        <div class="text-muted small">Demandes en cours de production.</div>
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
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="text-muted small">Demandes clôturées et finalisées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Urgentes</div>
                <div class="stat-number">{{ $urgentes }}</div>
            </div>
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-bolt"></i>
            </div>
        </div>
        <div class="text-muted small">Demandes à forte priorité.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Branding</div>
                <div class="stat-number">{{ $branding }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-fingerprint"></i>
            </div>
        </div>
        <div class="text-muted small">Demandes liées au branding.</div>
    </div>
</div>

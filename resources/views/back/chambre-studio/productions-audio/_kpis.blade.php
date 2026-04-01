@php
    $total = $audios->count();
    $enregistrement = $audios->where('statut', 'enregistrement')->count();
    $mixage = $audios->where('statut', 'mixage')->count();
    $mastering = $audios->where('statut', 'mastering')->count();
    $livrees = $audios->where('statut', 'livre')->count();
    $dureeTotale = $audios->sum('duree');
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Sessions</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-wave-square"></i>
            </div>
        </div>
        <div class="text-muted small">Total de toutes les sessions audio du studio.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Enregistrement</div>
                <div class="stat-number">{{ $enregistrement }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-microphone"></i>
            </div>
        </div>
        <div class="text-muted small">Sessions actuellement en prise audio.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Mixage</div>
                <div class="stat-number">{{ $mixage }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-sliders"></i>
            </div>
        </div>
        <div class="text-muted small">Projets en traitement et équilibrage sonore.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Mastering</div>
                <div class="stat-number">{{ $mastering }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-compact-disc"></i>
            </div>
        </div>
        <div class="text-muted small">Versions proches du rendu final client.</div>
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
        <div class="text-muted small">Productions déjà terminées et remises.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Durée totale</div>
                <div class="stat-number">{{ $dureeTotale }}</div>
            </div>
            <div class="stat-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>
        <div class="text-muted small">Somme indicative des durées de sessions.</div>
    </div>
</div>
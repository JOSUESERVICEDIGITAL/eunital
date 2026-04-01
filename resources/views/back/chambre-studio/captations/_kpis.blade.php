@php
    $total = $captations->count();
    $planifiees = $captations->where('statut', 'planifie')->count();
    $enCours = $captations->where('statut', 'en_cours')->count();
    $terminees = $captations->where('statut', 'termine')->count();
    $mariages = $captations->where('type', 'mariage')->count();
    $evenements = $captations->where('type', 'evenement')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Captations</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-camera-retro"></i>
            </div>
        </div>
        <div class="text-muted small">Total des captations studio enregistrées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Planifiées</div>
                <div class="stat-number">{{ $planifiees }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div class="text-muted small">Captations programmées à venir.</div>
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
                <i class="fa-solid fa-video"></i>
            </div>
        </div>
        <div class="text-muted small">Captations actuellement en exécution.</div>
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
        <div class="text-muted small">Captations finalisées sur le terrain.</div>
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
        <div class="text-muted small">Captations dédiées aux mariages.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Événements</div>
                <div class="stat-number">{{ $evenements }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>
        <div class="text-muted small">Captations d’événements hors mariage.</div>
    </div>
</div>
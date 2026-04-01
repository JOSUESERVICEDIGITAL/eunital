@php
    $total = $visuels->count();
    $programmes = $visuels->where('statut', 'programme')->count();
    $publies = $visuels->where('statut', 'publie')->count();
    $instagram = $visuels->where('plateforme', 'instagram')->count();
    $facebook = $visuels->where('plateforme', 'facebook')->count();
    $youtube = $visuels->where('plateforme', 'youtube')->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Visuels</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-share-nodes"></i>
            </div>
        </div>
        <div class="text-muted small">Volume global des visuels réseaux sociaux.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Programmés</div>
                <div class="stat-number">{{ $programmes }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>
        <div class="text-muted small">Visuels planifiés pour publication.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Publiés</div>
                <div class="stat-number">{{ $publies }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-check-circle"></i>
            </div>
        </div>
        <div class="text-muted small">Visuels déjà diffusés.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Instagram</div>
                <div class="stat-number">{{ $instagram }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
        <div class="text-muted small">Contenus destinés à Instagram.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Facebook</div>
                <div class="stat-number">{{ $facebook }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-brands fa-facebook-f"></i>
            </div>
        </div>
        <div class="text-muted small">Contenus conçus pour Facebook.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">YouTube</div>
                <div class="stat-number">{{ $youtube }}</div>
            </div>
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="fa-brands fa-youtube"></i>
            </div>
        </div>
        <div class="text-muted small">Miniatures et visuels YouTube.</div>
    </div>
</div>
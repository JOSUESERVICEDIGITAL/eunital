@php
    $total = $engagements->count();
    $attente = $engagements->where('statut', 'en_attente')->count();
    $etude = $engagements->where('statut', 'en_etude')->count();
    $valides = $engagements->where('statut', 'valide')->count();
    $rejetes = $engagements->where('statut', 'rejete')->count();
    $archives = $engagements->where('statut', 'archive')->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div class="engagement-kpi-value">{{ $total }}</div>
            <div class="engagement-kpi-label">Engagements</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="engagement-kpi-value">{{ $attente }}</div>
            <div class="engagement-kpi-label">En attente</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="engagement-kpi-value">{{ $etude }}</div>
            <div class="engagement-kpi-label">En étude</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="engagement-kpi-value">{{ $valides }}</div>
            <div class="engagement-kpi-label">Validés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="engagement-kpi-value">{{ $rejetes }}</div>
            <div class="engagement-kpi-label">Rejetés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="engagement-kpi-card">
            <div class="engagement-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div class="engagement-kpi-value">{{ $archives }}</div>
            <div class="engagement-kpi-label">Archivés</div>
        </div>
    </div>
</div>

<style>
    .engagement-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .engagement-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .engagement-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .engagement-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>

@php
    $total = $documents->count();
    $brouillons = $documents->where('statut', 'brouillon')->count();
    $actifs = $documents->where('statut', 'actif')->count();
    $archives = $documents->where('statut', 'archive')->count();
    $chartes = $documents->where('categorie', 'charte')->count();
    $procedures = $documents->where('categorie', 'procedure')->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div class="document-kpi-value">{{ $total }}</div>
            <div class="document-kpi-label">Documents</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-file"></i>
            </div>
            <div class="document-kpi-value">{{ $brouillons }}</div>
            <div class="document-kpi-label">Brouillons</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="document-kpi-value">{{ $actifs }}</div>
            <div class="document-kpi-label">Actifs</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div class="document-kpi-value">{{ $archives }}</div>
            <div class="document-kpi-label">Archivés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-scroll"></i>
            </div>
            <div class="document-kpi-value">{{ $chartes }}</div>
            <div class="document-kpi-label">Chartes</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="document-kpi-card">
            <div class="document-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div class="document-kpi-value">{{ $procedures }}</div>
            <div class="document-kpi-label">Procédures</div>
        </div>
    </div>
</div>

<style>
    .document-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .document-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .document-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .document-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>

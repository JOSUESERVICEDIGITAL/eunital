@php
    $total = $modeles->count();
    $actifs = $modeles->where('actif', true)->count();
    $inactifs = $modeles->where('actif', false)->count();
    $contrats = $modeles->where('type_document', 'contrat')->count();
    $engagements = $modeles->where('type_document', 'engagement')->count();
    $conventions = $modeles->where('type_document', 'convention')->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="modele-kpi-value">{{ $total }}</div>
            <div class="modele-kpi-label">Modèles</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-toggle-on"></i>
            </div>
            <div class="modele-kpi-value">{{ $actifs }}</div>
            <div class="modele-kpi-label">Actifs</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-toggle-off"></i>
            </div>
            <div class="modele-kpi-value">{{ $inactifs }}</div>
            <div class="modele-kpi-label">Inactifs</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="modele-kpi-value">{{ $contrats }}</div>
            <div class="modele-kpi-label">Contrats</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div class="modele-kpi-value">{{ $engagements }}</div>
            <div class="modele-kpi-label">Engagements</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="modele-kpi-card">
            <div class="modele-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-scroll"></i>
            </div>
            <div class="modele-kpi-value">{{ $conventions }}</div>
            <div class="modele-kpi-label">Conventions</div>
        </div>
    </div>
</div>

<style>
    .modele-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .modele-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .modele-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .modele-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>

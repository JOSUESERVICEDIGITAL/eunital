@php
    $total = $dossiers->count();
    $ouverts = $dossiers->where('statut', 'ouvert')->count();
    $enCours = $dossiers->where('statut', 'en_cours')->count();
    $fermes = $dossiers->where('statut', 'ferme')->count();
    $urgents = $dossiers->where('priorite', 'urgente')->count();
    $litiges = $dossiers->where('type_dossier', 'litige')->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="dossier-kpi-value">{{ $total }}</div>
            <div class="dossier-kpi-label">Dossiers</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div class="dossier-kpi-value">{{ $ouverts }}</div>
            <div class="dossier-kpi-label">Ouverts</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-spinner"></i>
            </div>
            <div class="dossier-kpi-value">{{ $enCours }}</div>
            <div class="dossier-kpi-label">En cours</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="dossier-kpi-value">{{ $fermes }}</div>
            <div class="dossier-kpi-label">Fermés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <div class="dossier-kpi-value">{{ $urgents }}</div>
            <div class="dossier-kpi-label">Urgents</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="dossier-kpi-card">
            <div class="dossier-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div class="dossier-kpi-value">{{ $litiges }}</div>
            <div class="dossier-kpi-label">Litiges</div>
        </div>
    </div>
</div>

<style>
    .dossier-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .dossier-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .dossier-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .dossier-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>

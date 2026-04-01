@php
    $total = $contrats->count();
    $brouillons = $contrats->where('statut', 'brouillon')->count();
    $valides = $contrats->where('statut', 'valide')->count();
    $signes = $contrats->where('statut', 'signe')->count();
    $archives = $contrats->where('statut', 'archive')->count();
    $montantTotal = $contrats->sum('montant');
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="juridique-kpi-value">{{ $total }}</div>
            <div class="juridique-kpi-label">Contrats</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-file"></i>
            </div>
            <div class="juridique-kpi-value">{{ $brouillons }}</div>
            <div class="juridique-kpi-label">Brouillons</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="juridique-kpi-value">{{ $valides }}</div>
            <div class="juridique-kpi-label">Validés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-signature"></i>
            </div>
            <div class="juridique-kpi-value">{{ $signes }}</div>
            <div class="juridique-kpi-label">Signés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div class="juridique-kpi-value">{{ $archives }}</div>
            <div class="juridique-kpi-label">Archivés</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="juridique-kpi-card">
            <div class="juridique-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div class="juridique-kpi-value">{{ number_format($montantTotal, 0, ',', ' ') }}</div>
            <div class="juridique-kpi-label">Montant cumulé</div>
        </div>
    </div>
</div>

<style>
    .juridique-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .juridique-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .juridique-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .juridique-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>

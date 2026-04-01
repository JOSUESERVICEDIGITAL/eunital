@php
    $totalCampagnes = $campagnes->total() ?? $campagnes->count();
    $actives = $campagnes->where('statut', 'active')->count();
    $enPause = $campagnes->where('statut', 'en_pause')->count();
    $terminees = $campagnes->where('statut', 'terminee')->count();
    $budgetTotal = $campagnes->sum('budget');
    $budgetConsomme = $campagnes->sum('budget_consomme');
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="marketing-kpi-value">{{ $totalCampagnes }}</div>
            <div class="marketing-kpi-label">Campagnes</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-circle-play"></i>
            </div>
            <div class="marketing-kpi-value">{{ $actives }}</div>
            <div class="marketing-kpi-label">Actives</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-circle-pause"></i>
            </div>
            <div class="marketing-kpi-value">{{ $enPause }}</div>
            <div class="marketing-kpi-label">En pause</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-flag-checkered"></i>
            </div>
            <div class="marketing-kpi-value">{{ $terminees }}</div>
            <div class="marketing-kpi-label">Terminées</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div class="marketing-kpi-value">{{ number_format($budgetTotal, 0, ',', ' ') }}</div>
            <div class="marketing-kpi-label">Budget total</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="marketing-kpi-card">
            <div class="marketing-kpi-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="marketing-kpi-value">{{ number_format($budgetConsomme, 0, ',', ' ') }}</div>
            <div class="marketing-kpi-label">Consommé</div>
        </div>
    </div>
</div>

<style>
    .marketing-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:22px;
        padding:20px;
        box-shadow:0 10px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .marketing-kpi-icon{
        width:52px;
        height:52px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:18px;
        margin-bottom:14px;
    }
    .marketing-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .marketing-kpi-label{
        margin-top:8px;
        font-size:14px;
        color:#64748b;
        font-weight:600;
    }
</style>

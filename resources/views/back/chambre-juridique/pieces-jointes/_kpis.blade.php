@php
    $total = $pieces->count();
    $contrats = $pieces->whereNotNull('contrat_juridique_id')->count();
    $engagements = $pieces->whereNotNull('engagement_juridique_id')->count();
    $dossiers = $pieces->whereNotNull('dossier_juridique_id')->count();
    $archives = $pieces->whereNotNull('archive_hub_id')->count();
    $preuves = $pieces->where('type_piece', 'preuve')->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-paperclip"></i>
            </div>
            <div class="piece-kpi-value">{{ $total }}</div>
            <div class="piece-kpi-label">Pièces</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div class="piece-kpi-value">{{ $contrats }}</div>
            <div class="piece-kpi-label">Contrats</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div class="piece-kpi-value">{{ $engagements }}</div>
            <div class="piece-kpi-label">Engagements</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="piece-kpi-value">{{ $dossiers }}</div>
            <div class="piece-kpi-label">Dossiers</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-landmark"></i>
            </div>
            <div class="piece-kpi-value">{{ $archives }}</div>
            <div class="piece-kpi-label">Archives</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="piece-kpi-card">
            <div class="piece-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="piece-kpi-value">{{ $preuves }}</div>
            <div class="piece-kpi-label">Preuves</div>
        </div>
    </div>
</div>

<style>
    .piece-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .piece-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .piece-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .piece-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>
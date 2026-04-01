@php
    $total = $archives->count();
    $fondations = $archives->where('categorie', 'fondation')->count();
    $inaugurations = $archives->where('categorie', 'inauguration')->count();
    $medias = $archives->whereIn('type_fichier', ['image', 'video', 'audio'])->count();
    $visibles = $archives->where('visible', true)->count();
    $cachees = $archives->where('visible', false)->count();
@endphp

<div class="row g-4">
    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-landmark"></i>
            </div>
            <div class="archive-kpi-value">{{ $total }}</div>
            <div class="archive-kpi-label">Archives</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-building-columns"></i>
            </div>
            <div class="archive-kpi-value">{{ $fondations }}</div>
            <div class="archive-kpi-label">Fondations</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-ribbon"></i>
            </div>
            <div class="archive-kpi-value">{{ $inaugurations }}</div>
            <div class="archive-kpi-label">Inaugurations</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-photo-film"></i>
            </div>
            <div class="archive-kpi-value">{{ $medias }}</div>
            <div class="archive-kpi-label">Médias</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-eye"></i>
            </div>
            <div class="archive-kpi-value">{{ $visibles }}</div>
            <div class="archive-kpi-label">Visibles</div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="archive-kpi-card">
            <div class="archive-kpi-icon bg-secondary-subtle text-secondary">
                <i class="fa-solid fa-eye-slash"></i>
            </div>
            <div class="archive-kpi-value">{{ $cachees }}</div>
            <div class="archive-kpi-label">Masquées</div>
        </div>
    </div>
</div>

<style>
    .archive-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }
    .archive-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }
    .archive-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }
    .archive-kpi-label{
        margin-top:8px;
        color:#64748b;
        font-weight:600;
        font-size:14px;
    }
</style>
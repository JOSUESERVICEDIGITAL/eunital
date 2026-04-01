@php
    $total = $videos->count();
    $tournage = $videos->where('statut', 'tournage')->count();
    $montage = $videos->where('statut', 'montage')->count();
    $validation = $videos->where('statut', 'validation')->count();
    $livrees = $videos->where('statut', 'livre')->count();
    $mariages = $videos->where('type', 'mariage')->count();

    $safeTotal = max($total, 1);

    $pctTournage = round(($tournage / $safeTotal) * 100);
    $pctMontage = round(($montage / $safeTotal) * 100);
    $pctValidation = round(($validation / $safeTotal) * 100);
    $pctLivrees = round(($livrees / $safeTotal) * 100);
    $pctMariages = round(($mariages / $safeTotal) * 100);
@endphp

<div class="row g-4">

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-clapperboard"></i>
            </div>
            <div class="video-kpi-value">{{ $total }}</div>
            <div class="video-kpi-label">Productions</div>
            <div class="video-kpi-meta">Total de toutes les productions vidéo actives et archivées.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-dark" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="video-kpi-value">{{ $tournage }}</div>
            <div class="video-kpi-label">Tournage</div>
            <div class="video-kpi-meta">Sessions en cours de captation ou de réalisation terrain.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-primary" style="width: {{ $pctTournage }}%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-scissors"></i>
            </div>
            <div class="video-kpi-value">{{ $montage }}</div>
            <div class="video-kpi-label">Montage</div>
            <div class="video-kpi-meta">Productions actuellement en post-production et assemblage.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-warning" style="width: {{ $pctMontage }}%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-info-subtle text-info">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="video-kpi-value">{{ $validation }}</div>
            <div class="video-kpi-label">Validation</div>
            <div class="video-kpi-meta">Éléments prêts pour relecture, validation interne ou client.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-info" style="width: {{ $pctValidation }}%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-success-subtle text-success">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="video-kpi-value">{{ $livrees }}</div>
            <div class="video-kpi-label">Livrées</div>
            <div class="video-kpi-meta">Productions finalisées et remises aux clients ou publiées.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-success" style="width: {{ $pctLivrees }}%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="video-kpi-card">
            <div class="video-kpi-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-heart"></i>
            </div>
            <div class="video-kpi-value">{{ $mariages }}</div>
            <div class="video-kpi-label">Mariages</div>
            <div class="video-kpi-meta">Productions liées aux cérémonies, unions et événements privés.</div>
            <div class="video-kpi-progress">
                <div class="video-kpi-bar bg-danger" style="width: {{ $pctMariages }}%"></div>
            </div>
        </div>
    </div>

</div>

<style>
    .video-kpi-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:24px;
        padding:20px;
        box-shadow:0 12px 30px rgba(15,23,42,.05);
        height:100%;
    }

    .video-kpi-icon{
        width:54px;
        height:54px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        margin-bottom:14px;
    }

    .video-kpi-value{
        font-size:28px;
        font-weight:800;
        color:#0f172a;
        line-height:1;
    }

    .video-kpi-label{
        margin-top:8px;
        color:#334155;
        font-weight:700;
        font-size:14px;
    }

    .video-kpi-meta{
        margin-top:8px;
        color:#64748b;
        font-size:12px;
        line-height:1.5;
        min-height:54px;
    }

    .video-kpi-progress{
        margin-top:14px;
        height:8px;
        background:#e5e7eb;
        border-radius:999px;
        overflow:hidden;
    }

    .video-kpi-bar{
        height:100%;
        border-radius:999px;
    }
</style>
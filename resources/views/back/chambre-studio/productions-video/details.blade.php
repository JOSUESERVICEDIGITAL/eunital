@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="video-detail-hero mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="video-detail-icon">
                        <i class="fa-solid fa-clapperboard"></i>
                    </div>
                    <div>
                        <h2 class="text-white mb-1">{{ $productionVideo->titre }}</h2>
                        <p class="text-white-50 mb-0">
                            {{ $productionVideo->client->nom ?? 'Client non défini' }} · {{ ucfirst($productionVideo->type) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <a href="{{ route('back.chambre-studio.productions-video.modifier', $productionVideo) }}"
                       class="btn btn-warning rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-outline-light rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsVideo{{ $productionVideo->id }}">
                        Centre vidéo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <h5 class="mb-1">Informations générales</h5>
                            <small class="text-muted">Vue détaillée de la production et de ses liaisons studio.</small>
                        </div>

                        <a href="{{ route('back.chambre-studio.productions-video.toutes') }}"
                           class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            Retour à la liste
                        </a>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Client</div>
                                <div class="video-detail-value">{{ $productionVideo->client->nom ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Projet</div>
                                <div class="video-detail-value">{{ $productionVideo->projet->titre ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Type</div>
                                <div class="video-detail-value">{{ ucfirst($productionVideo->type) }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Statut</div>
                                <div class="video-detail-value">
                                    @php
                                        $statusLabel = match($productionVideo->statut) {
                                            'tournage' => 'Tournage',
                                            'montage' => 'Montage',
                                            'validation' => 'Validation',
                                            'livre' => 'Livrée',
                                            'archive' => 'Archivée',
                                            default => ucfirst($productionVideo->statut),
                                        };
                                    @endphp
                                    {{ $statusLabel }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Auteur</div>
                                <div class="video-detail-value">{{ $productionVideo->auteur->name ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Description</div>
                                <div class="video-detail-value">{{ $productionVideo->description ?: 'Aucune description.' }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Fichier vidéo</div>
                                <div class="video-detail-value">{{ $productionVideo->fichier_video ?: 'Non renseigné.' }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="video-detail-box">
                                <div class="video-detail-label">Montages liés</div>
                                <div class="video-detail-value">
                                    @forelse($productionVideo->montages as $montage)
                                        <div class="montage-mini-item">
                                            <div class="fw-semibold">{{ $montage->titre }}</div>
                                            <div class="small text-muted">{{ ucfirst($montage->statut) }}</div>
                                        </div>
                                    @empty
                                        Aucun montage lié.
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Actions métier</h5>

                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('back.chambre-studio.productions-video.livrer', $productionVideo) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success w-100 rounded-pill">
                                Marquer comme livrée
                            </button>
                        </form>

                        <a href="{{ route('back.chambre-studio.productions-video.modifier', $productionVideo) }}"
                           class="btn btn-outline-primary w-100 rounded-pill">
                            Modifier la production
                        </a>

                        <a href="{{ route('back.chambre-studio.montages.tous') }}"
                           class="btn btn-outline-secondary w-100 rounded-pill">
                            Ouvrir pipeline montage
                        </a>

                        <a href="{{ route('back.chambre-studio.dashboard') }}"
                           class="btn btn-outline-dark w-100 rounded-pill">
                            Dashboard studio
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Bloc résumé</h5>

                    <div class="summary-mini-box mb-3">
                        <div class="summary-mini-label">Client</div>
                        <div class="summary-mini-value">{{ $productionVideo->client->nom ?? '—' }}</div>
                    </div>

                    <div class="summary-mini-box mb-3">
                        <div class="summary-mini-label">Projet</div>
                        <div class="summary-mini-value">{{ $productionVideo->projet->titre ?? '—' }}</div>
                    </div>

                    <div class="summary-mini-box">
                        <div class="summary-mini-label">Statut actuel</div>
                        <div class="summary-mini-value">{{ $statusLabel }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('back.chambre-studio.productions-video._modales', ['productionVideo' => $productionVideo])

</div>

<style>
    .video-detail-hero{
        background:linear-gradient(135deg, #111827 0%, #1f2937 55%, #dc2626 100%);
        padding:28px;
        border-radius:28px;
        box-shadow:0 18px 45px rgba(15,23,42,.18);
    }

    .video-detail-icon{
        width:72px;
        height:72px;
        border-radius:22px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
        color:#fff;
        background:rgba(255,255,255,.12);
        border:1px solid rgba(255,255,255,.15);
    }

    .video-detail-box{
        border:1px solid #e5e7eb;
        background:#f8fafc;
        border-radius:18px;
        padding:16px;
        height:100%;
    }

    .video-detail-label{
        font-size:12px;
        color:#64748b;
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:6px;
    }

    .video-detail-value{
        font-weight:700;
        color:#0f172a;
        white-space:pre-line;
    }

    .montage-mini-item{
        border:1px solid #e5e7eb;
        background:#fff;
        border-radius:14px;
        padding:10px 12px;
        margin-bottom:10px;
    }

    .summary-mini-box{
        background:#f8fafc;
        border:1px solid #e5e7eb;
        border-radius:16px;
        padding:14px;
    }

    .summary-mini-label{
        font-size:12px;
        color:#64748b;
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:6px;
    }

    .summary-mini-value{
        font-weight:700;
        color:#0f172a;
    }
</style>
@endsection
@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="video-hero-card mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="video-hero-icon">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Chambre Studio · Productions Vidéo</h2>
                        <p class="mb-0 text-white-50">
                            Clips, spots, interviews, mariages, cérémonies, tournages événementiels et livraisons clients.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-studio.productions-video.toutes') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-video.toutes') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Toutes
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.tournage') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-video.tournage') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Tournage
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.montage') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-video.montage') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Montage
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.validation') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-video.validation') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Validation
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.livrees') }}"
                       class="btn btn-sm rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.productions-video.livrees') ? 'btn-light text-dark fw-semibold' : 'btn-outline-light' }}">
                        Livrées
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <a href="{{ route('back.chambre-studio.dashboard') }}"
                       class="btn btn-outline-light btn-lg rounded-pill px-4">
                        Dashboard studio
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.creer') }}"
                       class="btn btn-warning btn-lg rounded-pill px-4 fw-semibold">
                        + Nouvelle production vidéo
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Raccourcis rapides --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4 col-xl-3">
            <a href="{{ route('back.chambre-studio.productions-video.creer') }}" class="quick-video-link text-decoration-none">
                <div class="quick-video-card">
                    <div class="quick-video-icon bg-danger-subtle text-danger">
                        <i class="fa-solid fa-clapperboard"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Nouvelle production</div>
                        <div class="small text-muted">Créer une nouvelle fiche vidéo</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-3">
            <a href="{{ route('back.chambre-studio.montages.tous') }}" class="quick-video-link text-decoration-none">
                <div class="quick-video-card">
                    <div class="quick-video-icon bg-warning-subtle text-warning">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Montages</div>
                        <div class="small text-muted">Voir le pipeline de post-production</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-3">
            <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="quick-video-link text-decoration-none">
                <div class="quick-video-card">
                    <div class="quick-video-icon bg-primary-subtle text-primary">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Commandes</div>
                        <div class="small text-muted">Suivre les demandes clients</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-xl-3">
            <a href="{{ route('back.chambre-studio.evenements.tous') }}" class="quick-video-link text-decoration-none">
                <div class="quick-video-card">
                    <div class="quick-video-icon bg-success-subtle text-success">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Événements</div>
                        <div class="small text-muted">Mariages, cérémonies, captations</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @include('back.chambre-studio.productions-video._kpis', ['videos' => $videos])

    <div class="mt-4">
        @include('back.chambre-studio.productions-video._liste-table', ['videos' => $videos])
    </div>

</div>

<style>
    .video-hero-card{
        background: linear-gradient(135deg, #111827 0%, #1e293b 45%, #dc2626 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }

    .video-hero-icon{
        width:72px;
        height:72px;
        border-radius:22px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(255,255,255,.12);
        color:#fff;
        font-size:28px;
        border:1px solid rgba(255,255,255,.15);
    }

    .quick-video-card{
        display:flex;
        align-items:center;
        gap:14px;
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:20px;
        padding:16px;
        box-shadow:0 10px 25px rgba(15,23,42,.05);
        transition:.2s ease;
        height:100%;
    }

    .quick-video-card:hover{
        transform:translateY(-2px);
        box-shadow:0 14px 30px rgba(15,23,42,.08);
    }

    .quick-video-icon{
        width:52px;
        height:52px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        flex-shrink:0;
    }
</style>
@endsection
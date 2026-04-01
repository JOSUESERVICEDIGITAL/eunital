@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="video-page-header mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="video-page-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div>
                <h3 class="mb-1">Modifier la production vidéo</h3>
                <p class="text-muted mb-0">
                    Mets à jour la fiche de production, le client, le projet, le statut ou les livrables vidéo.
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('back.chambre-studio.productions-video.update', $productionVideo) }}">
                        @csrf
                        @method('PUT')

                        @include('back.chambre-studio.productions-video._form')

                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                                Mettre à jour
                            </button>

                            <a href="{{ route('back.chambre-studio.productions-video.details', $productionVideo) }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                Retour à la fiche
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3">Résumé rapide</h5>

                    <div class="summary-block mb-3">
                        <div class="summary-label">Titre</div>
                        <div class="summary-value">{{ $productionVideo->titre }}</div>
                    </div>

                    <div class="summary-block mb-3">
                        <div class="summary-label">Client</div>
                        <div class="summary-value">{{ $productionVideo->client->nom ?? '—' }}</div>
                    </div>

                    <div class="summary-block mb-3">
                        <div class="summary-label">Projet</div>
                        <div class="summary-value">{{ $productionVideo->projet->titre ?? '—' }}</div>
                    </div>

                    <div class="summary-block mb-3">
                        <div class="summary-label">Statut actuel</div>
                        <div class="summary-value">{{ ucfirst($productionVideo->statut) }}</div>
                    </div>

                    <div class="summary-block">
                        <div class="summary-label">Type</div>
                        <div class="summary-value">{{ ucfirst($productionVideo->type) }}</div>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="{{ route('back.chambre-studio.productions-video.details', $productionVideo) }}"
                           class="btn btn-outline-dark rounded-pill">
                            Voir la fiche complète
                        </a>

                        <button type="button"
                                class="btn btn-outline-secondary rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsVideo{{ $productionVideo->id }}">
                            Ouvrir centre vidéo
                        </button>
                    </div>

                    @include('back.chambre-studio.productions-video._modales', ['productionVideo' => $productionVideo])
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .video-page-icon{
        width:58px;
        height:58px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        flex-shrink:0;
    }

    .summary-block{
        background:#f8fafc;
        border:1px solid #e5e7eb;
        border-radius:18px;
        padding:14px;
    }

    .summary-label{
        font-size:12px;
        color:#64748b;
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:6px;
    }

    .summary-value{
        font-weight:700;
        color:#0f172a;
    }
</style>
@endsection
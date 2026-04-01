@extends('back.layouts.principal')

@section('title', 'Détails production audio')
@section('page_title', 'Fiche détaillée · Production audio')
@section('page_subtitle', 'Consulte les informations complètes, le statut et les actions métier de la session audio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Session</div>
                        <h4 class="mb-0">{{ $productionAudio->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-studio.productions-audio.modifier', $productionAudio) }}"
                            class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                            class="btn btn-dark rounded-pill px-3"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsAudio{{ $productionAudio->id }}">
                            Centre audio
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $productionAudio->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Projet</div>
                            <div class="fw-semibold">{{ $productionAudio->projet->titre ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($productionAudio->type) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Durée</div>
                            <div class="fw-semibold">{{ $productionAudio->duree ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst($productionAudio->statut) }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $productionAudio->description ?: 'Aucune description.' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Fichier audio</div>
                            <div class="fw-semibold">{{ $productionAudio->fichier_audio ?: 'Non renseigné.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement audio</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-studio.productions-audio.envoyer_en_mixage', $productionAudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-warning rounded-pill w-100">Envoyer en mixage</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.productions-audio.envoyer_en_mastering', $productionAudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-info rounded-pill w-100">Envoyer en mastering</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.productions-audio.livrer', $productionAudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.productions-audio.archiver', $productionAudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-dark rounded-pill w-100">Archiver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.productions-audio._modales', ['productionAudio' => $productionAudio])
@endsection
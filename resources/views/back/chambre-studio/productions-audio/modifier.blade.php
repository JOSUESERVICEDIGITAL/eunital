@extends('back.layouts.principal')

@section('title', 'Modifier production audio')
@section('page_title', 'Modifier une session audio')
@section('page_subtitle', 'Mets à jour les informations, le statut et les livrables d’une session audio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.productions-audio.update', $productionAudio) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-studio.productions-audio._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-pen me-1"></i> Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-studio.productions-audio.details', $productionAudio) }}"
                            class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Session actuelle</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $productionAudio->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $productionAudio->client->nom ?? '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Projet</div>
                    <div class="fw-semibold">{{ $productionAudio->projet->titre ?? '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst($productionAudio->statut) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
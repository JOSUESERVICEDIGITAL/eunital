@extends('back.layouts.principal')

@section('title', 'Modifier support graphique')
@section('page_title', 'Modifier une affiche ou un flyer')
@section('page_subtitle', 'Mets à jour les informations, le fichier et le statut du support.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.affiches.update', $affiche) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-graphisme.affiches-flyers._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-graphisme.affiches.details', $affiche) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Support actuel</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $affiche->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Type</div>
                    <div class="fw-semibold">{{ ucfirst($affiche->type) }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $affiche->client->nom ?? '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst($affiche->statut) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
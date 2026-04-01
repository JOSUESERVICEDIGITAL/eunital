@extends('back.layouts.principal')

@section('title', 'Modifier création graphique')
@section('page_title', 'Modifier une création graphique')
@section('page_subtitle', 'Mets à jour les informations, le statut et les associations de la création.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.creations.update', $creation) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-graphisme.creations-graphiques._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-graphisme.creations.details', $creation) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Création actuelle</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $creation->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Type</div>
                    <div class="fw-semibold">{{ ucfirst($creation->type) }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $creation->client->nom ?? '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $creation->statut)) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
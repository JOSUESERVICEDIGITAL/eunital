@extends('back.layouts.principal')

@section('title', 'Modifier visuel social')
@section('page_title', 'Modifier un visuel réseau social')
@section('page_subtitle', 'Mets à jour les informations, la plateforme et le planning de publication.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.social.update', $visuel) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-graphisme.visuels-reseaux-sociaux._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-graphisme.social.details', $visuel) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Visuel actuel</h5>

                <div class="mb-3">
                    <div class="mini-label">Titre</div>
                    <div class="fw-semibold">{{ $visuel->titre }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Plateforme</div>
                    <div class="fw-semibold">{{ ucfirst($visuel->plateforme) }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $visuel->client->nom ?? '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst($visuel->statut) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
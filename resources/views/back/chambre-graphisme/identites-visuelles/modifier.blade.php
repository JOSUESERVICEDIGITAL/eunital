@extends('back.layouts.principal')

@section('title', 'Modifier identité visuelle')
@section('page_title', 'Modifier une identité visuelle')
@section('page_subtitle', 'Mets à jour les éléments de marque, les choix graphiques et le statut.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-graphisme.identites.update', $identite) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-graphisme.identites-visuelles._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-graphisme.identites.details', $identite) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Identité actuelle</h5>

                <div class="mb-3">
                    <div class="mini-label">Nom</div>
                    <div class="fw-semibold">{{ $identite->nom }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $identite->client->nom ?? '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Palette</div>
                    <div class="fw-semibold">{{ $identite->palette_couleurs ?: '—' }}</div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $identite->statut)) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
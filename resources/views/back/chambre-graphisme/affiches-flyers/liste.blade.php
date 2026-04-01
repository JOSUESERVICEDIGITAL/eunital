@extends('back.layouts.principal')

@section('title', 'Affiches et flyers')
@section('page_title', 'Chambre Graphisme · Affiches & flyers')
@section('page_subtitle', 'Gestion des supports imprimés et promotionnels du hub et des clients.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.affiches-flyers._kpis', ['affiches' => $affiches])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline affiches & flyers</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.affiches.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouveau support
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.affiches.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.affiches.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Tous
            </a>

            <a href="{{ route('back.chambre-graphisme.affiches.affiches') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.affiches.affiches') ? 'btn-primary' : 'btn-outline-primary' }}">
                Affiches
            </a>

            <a href="{{ route('back.chambre-graphisme.affiches.flyers') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.affiches.flyers') ? 'btn-warning' : 'btn-outline-warning' }}">
                Flyers
            </a>

            <a href="{{ route('back.chambre-graphisme.affiches.livres') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.affiches.livres') ? 'btn-success' : 'btn-outline-success' }}">
                Livrés
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.affiches-flyers._liste-table', ['affiches' => $affiches])
@endsection
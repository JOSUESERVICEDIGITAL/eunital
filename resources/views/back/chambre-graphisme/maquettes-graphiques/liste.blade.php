@extends('back.layouts.principal')

@section('title', 'Maquettes graphiques')
@section('page_title', 'Chambre Graphisme · Maquettes graphiques')
@section('page_subtitle', 'Gestion des mockups, présentations de supports et simulations visuelles prêtes à validation ou livraison.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.maquettes-graphiques._kpis', ['maquettes' => $maquettes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des maquettes graphiques</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.maquettes.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouvelle maquette
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.maquettes.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.maquettes.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-graphisme.maquettes.creations') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.maquettes.creations') ? 'btn-warning' : 'btn-outline-warning' }}">
                En création
            </a>

            <a href="{{ route('back.chambre-graphisme.maquettes.validations') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.maquettes.validations') ? 'btn-info' : 'btn-outline-info' }}">
                En validation
            </a>

            <a href="{{ route('back.chambre-graphisme.maquettes.livrees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.maquettes.livrees') ? 'btn-success' : 'btn-outline-success' }}">
                Livrées
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.maquettes-graphiques._liste-table', ['maquettes' => $maquettes])
@endsection

@extends('back.layouts.principal')

@section('title', 'Designs UI/UX')
@section('page_title', 'Chambre Graphisme · UI / UX Designs')
@section('page_subtitle', 'Gestion des wireframes, maquettes et prototypes pour les interfaces du hub et des clients.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.uiux-designs._kpis', ['designs' => $designs])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline UI / UX</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.uiux.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouveau design
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.uiux.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.uiux.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Tous
            </a>

            <a href="{{ route('back.chambre-graphisme.uiux.wireframes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.uiux.wireframes') ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Wireframes
            </a>

            <a href="{{ route('back.chambre-graphisme.uiux.maquettes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.uiux.maquettes') ? 'btn-primary' : 'btn-outline-primary' }}">
                Maquettes
            </a>

            <a href="{{ route('back.chambre-graphisme.uiux.prototypes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.uiux.prototypes') ? 'btn-info' : 'btn-outline-info' }}">
                Prototypes
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.uiux-designs._liste-table', ['designs' => $designs])
@endsection
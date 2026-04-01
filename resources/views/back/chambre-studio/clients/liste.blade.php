@extends('back.layouts.principal')

@section('title', 'Clients studio')
@section('page_title', 'Chambre Studio · Clients')
@section('page_subtitle', 'Gestion des artistes, entreprises et particuliers liés aux activités du studio.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.clients._kpis', ['clients' => $clients])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Base clients studio</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Dashboard studio
                </a>

                <a href="{{ route('back.chambre-studio.clients.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouveau client
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-studio.clients.tous') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.clients.tous') ? 'btn-dark' : 'btn-outline-dark' }}">
                Tous
            </a>

            <a href="{{ route('back.chambre-studio.clients.artistes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.clients.artistes') ? 'btn-primary' : 'btn-outline-primary' }}">
                Artistes
            </a>

            <a href="{{ route('back.chambre-studio.clients.entreprises') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.clients.entreprises') ? 'btn-success' : 'btn-outline-success' }}">
                Entreprises
            </a>
        </div>
    </div>

    @include('back.chambre-studio.clients._liste-table', ['clients' => $clients])
@endsection
@extends('back.layouts.principal')

@section('title', 'Clients particuliers')
@section('page_title', 'Chambre Studio · Clients particuliers')
@section('page_subtitle', 'Liste des clients particuliers liés aux prestations privées, mariages et événements du studio.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.clients._kpis', ['clients' => $clients])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Clients particuliers</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.clients.tous') }}" class="btn btn-light rounded-pill px-3">
                    Tous les clients
                </a>

                <a href="{{ route('back.chambre-studio.clients.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouveau client
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.clients._liste-table', ['clients' => $clients])
@endsection

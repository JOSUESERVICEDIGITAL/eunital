@extends('back.layouts.principal')

@section('title', 'Captations en cours')
@section('page_title', 'Chambre Studio · Captations en cours')
@section('page_subtitle', 'Liste des captations en exécution sur le terrain.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.captations._kpis', ['captations' => $captations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Captations en cours</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.captations.toutes') }}" class="btn btn-light rounded-pill px-3">
                    Toutes les captations
                </a>
                <a href="{{ route('back.chambre-studio.captations.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle captation
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.captations._liste-table', ['captations' => $captations])
@endsection
@extends('back.layouts.principal')

@section('title', 'Réservations du jour')
@section('page_title', 'Chambre Studio · Réservations du jour')
@section('page_subtitle', 'Liste des réservations prévues aujourd’hui dans le studio.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.reservations._kpis', ['reservations' => $reservations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Réservations du jour</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.reservations.toutes') }}" class="btn btn-light rounded-pill px-3">
                    Toutes les réservations
                </a>

                <a href="{{ route('back.chambre-studio.reservations.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle réservation
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.reservations._liste-table', ['reservations' => $reservations])
@endsection
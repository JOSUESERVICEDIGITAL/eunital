@extends('back.layouts.principal')

@section('title', 'Réservations studio')
@section('page_title', 'Chambre Studio · Réservations')
@section('page_subtitle', 'Gestion des réservations de salles, sessions studio et disponibilités.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.reservations._kpis', ['reservations' => $reservations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des réservations</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Dashboard studio
                </a>

                <a href="{{ route('back.chambre-studio.reservations.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle réservation
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-studio.reservations.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.reservations.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-studio.reservations.reservees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.reservations.reservees') ? 'btn-warning' : 'btn-outline-warning' }}">
                Réservées
            </a>

            <a href="{{ route('back.chambre-studio.reservations.confirmees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.reservations.confirmees') ? 'btn-success' : 'btn-outline-success' }}">
                Confirmées
            </a>

            <a href="{{ route('back.chambre-studio.reservations.annulees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.reservations.annulees') ? 'btn-danger' : 'btn-outline-danger' }}">
                Annulées
            </a>

            <a href="{{ route('back.chambre-studio.reservations.aujourdhui') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.reservations.aujourdhui') ? 'btn-primary' : 'btn-outline-primary' }}">
                Aujourd’hui
            </a>
        </div>
    </div>

    @include('back.chambre-studio.reservations._liste-table', ['reservations' => $reservations])
@endsection
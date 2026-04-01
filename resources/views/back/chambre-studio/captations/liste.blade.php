@extends('back.layouts.principal')

@section('title', 'Captations studio')
@section('page_title', 'Chambre Studio · Captations')
@section('page_subtitle', 'Gestion des captations terrain, mariages, concerts, conférences et événements du hub.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.captations._kpis', ['captations' => $captations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des captations</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Dashboard studio
                </a>

                <a href="{{ route('back.chambre-studio.captations.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle captation
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-studio.captations.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-studio.captations.planifiees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.planifiees') ? 'btn-primary' : 'btn-outline-primary' }}">
                Planifiées
            </a>

            <a href="{{ route('back.chambre-studio.captations.en_cours') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.en_cours') ? 'btn-warning' : 'btn-outline-warning' }}">
                En cours
            </a>

            <a href="{{ route('back.chambre-studio.captations.terminees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.terminees') ? 'btn-success' : 'btn-outline-success' }}">
                Terminées
            </a>

            <a href="{{ route('back.chambre-studio.captations.mariages') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.mariages') ? 'btn-danger' : 'btn-outline-danger' }}">
                Mariages
            </a>

            <a href="{{ route('back.chambre-studio.captations.evenements') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.captations.evenements') ? 'btn-info' : 'btn-outline-info' }}">
                Événements
            </a>
        </div>
    </div>

    @include('back.chambre-studio.captations._liste-table', ['captations' => $captations])
@endsection
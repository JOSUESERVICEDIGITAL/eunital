@extends('back.layouts.principal')

@section('title', 'Créations graphiques')
@section('page_title', 'Chambre Graphisme · Créations graphiques')
@section('page_subtitle', 'Gestion des créations graphiques internes et clients : branding, affiches, visuels, UI/UX et livrables.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.creations-graphiques._kpis', ['creations' => $creations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des créations graphiques</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.creations.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouvelle création
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.creations.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.creations.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-graphisme.creations.brouillons') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.creations.brouillons') ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Brouillons
            </a>

            <a href="{{ route('back.chambre-graphisme.creations.en_cours') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.creations.en_cours') ? 'btn-warning' : 'btn-outline-warning' }}">
                En cours
            </a>

            <a href="{{ route('back.chambre-graphisme.creations.validations') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.creations.validations') ? 'btn-info' : 'btn-outline-info' }}">
                Validations
            </a>

            <a href="{{ route('back.chambre-graphisme.creations.livrees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.creations.livrees') ? 'btn-success' : 'btn-outline-success' }}">
                Livrées
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.creations-graphiques._liste-table', ['creations' => $creations])
@endsection
@extends('back.layouts.principal')

@section('title', 'Identités visuelles')
@section('page_title', 'Chambre Graphisme · Identités visuelles')
@section('page_subtitle', 'Gestion des logos, chartes graphiques, palettes et systèmes visuels du hub et des clients.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.identites-visuelles._kpis', ['identites' => $identites])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des identités visuelles</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.identites.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouvelle identité visuelle
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.identites.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.identites.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-graphisme.identites.creations') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.identites.creations') ? 'btn-warning' : 'btn-outline-warning' }}">
                En création
            </a>

            <a href="{{ route('back.chambre-graphisme.identites.validations') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.identites.validations') ? 'btn-info' : 'btn-outline-info' }}">
                En validation
            </a>

            <a href="{{ route('back.chambre-graphisme.identites.terminees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.identites.terminees') ? 'btn-success' : 'btn-outline-success' }}">
                Terminées
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.identites-visuelles._liste-table', ['identites' => $identites])
@endsection
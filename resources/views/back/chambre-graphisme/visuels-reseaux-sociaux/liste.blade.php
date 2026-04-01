@extends('back.layouts.principal')

@section('title', 'Visuels réseaux sociaux')
@section('page_title', 'Chambre Graphisme · Visuels réseaux sociaux')
@section('page_subtitle', 'Gestion des contenus visuels pour Facebook, Instagram, LinkedIn, TikTok et YouTube.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.visuels-reseaux-sociaux._kpis', ['visuels' => $visuels])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline social media</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.social.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouveau visuel
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.social.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.social.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Tous
            </a>

            <a href="{{ route('back.chambre-graphisme.social.programmes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.social.programmes') ? 'btn-warning' : 'btn-outline-warning' }}">
                Programmés
            </a>

            <a href="{{ route('back.chambre-graphisme.social.publies') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.social.publies') ? 'btn-success' : 'btn-outline-success' }}">
                Publiés
            </a>

            <a href="{{ route('back.chambre-graphisme.social.instagram') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.social.instagram') ? 'btn-info' : 'btn-outline-info' }}">
                Instagram
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.visuels-reseaux-sociaux._liste-table', ['visuels' => $visuels])
@endsection
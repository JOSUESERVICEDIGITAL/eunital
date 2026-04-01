@extends('back.layouts.principal')

@section('title', 'Demandes clients graphisme')
@section('page_title', 'Chambre Graphisme · Demandes clients')
@section('page_subtitle', 'Gestion des briefs, besoins graphiques et demandes entrantes des clients.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.demandes-clients._kpis', ['demandes' => $demandes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des demandes clients</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-graphisme.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    Dashboard graphisme
                </a>

                <a href="{{ route('back.chambre-graphisme.clients-demandes.creer') }}" class="btn btn-dark rounded-pill px-3">
                    Nouvelle demande
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-graphisme.clients-demandes.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.clients-demandes.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-graphisme.clients-demandes.en_attente') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.clients-demandes.en_attente') ? 'btn-secondary' : 'btn-outline-secondary' }}">
                En attente
            </a>

            <a href="{{ route('back.chambre-graphisme.clients-demandes.en_cours') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.clients-demandes.en_cours') ? 'btn-warning' : 'btn-outline-warning' }}">
                En cours
            </a>

            <a href="{{ route('back.chambre-graphisme.clients-demandes.terminees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-graphisme.clients-demandes.terminees') ? 'btn-success' : 'btn-outline-success' }}">
                Terminées
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.demandes-clients._liste-table', ['demandes' => $demandes])
@endsection

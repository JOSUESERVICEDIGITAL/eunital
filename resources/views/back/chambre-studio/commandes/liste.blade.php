@extends('back.layouts.principal')

@section('title', 'Commandes studio')
@section('page_title', 'Chambre Studio · Commandes')
@section('page_subtitle', 'Gestion des demandes clients, prestations studio et suivi commercial.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.commandes._kpis', ['commandes' => $commandes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Navigation rapide</div>
                <h5 class="mb-0">Pipeline des commandes studio</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.dashboard') }}" class="btn btn-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Dashboard studio
                </a>

                <a href="{{ route('back.chambre-studio.commandes.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle commande
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-studio.commandes.toutes') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.commandes.toutes') ? 'btn-dark' : 'btn-outline-dark' }}">
                Toutes
            </a>

            <a href="{{ route('back.chambre-studio.commandes.en_attente') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.commandes.en_attente') ? 'btn-warning' : 'btn-outline-warning' }}">
                En attente
            </a>

            <a href="{{ route('back.chambre-studio.commandes.en_cours') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.commandes.en_cours') ? 'btn-primary' : 'btn-outline-primary' }}">
                En cours
            </a>

            <a href="{{ route('back.chambre-studio.commandes.livrees') }}"
               class="btn rounded-pill px-3 {{ request()->routeIs('back.chambre-studio.commandes.livrees') ? 'btn-success' : 'btn-outline-success' }}">
                Livrées
            </a>
        </div>
    </div>

    @include('back.chambre-studio.commandes._liste-table', ['commandes' => $commandes])
@endsection
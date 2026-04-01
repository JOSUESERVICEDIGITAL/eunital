@extends('back.layouts.principal')

@section('title', 'Commandes en cours')
@section('page_title', 'Chambre Studio · Commandes en cours')
@section('page_subtitle', 'Liste des commandes studio actuellement en production ou en traitement.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-studio.commandes._kpis', ['commandes' => $commandes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Commandes en cours</h5>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-light rounded-pill px-3">
                    Toutes les commandes
                </a>

                <a href="{{ route('back.chambre-studio.commandes.creer') }}" class="btn btn-dark rounded-pill px-3">
                    <i class="fa-solid fa-plus me-1"></i> Nouvelle commande
                </a>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.commandes._liste-table', ['commandes' => $commandes])
@endsection
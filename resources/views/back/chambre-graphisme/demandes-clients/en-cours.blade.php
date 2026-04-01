@extends('back.layouts.principal')

@section('title', 'Demandes en cours')
@section('page_title', 'Chambre Graphisme · Demandes en cours')
@section('page_subtitle', 'Liste des demandes clients actuellement en production ou en traitement.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.demandes-clients._kpis', ['demandes' => $demandes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Demandes en cours</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.clients-demandes.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouvelle demande
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.demandes-clients._liste-table', ['demandes' => $demandes])
@endsection

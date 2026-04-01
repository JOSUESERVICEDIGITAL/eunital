@extends('back.layouts.principal')

@section('title', 'Maquettes UI/UX')
@section('page_title', 'Chambre Graphisme · Maquettes UI/UX')
@section('page_subtitle', 'Liste des maquettes haute fidélité et interfaces prêtes à validation.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.uiux-designs._kpis', ['designs' => $designs])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Maquettes</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.uiux.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouveau design
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.uiux-designs._liste-table', ['designs' => $designs])
@endsection
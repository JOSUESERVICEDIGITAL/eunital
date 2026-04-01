@extends('back.layouts.principal')

@section('title', 'Flyers')
@section('page_title', 'Chambre Graphisme · Flyers')
@section('page_subtitle', 'Liste des flyers promotionnels, commerciaux et événementiels.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.affiches-flyers._kpis', ['affiches' => $affiches])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Flyers</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.affiches.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouveau support
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.affiches-flyers._liste-table', ['affiches' => $affiches])
@endsection
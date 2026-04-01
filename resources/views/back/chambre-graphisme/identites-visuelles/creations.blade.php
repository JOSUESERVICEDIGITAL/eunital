@extends('back.layouts.principal')

@section('title', 'Identités visuelles en création')
@section('page_title', 'Chambre Graphisme · En création')
@section('page_subtitle', 'Liste des identités visuelles actuellement en cours de conception.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.identites-visuelles._kpis', ['identites' => $identites])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Identités en création</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.identites.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouvelle identité visuelle
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.identites-visuelles._liste-table', ['identites' => $identites])
@endsection
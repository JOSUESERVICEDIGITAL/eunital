@extends('back.layouts.principal')

@section('title', 'Identités visuelles terminées')
@section('page_title', 'Chambre Graphisme · Terminées')
@section('page_subtitle', 'Liste des identités visuelles finalisées et validées.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.identites-visuelles._kpis', ['identites' => $identites])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Identités terminées</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.identites.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouvelle identité visuelle
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.identites-visuelles._liste-table', ['identites' => $identites])
@endsection
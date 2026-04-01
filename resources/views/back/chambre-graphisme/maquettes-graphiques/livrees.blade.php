@extends('back.layouts.principal')

@section('title', 'Maquettes livrées')
@section('page_title', 'Chambre Graphisme · Maquettes livrées')
@section('page_subtitle', 'Liste des maquettes graphiques finalisées et remises aux équipes ou aux clients.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.maquettes-graphiques._kpis', ['maquettes' => $maquettes])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Maquettes livrées</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.maquettes.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouvelle maquette
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.maquettes-graphiques._liste-table', ['maquettes' => $maquettes])
@endsection
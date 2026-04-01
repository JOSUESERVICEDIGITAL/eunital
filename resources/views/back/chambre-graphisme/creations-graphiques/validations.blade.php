@extends('back.layouts.principal')

@section('title', 'Créations en validation')
@section('page_title', 'Chambre Graphisme · Validations')
@section('page_subtitle', 'Liste des créations envoyées en validation avant livraison.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.creations-graphiques._kpis', ['creations' => $creations])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Créations en validation</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.creations.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouvelle création
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.creations-graphiques._liste-table', ['creations' => $creations])
@endsection
@extends('back.layouts.principal')

@section('title', 'Prototypes')
@section('page_title', 'Chambre Graphisme · Prototypes')
@section('page_subtitle', 'Liste des prototypes interactifs et simulations d’expérience utilisateur.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.uiux-designs._kpis', ['designs' => $designs])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Prototypes</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.uiux.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouveau design
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.uiux-designs._liste-table', ['designs' => $designs])
@endsection
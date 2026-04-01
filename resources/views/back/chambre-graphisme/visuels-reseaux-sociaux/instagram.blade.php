@extends('back.layouts.principal')

@section('title', 'Visuels Instagram')
@section('page_title', 'Chambre Graphisme · Instagram')
@section('page_subtitle', 'Liste des visuels conçus pour Instagram et ses formats associés.')

@section('content')
    <div class="row g-4 mb-4">
        @include('back.chambre-graphisme.visuels-reseaux-sociaux._kpis', ['visuels' => $visuels])
    </div>

    <div class="content-card mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="mini-label">Filtre actif</div>
                <h5 class="mb-0">Visuels Instagram</h5>
            </div>

            <a href="{{ route('back.chambre-graphisme.social.creer') }}" class="btn btn-dark rounded-pill px-3">
                Nouveau visuel
            </a>
        </div>
    </div>

    @include('back.chambre-graphisme.visuels-reseaux-sociaux._liste-table', ['visuels' => $visuels])
@endsection
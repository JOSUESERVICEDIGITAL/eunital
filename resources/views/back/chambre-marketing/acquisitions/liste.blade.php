@extends('back.layouts.principal')

@section('title', 'Acquisitions marketing')
@section('page_title', 'Chambre marketing · Acquisition')
@section('page_subtitle', 'Pilotage des sources de trafic, des leads, des coûts d’acquisition et des canaux de conversion.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Centre d’acquisition</h4>
                        <p class="text-muted mb-0">Gère les sources, les canaux, les leads, les visiteurs et l’optimisation des performances d’entrée.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.acquisitions.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">
                            Toutes
                        </a>

                        <a href="{{ route('back.chambre-marketing.acquisitions.actives') }}" class="btn btn-outline-success rounded-pill px-4">
                            Actives
                        </a>

                        <a href="{{ route('back.chambre-marketing.acquisitions.optimisation') }}" class="btn btn-outline-warning rounded-pill px-4">
                            Optimisation
                        </a>

                        <a href="{{ route('back.chambre-marketing.acquisitions.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouvelle acquisition
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.acquisitions._table', [
                'acquisitions' => $acquisitions,
                'titreBloc' => 'Toutes les acquisitions',
                'descriptionBloc' => 'Vue globale des canaux d’acquisition et de leurs performances.'
            ])
        </div>

    </div>
@endsection
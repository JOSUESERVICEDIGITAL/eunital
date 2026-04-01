@extends('back.layouts.principal')

@section('title', 'Campagnes marketing')
@section('page_title', 'Chambre marketing · Campagnes marketing')
@section('page_subtitle', 'Pilotage des campagnes publicitaires, de la diffusion multi-réseaux, des budgets et des performances.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            @include('back.chambre-marketing.campagnes._cartes-kpi', ['campagnes' => $campagnes])
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Centre de pilotage marketing</h4>
                        <p class="text-muted mb-0">Gère les diffusions, les budgets, les pauses, les relances et le suivi réseau par réseau.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.campagnes.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-marketing.campagnes.actives') }}" class="btn btn-outline-success rounded-pill px-4">Actives</a>
                        <a href="{{ route('back.chambre-marketing.campagnes.en_pause') }}" class="btn btn-outline-warning rounded-pill px-4">En pause</a>
                        <a href="{{ route('back.chambre-marketing.campagnes.terminees') }}" class="btn btn-outline-secondary rounded-pill px-4">Terminées</a>
                        <a href="{{ route('back.chambre-marketing.campagnes.multi_reseaux') }}" class="btn btn-outline-primary rounded-pill px-4">Multi-réseaux</a>
                        <a href="{{ route('back.chambre-marketing.campagnes.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouvelle campagne
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.campagnes._table', [
                'campagnes' => $campagnes,
                'titreBloc' => 'Toutes les campagnes',
                'descriptionBloc' => 'Vue globale sur toutes les campagnes marketing du hub.'
            ])
        </div>

    </div>
@endsection

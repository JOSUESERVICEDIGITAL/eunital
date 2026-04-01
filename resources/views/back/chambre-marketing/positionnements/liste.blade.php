@extends('back.layouts.principal')

@section('title', 'Positionnement marketing')
@section('page_title', 'Chambre marketing · Positionnement')
@section('page_subtitle', 'Gestion des promesses, différenciations, messages centraux et segments cibles.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Pilotage du positionnement</h4>
                        <p class="text-muted mb-0">Définis la place de la marque, la cible, la promesse et la différenciation du hub.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.positionnements.tous') }}" class="btn btn-outline-dark rounded-pill px-4">
                            Tous
                        </a>

                        <a href="{{ route('back.chambre-marketing.positionnements.actifs') }}" class="btn btn-outline-success rounded-pill px-4">
                            Actifs
                        </a>

                        <a href="{{ route('back.chambre-marketing.positionnements.a_revoir') }}" class="btn btn-outline-warning rounded-pill px-4">
                            À revoir
                        </a>

                        <a href="{{ route('back.chambre-marketing.positionnements.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouveau positionnement
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.positionnements._table', [
                'positionnements' => $positionnements,
                'titreBloc' => 'Tous les positionnements',
                'descriptionBloc' => 'Vue globale des axes de positionnement marketing.'
            ])
        </div>

    </div>
@endsection
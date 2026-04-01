@extends('back.layouts.principal')

@section('title', 'Croissance marketing')
@section('page_title', 'Chambre marketing · Croissance')
@section('page_subtitle', 'Pilotage des leviers, plans d’expansion, actions de scaling et objectifs de croissance du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Centre de croissance</h4>
                        <p class="text-muted mb-0">Organise les objectifs, les leviers, les actions prioritaires et les plans d’accélération du hub.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.croissances.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">
                            Toutes
                        </a>

                        <a href="{{ route('back.chambre-marketing.croissances.planifiees') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Planifiées
                        </a>

                        <a href="{{ route('back.chambre-marketing.croissances.en_cours') }}" class="btn btn-outline-primary rounded-pill px-4">
                            En cours
                        </a>

                        <a href="{{ route('back.chambre-marketing.croissances.critiques') }}" class="btn btn-outline-danger rounded-pill px-4">
                            Critiques
                        </a>

                        <a href="{{ route('back.chambre-marketing.croissances.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouvelle action
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.croissances._table', [
                'croissances' => $croissances,
                'titreBloc' => 'Toutes les actions de croissance',
                'descriptionBloc' => 'Vue globale des leviers de croissance et des actions planifiées.'
            ])
        </div>

    </div>
@endsection
@extends('back.layouts.principal')

@section('title', 'Détails maquette graphique')
@section('page_title', 'Fiche détaillée · Maquette graphique')
@section('page_subtitle', 'Consulte les informations complètes et les actions métier de la maquette graphique.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Maquette graphique</div>
                        <h4 class="mb-0">{{ $maquette->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.maquettes.modifier', $maquette) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsMaquette{{ $maquette->id }}">
                            Centre maquette
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Support</div>
                            <div class="fw-semibold">{{ $maquette->support ?: 'Non renseigné' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst($maquette->statut) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Fichier</div>
                            <div class="fw-semibold">{{ $maquette->fichier ?: 'Non renseigné' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement maquette</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.maquettes.valider', $maquette) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-info rounded-pill w-100">Envoyer en validation</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-graphisme.maquettes.livrer', $maquette) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.maquettes-graphiques._modales', ['maquette' => $maquette])
@endsection
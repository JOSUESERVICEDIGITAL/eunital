@extends('back.layouts.principal')

@section('title', 'Détails support graphique')
@section('page_title', 'Fiche détaillée · Affiche / flyer')
@section('page_subtitle', 'Consulte les informations complètes et les actions métier du support graphique.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Support graphique</div>
                        <h4 class="mb-0">{{ $affiche->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.affiches.modifier', $affiche) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsAffiche{{ $affiche->id }}">
                            Centre support
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $affiche->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($affiche->type) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst($affiche->statut) }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Fichier</div>
                            <div class="fw-semibold">{{ $affiche->fichier ?: 'Non renseigné.' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $affiche->description ?: 'Aucune description.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement support</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.affiches.livrer', $affiche) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer livré</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.affiches-flyers._modales', ['affiche' => $affiche])
@endsection
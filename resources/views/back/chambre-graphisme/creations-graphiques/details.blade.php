@extends('back.layouts.principal')

@section('title', 'Détails création graphique')
@section('page_title', 'Fiche détaillée · Création graphique')
@section('page_subtitle', 'Consulte les informations complètes et les actions métier de la création.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Création graphique</div>
                        <h4 class="mb-0">{{ $creation->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.creations.modifier', $creation) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsCreation{{ $creation->id }}">
                            Centre création
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($creation->type) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $creation->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Auteur</div>
                            <div class="fw-semibold">{{ $creation->auteur->name ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $creation->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Projet</div>
                            <div class="fw-semibold">{{ $creation->projet->titre ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Fichier</div>
                            <div class="fw-semibold">{{ $creation->fichier ?: 'Non renseigné.' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $creation->description ?: 'Aucune description.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement graphique</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.creations.envoyer_en_validation', $creation) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-info rounded-pill w-100">Envoyer en validation</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-graphisme.creations.livrer', $creation) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-graphisme.creations.archiver', $creation) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-outline-dark rounded-pill w-100">Archiver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.creations-graphiques._modales', ['creation' => $creation])
@endsection
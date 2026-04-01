@extends('back.layouts.principal')

@section('title', 'Détails demande client')
@section('page_title', 'Fiche détaillée · Demande client')
@section('page_subtitle', 'Consulte le brief complet et les actions métier associées à la demande client.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Demande client</div>
                        <h4 class="mb-0">{{ $demande->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.clients-demandes.modifier', $demande) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsDemande{{ $demande->id }}">
                            Centre demande
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $demande->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($demande->type) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Priorité</div>
                            <div class="fw-semibold">{{ ucfirst($demande->priorite) }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $demande->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $demande->description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement demande</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.clients-demandes.lancer', $demande) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-warning rounded-pill w-100">Passer en cours</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-graphisme.clients-demandes.terminer', $demande) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer terminée</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.demandes-clients._modales', ['demande' => $demande])
@endsection

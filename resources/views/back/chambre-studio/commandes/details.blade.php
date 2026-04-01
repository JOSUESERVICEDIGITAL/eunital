@extends('back.layouts.principal')

@section('title', 'Détails commande studio')
@section('page_title', 'Fiche détaillée · Commande studio')
@section('page_subtitle', 'Consulte les informations complètes d’une commande et ses actions métier.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Commande studio</div>
                        <h4 class="mb-0">{{ $commandeStudio->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsCommandeStudio{{ $commandeStudio->id }}">
                            Centre commande
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $commandeStudio->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($commandeStudio->type ?? 'non défini') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $commandeStudio->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $commandeStudio->description ?: 'Aucune description.' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Date de création</div>
                            <div class="fw-semibold">{{ $commandeStudio->created_at ? $commandeStudio->created_at->format('d/m/Y H:i') : '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement commande</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-studio.commandes.valider', $commandeStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-primary rounded-pill w-100">Valider / lancer</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.commandes.livrer', $commandeStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer livrée</button>
                    </form>

                    <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-light rounded-pill w-100">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.commandes._modales', ['commandeStudio' => $commandeStudio])
@endsection
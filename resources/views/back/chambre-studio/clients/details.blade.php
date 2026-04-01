@extends('back.layouts.principal')

@section('title', 'Détails client studio')
@section('page_title', 'Fiche détaillée · Client studio')
@section('page_subtitle', 'Consulte les informations complètes d’un client de la chambre studio.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Client studio</div>
                        <h4 class="mb-0">{{ $clientStudio->nom }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsClientStudio{{ $clientStudio->id }}">
                            Centre client
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Type</div>
                            <div class="fw-semibold">{{ ucfirst($clientStudio->type ?? 'non défini') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Téléphone</div>
                            <div class="fw-semibold">{{ $clientStudio->telephone ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Email</div>
                            <div class="fw-semibold">{{ $clientStudio->email ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Adresse</div>
                            <div class="fw-semibold">{{ $clientStudio->adresse ?: 'Aucune adresse renseignée.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions</div>
                <h5 class="mb-3">Navigation studio</h5>

                <div class="d-grid gap-2">
                    <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-outline-dark rounded-pill w-100">
                        Voir commandes studio
                    </a>

                    <a href="{{ route('back.chambre-studio.clients.tous') }}" class="btn btn-light rounded-pill w-100">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.clients._modales', ['clientStudio' => $clientStudio])
@endsection
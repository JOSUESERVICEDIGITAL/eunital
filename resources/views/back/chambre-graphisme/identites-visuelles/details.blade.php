@extends('back.layouts.principal')

@section('title', 'Détails identité visuelle')
@section('page_title', 'Fiche détaillée · Identité visuelle')
@section('page_subtitle', 'Consulte les éléments complets de l’identité visuelle et son workflow.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Identité visuelle</div>
                        <h4 class="mb-0">{{ $identite->nom }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.identites.modifier', $identite) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsIdentite{{ $identite->id }}">
                            Centre branding
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $identite->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $identite->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Logo</div>
                            <div class="fw-semibold">{{ $identite->logo ?: 'Non renseigné' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Palette</div>
                            <div class="fw-semibold">{{ $identite->palette_couleurs ?: 'Non renseignée' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Typographie</div>
                            <div class="fw-semibold">{{ $identite->typographie ?: 'Non renseignée' }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Description</div>
                            <div class="fw-semibold">{{ $identite->description ?: 'Aucune description.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement branding</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.identites.valider', $identite) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-info rounded-pill w-100">Envoyer en validation</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-graphisme.identites.terminer', $identite) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer terminée</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.identites-visuelles._modales', ['identite' => $identite])
@endsection
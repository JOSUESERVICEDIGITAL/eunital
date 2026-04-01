@extends('back.layouts.principal')

@section('title', 'Détails visuel social')
@section('page_title', 'Fiche détaillée · Visuel réseau social')
@section('page_subtitle', 'Consulte les informations complètes et les actions métier du visuel social.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Visuel réseau social</div>
                        <h4 class="mb-0">{{ $visuel->titre }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-graphisme.social.modifier', $visuel) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsVisuel{{ $visuel->id }}">
                            Centre publication
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $visuel->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Plateforme</div>
                            <div class="fw-semibold">{{ ucfirst($visuel->plateforme) }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst($visuel->statut) }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Date de publication</div>
                            <div class="fw-semibold">
                                {{ $visuel->date_publication ? \Carbon\Carbon::parse($visuel->date_publication)->format('d/m/Y H:i') : 'Non définie' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Fichier</div>
                            <div class="fw-semibold">{{ $visuel->fichier ?: 'Non renseigné' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement publication</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-graphisme.social.publier', $visuel) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Marquer publié</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-graphisme.visuels-reseaux-sociaux._modales', ['visuel' => $visuel])
@endsection
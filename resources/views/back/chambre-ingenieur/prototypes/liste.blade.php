@extends('back.layouts.principal')

@section('title', 'Prototypes')
@section('page_title', 'Chambre d’ingénieurs · Prototypes')
@section('page_subtitle', 'Salle de démonstration, de test, de POC et de matérialisation des idées techniques.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre prototypes</h4>
                        <p class="text-muted mb-0">Tests, maquettes, démonstrations, MVP et expérimentations techniques.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.chambre-ingenieur.prototypes.tous') }}"
                            class="btn btn-outline-dark rounded-pill px-4">Tous</a>
                        <a href="{{ route('back.chambre-ingenieur.prototypes.en_cours') }}"
                            class="btn btn-outline-primary rounded-pill px-4">En cours</a>
                        <a href="{{ route('back.chambre-ingenieur.prototypes.termines') }}"
                            class="btn btn-outline-success rounded-pill px-4">Terminés</a>
                        <a href="{{ route('back.chambre-ingenieur.prototypes.abandonnes') }}"
                            class="btn btn-outline-danger rounded-pill px-4">Abandonnés</a>
                        <a href="{{ route('back.chambre-ingenieur.prototypes.creer') }}"
                            class="btn btn-primary rounded-pill px-4">Nouveau prototype</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prototype</th>
                                <th>Statut</th>
                                <th>Démo</th>
                                <th>Dépôt source</th>
                                <th>Auteur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prototypes as $prototype)
                                <tr>
                                    <td>{{ $prototype->id }}</td>
                                    <td>{{ $prototype->titre }}</td>
                                    <td><span
                                            class="badge rounded-pill text-bg-light border">{{ str_replace('_', ' ', ucfirst($prototype->statut)) }}</span>
                                    </td>
                                    <td>{{ $prototype->lien_demo ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $prototype->depot_source ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $prototype->auteur->name ?? '—' }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.chambre-ingenieur.prototypes.details', $prototype) }}"
                                                class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                            <a href="{{ route('back.chambre-ingenieur.prototypes.modifier', $prototype) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionCapture{{ $prototype->id }}">
                                                Supprimer capture
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionPrototype{{ $prototype->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        @include('back.chambre-ingenieur.prototypes._modales', [
                                            'prototype' => $prototype,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">Aucun prototype trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $prototypes->links() }}</div>
            </div>
        </div>
    </div>
@endsection

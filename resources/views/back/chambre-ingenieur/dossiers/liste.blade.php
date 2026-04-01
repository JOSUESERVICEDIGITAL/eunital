@extends('back.layouts.principal')

@section('title', 'Dossiers techniques')
@section('page_title', 'Chambre d’ingénieurs · Dossiers techniques')
@section('page_subtitle', 'Salle documentaire des spécifications, procédures, analyses et documents techniques du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre documentaire</h4>
                        <p class="text-muted mb-0">Documentation technique, spécifications, procédures et archives du pôle
                            ingénierie.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.chambre-ingenieur.dossiers.tous') }}"
                            class="btn btn-outline-dark rounded-pill px-4">Tous</a>
                        <a href="{{ route('back.chambre-ingenieur.dossiers.brouillons') }}"
                            class="btn btn-outline-warning rounded-pill px-4">Brouillons</a>
                        <a href="{{ route('back.chambre-ingenieur.dossiers.publies') }}"
                            class="btn btn-outline-success rounded-pill px-4">Publiés</a>
                        <a href="{{ route('back.chambre-ingenieur.dossiers.archives') }}"
                            class="btn btn-outline-secondary rounded-pill px-4">Archivés</a>
                        <a href="{{ route('back.chambre-ingenieur.dossiers.creer') }}"
                            class="btn btn-primary rounded-pill px-4">Nouveau dossier</a>
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
                                <th>Dossier</th>
                                <th>Type</th>
                                <th>Version</th>
                                <th>Statut</th>
                                <th>Document</th>
                                <th>Auteur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dossiers as $dossier)
                                <tr>
                                    <td>{{ $dossier->id }}</td>
                                    <td>{{ $dossier->titre }}</td>
                                    <td><span
                                            class="badge rounded-pill text-bg-light border">{{ ucfirst($dossier->type_dossier) }}</span>
                                    </td>
                                    <td>{{ $dossier->version }}</td>
                                    <td><span
                                            class="badge rounded-pill text-bg-secondary">{{ ucfirst($dossier->statut) }}</span>
                                    </td>
                                    <td>{{ $dossier->document_principal ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $dossier->auteur->name ?? '—' }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.chambre-ingenieur.dossiers.details', $dossier) }}"
                                                class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                            <a href="{{ route('back.chambre-ingenieur.dossiers.modifier', $dossier) }}"
                                                class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionDocumentPrincipal{{ $dossier->id }}">
                                                Supprimer document
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionDossier{{ $dossier->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        @include('back.chambre-ingenieur.dossiers._modales', [
                                            'dossier' => $dossier,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">Aucun dossier technique trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $dossiers->links() }}</div>
            </div>
        </div>
    </div>
@endsection

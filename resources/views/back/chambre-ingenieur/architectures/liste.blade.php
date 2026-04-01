@extends('back.layouts.principal')

@section('title', 'Architectures techniques')
@section('page_title', 'Chambre d’ingénieurs · Architectures techniques')
@section('page_subtitle', 'Salle de conception des structures techniques, systèmes, composants et diagrammes.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Fenêtre architecture</h4>
                        <p class="text-muted mb-0">Conception technique, organisation système, composants et contraintes.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.chambre-ingenieur.architectures.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-ingenieur.architectures.brouillons') }}" class="btn btn-outline-warning rounded-pill px-4">Brouillons</a>
                        <a href="{{ route('back.chambre-ingenieur.architectures.validees') }}" class="btn btn-outline-success rounded-pill px-4">Validées</a>
                        <a href="{{ route('back.chambre-ingenieur.architectures.obsoletes') }}" class="btn btn-outline-secondary rounded-pill px-4">Obsolètes</a>
                        <a href="{{ route('back.chambre-ingenieur.architectures.creer') }}" class="btn btn-primary rounded-pill px-4">Nouvelle architecture</a>
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
                                <th>Titre</th>
                                <th>Version</th>
                                <th>Statut</th>
                                <th>Diagramme</th>
                                <th>Auteur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($architectures as $architecture)
                                <tr>
                                    <td>{{ $architecture->id }}</td>
                                    <td>{{ $architecture->titre }}</td>
                                    <td>{{ $architecture->version }}</td>
                                    <td><span class="badge rounded-pill text-bg-light border">{{ ucfirst($architecture->statut) }}</span></td>
                                    <td>{{ $architecture->diagramme ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $architecture->auteur->name ?? '—' }}</td>
                                    <td class="text-end">
    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
        <a href="{{ route('back.chambre-ingenieur.architectures.details', $architecture) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
        <a href="{{ route('back.chambre-ingenieur.architectures.modifier', $architecture) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

        <button type="button"
            class="btn btn-sm btn-outline-warning rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionDiagramme{{ $architecture->id }}">
            Supprimer diagramme
        </button>

        <button type="button"
            class="btn btn-sm btn-outline-danger rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionArchitecture{{ $architecture->id }}">
            Supprimer
        </button>
    </div>

    @include('back.chambre-ingenieur.architectures._modales', ['architecture' => $architecture])
</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-5 text-muted">Aucune architecture trouvée.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $architectures->links() }}</div>
            </div>
        </div>
    </div>
@endsection
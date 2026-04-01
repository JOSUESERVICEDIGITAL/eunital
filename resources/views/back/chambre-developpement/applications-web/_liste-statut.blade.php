<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Application</th>
                    <th>Version</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Responsable</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $application->titre }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($application->description, 70) }}</div>
                        </td>
                        <td>{{ $application->version }}</td>
                        <td><span class="badge rounded-pill text-bg-light border">{{ ucfirst($application->priorite) }}</span></td>
                        <td><span class="badge rounded-pill text-bg-secondary">{{ str_replace('_', ' ', ucfirst($application->statut)) }}</span></td>
                        <td>{{ $application->responsable->name ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.applications-web.details', $application) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.chambre-developpement.applications-web.modifier', $application) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionApplicationWeb{{ $application->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-developpement.applications-web._modales', ['application' => $application])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted">Aucune application web trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $applications->links() }}</div>
</div>

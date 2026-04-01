<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-developpement.applications-mobiles.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
            <a href="{{ route('back.chambre-developpement.applications-mobiles.android') }}" class="btn btn-outline-success rounded-pill px-4">Android</a>
            <a href="{{ route('back.chambre-developpement.applications-mobiles.ios') }}" class="btn btn-outline-secondary rounded-pill px-4">iOS</a>
            <a href="{{ route('back.chambre-developpement.applications-mobiles.hybrides') }}" class="btn btn-outline-primary rounded-pill px-4">Hybrides</a>
            <a href="{{ route('back.chambre-developpement.applications-mobiles.publiees') }}" class="btn btn-outline-info rounded-pill px-4">Publiées</a>
            <a href="{{ route('back.chambre-developpement.applications-mobiles.creer') }}" class="btn btn-primary rounded-pill px-4">Nouvelle application</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Application</th>
                    <th>Plateforme</th>
                    <th>Version</th>
                    <th>Statut</th>
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
                        <td>{{ strtoupper($application->plateforme) }}</td>
                        <td>{{ $application->version }}</td>
                        <td>{{ str_replace('_', ' ', ucfirst($application->statut)) }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.applications-mobiles.details', $application) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.chambre-developpement.applications-mobiles.modifier', $application) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionApplicationMobile{{ $application->id }}">
                                    Supprimer
                                </button>
                            </div>
                            @include('back.chambre-developpement.applications-mobiles._modales', ['application' => $application])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted">Aucune application mobile trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $applications->links() }}</div>
</div>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-developpement.apis-integrations.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
            <a href="{{ route('back.chambre-developpement.apis-integrations.rest') }}" class="btn btn-outline-primary rounded-pill px-4">REST</a>
            <a href="{{ route('back.chambre-developpement.apis-integrations.graphql') }}" class="btn btn-outline-secondary rounded-pill px-4">GraphQL</a>
            <a href="{{ route('back.chambre-developpement.apis-integrations.actives') }}" class="btn btn-outline-success rounded-pill px-4">Actives</a>
            <a href="{{ route('back.chambre-developpement.apis-integrations.creer') }}" class="btn btn-primary rounded-pill px-4">
                Nouvelle API
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>API / Intégration</th>
                    <th>Type</th>
                    <th>Authentification</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($apis as $api)
                    <tr>
                        <td>{{ $api->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $api->titre }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($api->description, 70) }}</div>
                        </td>
                        <td>
                            <span class="badge rounded-pill text-bg-light border">
                                {{ strtoupper($api->type_api) }}
                            </span>
                        </td>
                        <td>{{ $api->methode_authentification ?: '—' }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-secondary">
                                {{ str_replace('_', ' ', ucfirst($api->statut)) }}
                            </span>
                        </td>
                        <td>{{ $api->auteur->name ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.apis-integrations.details', $api) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-developpement.apis-integrations.modifier', $api) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionApiIntegration{{ $api->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-developpement.apis-integrations._modales', ['api' => $api])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Aucune API ou intégration trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $apis->links() }}
    </div>
</div>

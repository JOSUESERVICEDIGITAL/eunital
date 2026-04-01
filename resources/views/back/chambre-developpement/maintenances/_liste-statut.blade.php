<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-developpement.maintenances.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
            <a href="{{ route('back.chambre-developpement.maintenances.ouvertes') }}" class="btn btn-outline-secondary rounded-pill px-4">Ouvertes</a>
            <a href="{{ route('back.chambre-developpement.maintenances.en_cours') }}" class="btn btn-outline-primary rounded-pill px-4">En cours</a>
            <a href="{{ route('back.chambre-developpement.maintenances.critiques') }}" class="btn btn-outline-danger rounded-pill px-4">Critiques</a>
            <a href="{{ route('back.chambre-developpement.maintenances.resolues') }}" class="btn btn-outline-success rounded-pill px-4">Résolues</a>
            <a href="{{ route('back.chambre-developpement.maintenances.creer') }}" class="btn btn-primary rounded-pill px-4">
                Nouvelle maintenance
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Maintenance</th>
                    <th>Type</th>
                    <th>Urgence</th>
                    <th>Statut</th>
                    <th>Responsable</th>
                    <th>Signalement</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $maintenance->titre }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($maintenance->description, 70) }}</div>
                        </td>
                        <td>
                            <span class="badge rounded-pill text-bg-light border">
                                {{ ucfirst($maintenance->type_maintenance) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $maintenance->niveau_urgence === 'critique' ? 'text-bg-danger' : 'text-bg-light border' }}">
                                {{ ucfirst($maintenance->niveau_urgence) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill text-bg-secondary">
                                {{ str_replace('_', ' ', ucfirst($maintenance->statut)) }}
                            </span>
                        </td>
                        <td>{{ $maintenance->responsable->name ?? '—' }}</td>
                        <td>{{ $maintenance->date_signalement ? $maintenance->date_signalement->format('d/m/Y H:i') : '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.maintenances.details', $maintenance) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-developpement.maintenances.modifier', $maintenance) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionMaintenance{{ $maintenance->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-developpement.maintenances._modales', ['maintenance' => $maintenance])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            Aucune maintenance trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $maintenances->links() }}
    </div>
</div>

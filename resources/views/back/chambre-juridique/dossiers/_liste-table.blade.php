<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Pilotage des dossiers</h5>
                    <small class="text-muted">Traitement, suivi, niveau d’urgence, responsable et client concerné.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Dossier</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Responsable</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dossiers as $dossier)
                        <tr>
                            <td>#{{ $dossier->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $dossier->titre }}</div>
                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit($dossier->description, 70) ?: 'Sans description.' }}
                                </div>
                            </td>

                            <td>{{ $dossier->client->nom ?? '—' }}</td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $dossier->type_dossier)) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $priorityBadge = match($dossier->priorite) {
                                        'faible' => 'secondary',
                                        'normale' => 'info',
                                        'urgente' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $priorityBadge }}">
                                    {{ ucfirst($dossier->priorite) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $statusBadge = match($dossier->statut) {
                                        'ouvert' => 'secondary',
                                        'en_cours' => 'warning',
                                        'ferme' => 'success',
                                        'archive' => 'dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $statusBadge }}">
                                    {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                </span>
                            </td>

                            <td>{{ $dossier->responsable->name ?? '—' }}</td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.dossiers.details', $dossier) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.dossiers.modifier', $dossier) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsDossier{{ $dossier->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.dossiers._modales', ['dossier' => $dossier])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                Aucun dossier juridique trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $dossiers->links() }}
        </div>
    </div>
</div>
